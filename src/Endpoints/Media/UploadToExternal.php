<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Endpoints\Media;

use Newman\LaravelBackscreenApiClient\AbstractEndpoint;
use Newman\LaravelBackscreenApiClient\Contracts\EndpointContract;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\UploadToExternal\CustomFile;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\UploadToExternal\PackageFile;
use Newman\LaravelBackscreenApiClient\Enums\AuthMethodEnum;
use Newman\LaravelBackscreenApiClient\Enums\HttpMethodEnum;
use Newman\LaravelBackscreenApiClient\HttpClient\PendingRequest;

/**
 * @link https://api.backscreen.com/api/v5/docs#/operations/Media/Uploadtoexternal
 */
class UploadToExternal extends AbstractEndpoint implements EndpointContract
{
    /**
     * @var PackageFile[]|null
     */
    protected ?array $package_files = null;

    /**
     * @var CustomFile[]|null
     */
    protected ?array $custom_files = null;

    protected ?string $path = null;

    protected ?int $cat_dir = null;

    protected ?int $asset_dir = null;

    /**
     * @param  int|array<int>  $id
     */
    public function __construct(
        protected int|array $id,
        protected int $upload_destination_id,
    ) {}

    /**
     * Define which authentication methods are allowed to call this endpoint.
     *
     * @return AuthMethodEnum[]
     */
    public function allowedAuthMethods(): array
    {
        return [AuthMethodEnum::BEARER];
    }

    /**
     * @param  PackageFile[]  $package_files
     */
    public function packageFiles(array $package_files): static
    {
        $this->package_files = $package_files;

        return $this;
    }

    /**
     * @param  CustomFile[]  $custom_files
     */
    public function customFiles(array $custom_files): static
    {
        $this->custom_files = $custom_files;

        return $this;
    }

    public function path(string $path): static
    {
        $this->path = $path;

        return $this;
    }

    public function catDir(int $cat_dir): static
    {
        if (! in_array($cat_dir, [0, 1])) {
            throw new \InvalidArgumentException('cat_dir must be 0 or 1');
        }

        $this->cat_dir = $cat_dir;

        return $this;
    }

    public function assetDir(int $asset_dir): static
    {
        if (! in_array($asset_dir, [0, 1])) {
            throw new \InvalidArgumentException('asset_dir must be 0 or 1');
        }

        $this->asset_dir = $asset_dir;

        return $this;
    }

    /**
     * HTTP Method to use for request.
     */
    public function useHttpMethod(): HttpMethodEnum
    {
        return HttpMethodEnum::PUT;
    }

    /**
     * Endpoint url.
     */
    public function endpointUrl(): string
    {
        return '/Media/Uploadtoexternal';
    }

    /**
     * Prepares HTTP request for this endpoint.
     */
    public function prepareHttpRequest(PendingRequest $http): void
    {
        $data = [
            'id' => $this->id,
            'upload_destination_id' => $this->upload_destination_id,
        ];

        if ($this->package_files !== null) {
            $package_files = [];

            foreach ($this->package_files as $value) {
                $file = $value->compileAsArray();
                if (! empty($file)) {
                    $package_files[] = $file;
                }
            }

            if (! empty($package_files)) {
                $data['package_files'] = $package_files;
            }
        }

        if ($this->custom_files !== null) {
            $custom_files = [];

            foreach ($this->custom_files as $value) {
                $file = $value->compileAsArray();
                if (! empty($file)) {
                    $custom_files[] = $file;
                }
            }

            if (! empty($custom_files)) {
                $data['custom_files'] = $custom_files;
            }
        }

        if ($this->path !== null) {
            $data['path'] = $this->path;
        }

        if ($this->cat_dir !== null) {
            $data['cat_dir'] = $this->cat_dir;
        }

        if ($this->asset_dir !== null) {
            $data['asset_dir'] = $this->asset_dir;
        }

        $http->withData($data);
    }
}
