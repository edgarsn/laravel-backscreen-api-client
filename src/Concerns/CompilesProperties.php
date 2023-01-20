<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Concerns;

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

            if ($value !== null && !in_array($property->name, $exceptProperties)) {
                if ($value instanceof \BackedEnum) {
                    $value = $value->value;
                } else if (is_bool($value)) {
                    $value = $value ? 1 : 0;
                } else if ($value instanceof CarbonInterface) {
                    $value = $value->toDateTimeString();
                }

                $data[$property->name] = $value;
            }
        }

        return $data;
    }
}
