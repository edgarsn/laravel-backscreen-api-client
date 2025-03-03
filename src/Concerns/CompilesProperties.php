<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Concerns;

use Carbon\CarbonInterface;
use ReflectionClass;
use ReflectionProperty;

trait CompilesProperties
{
    /**
     * Except properties in compilation.
     *
     * @return array<string>
     */
    public function compilesAsArrayExceptProperties(): array
    {
        return [];
    }

    /**
     * Compile properties as array.
     *
     * @return array<string, mixed>
     */
    public function compileAsArray(): array
    {
        $data = [];

        $reflect = new ReflectionClass($this);
        $properties = $reflect->getProperties(ReflectionProperty::IS_PROTECTED);

        $exceptProperties = $this->compilesAsArrayExceptProperties();

        foreach ($properties as $property) {
            $value = $property->getValue($this);

            if ($value !== null && ! in_array($property->name, $exceptProperties)) {
                if ($value instanceof \BackedEnum) {
                    $value = $value->value;
                } elseif (is_bool($value)) {
                    $value = $value ? 1 : 0;
                } elseif ($value instanceof CarbonInterface) {
                    $value = $value->toDateTimeString();
                } elseif (is_object($value) && method_exists($value, 'compileAsArray')) {
                    $value = $value->compileAsArray();
                } elseif (is_array($value)) {
                    $formatted = [];
                    foreach ($value as $item) {
                        $formatted[] = is_object($item) && method_exists($item, 'compileAsArray') ? $item->compileAsArray() : $item;
                    }
                    $value = $formatted;
                }

                $data[$property->name] = $value;
            }
        }

        return $data;
    }
}
