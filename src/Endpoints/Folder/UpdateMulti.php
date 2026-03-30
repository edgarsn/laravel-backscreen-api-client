<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Endpoints\Folder;

use Newman\LaravelBackscreenApiClient\AbstractEndpoint;
use Newman\LaravelBackscreenApiClient\Contracts\EndpointContract;
use Newman\LaravelBackscreenApiClient\Endpoints\Folder\FolderList\TypeEnum;
use Newman\LaravelBackscreenApiClient\Endpoints\Folder\UpdateMulti\UpdateItem;
use Newman\LaravelBackscreenApiClient\Enums\AuthMethodEnum;
use Newman\LaravelBackscreenApiClient\Enums\HttpMethodEnum;
use Newman\LaravelBackscreenApiClient\HttpClient\PendingRequest;

/**
 * @link https://api.cloudycdn.services/api/v5/docs#/operations/Folder/Updatemulti
 */
class UpdateMulti extends AbstractEndpoint implements EndpointContract
{
    /**
     * @var int|array<int>|null
     */
    protected int|array|null $delete = null;

    /**
     * @var array<UpdateItem>|null
     */
    protected ?array $update = null;

    public function __construct(protected TypeEnum $type) {}

    /**
     * ID or array of IDs of folders to delete.
     *
     * @param  int|array<int>  $delete
     */
    public function delete(int|array $delete): static
    {
        $this->delete = $delete;

        return $this;
    }

    /**
     * @param  array<UpdateItem>  $update
     */
    public function update(array $update): static
    {
        $this->update = $update;

        return $this;
    }

    /**
     * Define which authentication methods are allowed to call this endpoint.
     *
     * @return AuthMethodEnum[]
     */
    public function allowedAuthMethods(): array
    {
        return [AuthMethodEnum::BASIC, AuthMethodEnum::BEARER];
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
        return '/Folder/Updatemulti';
    }

    /**
     * Prepares HTTP request for this endpoint.
     */
    public function prepareHttpRequest(PendingRequest $http): void
    {
        $data = [
            'type' => $this->type->value,
        ];

        if ($this->delete !== null) {
            $data['delete'] = $this->delete;
        }

        if ($this->update !== null) {
            $data['update'] = array_map(fn (UpdateItem $item) => $item->compileAsArray(), $this->update);
        }

        $http->withData($data);
    }
}
