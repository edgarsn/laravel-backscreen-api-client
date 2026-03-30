<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Endpoints\Folder;

use Newman\LaravelBackscreenApiClient\AbstractEndpoint;
use Newman\LaravelBackscreenApiClient\Contracts\EndpointContract;
use Newman\LaravelBackscreenApiClient\Endpoints\Folder\Create\Availability;
use Newman\LaravelBackscreenApiClient\Endpoints\Folder\Create\Embed;
use Newman\LaravelBackscreenApiClient\Endpoints\Folder\Create\ExternalUploads;
use Newman\LaravelBackscreenApiClient\Endpoints\Folder\Create\Ingest;
use Newman\LaravelBackscreenApiClient\Endpoints\Folder\Create\Language;
use Newman\LaravelBackscreenApiClient\Endpoints\Folder\Create\MultiAudio;
use Newman\LaravelBackscreenApiClient\Endpoints\Folder\Create\Security;
use Newman\LaravelBackscreenApiClient\Endpoints\Folder\Create\Transcoding;
use Newman\LaravelBackscreenApiClient\Endpoints\Folder\FolderList\TypeEnum;
use Newman\LaravelBackscreenApiClient\Enums\AuthMethodEnum;
use Newman\LaravelBackscreenApiClient\Enums\HttpMethodEnum;
use Newman\LaravelBackscreenApiClient\HttpClient\PendingRequest;

/**
 * @link https://api.cloudycdn.services/api/v5/docs#/operations/Folder/Create
 */
class Create extends AbstractEndpoint implements EndpointContract
{
    protected ?int $parent_id = null;

    protected ?int $inherit_parent = null;

    protected ?int $priority = null;

    protected ?int $create_ftp_folder = null;

    protected ?Embed $embed = null;

    protected ?Security $security = null;

    protected ?Transcoding $transcoding = null;

    protected ?Ingest $ingest = null;

    protected ?ExternalUploads $external_uploads = null;

    protected ?Language $language = null;

    protected ?MultiAudio $multi_audio = null;

    protected ?Availability $availability = null;

    public function __construct(protected TypeEnum $type, protected string $name) {}

    /**
     * System ID of folder under which to put new folder. Must be >= 0.
     */
    public function parentId(int $parent_id): static
    {
        if ($parent_id < 0) {
            throw new \InvalidArgumentException('parent_id must be >= 0');
        }

        $this->parent_id = $parent_id;

        return $this;
    }

    /**
     * Inherit flag. Allowed values: 0, 1.
     */
    public function inheritParent(int $inherit_parent): static
    {
        if (! \in_array($inherit_parent, [0, 1])) {
            throw new \InvalidArgumentException('inherit_parent must be 0 or 1');
        }

        $this->inherit_parent = $inherit_parent;

        return $this;
    }

    /**
     * -5: low; 0: normal; 5: high. Must be between -5 and 5.
     */
    public function priority(int $priority): static
    {
        if ($priority < -5 || $priority > 5) {
            throw new \InvalidArgumentException('priority must be between -5 and 5');
        }

        $this->priority = $priority;

        return $this;
    }

    /**
     * Create FTP folder flag. Allowed values: 0, 1.
     */
    public function createFtpFolder(int $create_ftp_folder): static
    {
        if (! \in_array($create_ftp_folder, [0, 1])) {
            throw new \InvalidArgumentException('create_ftp_folder must be 0 or 1');
        }

        $this->create_ftp_folder = $create_ftp_folder;

        return $this;
    }

    public function embed(?Embed $embed): static
    {
        $this->embed = $embed;

        return $this;
    }

    public function security(?Security $security): static
    {
        $this->security = $security;

        return $this;
    }

    public function transcoding(?Transcoding $transcoding): static
    {
        $this->transcoding = $transcoding;

        return $this;
    }

    public function ingest(?Ingest $ingest): static
    {
        $this->ingest = $ingest;

        return $this;
    }

    public function externalUploads(?ExternalUploads $external_uploads): static
    {
        $this->external_uploads = $external_uploads;

        return $this;
    }

    public function language(?Language $language): static
    {
        $this->language = $language;

        return $this;
    }

    public function multiAudio(?MultiAudio $multi_audio): static
    {
        $this->multi_audio = $multi_audio;

        return $this;
    }

    public function availability(?Availability $availability): static
    {
        $this->availability = $availability;

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
        return HttpMethodEnum::POST;
    }

    /**
     * Endpoint url.
     */
    public function endpointUrl(): string
    {
        return '/Folder/Create';
    }

    /**
     * Prepares HTTP request for this endpoint.
     */
    public function prepareHttpRequest(PendingRequest $http): void
    {
        $data = [
            'type' => $this->type->value,
            'name' => $this->name,
        ];

        if ($this->parent_id !== null) {
            $data['parent_id'] = $this->parent_id;
        }

        if ($this->inherit_parent !== null) {
            $data['inherit_parent'] = $this->inherit_parent;
        }

        if ($this->priority !== null) {
            $data['priority'] = $this->priority;
        }

        if ($this->create_ftp_folder !== null) {
            $data['create_ftp_folder'] = $this->create_ftp_folder;
        }

        if ($this->embed !== null) {
            $embed = $this->embed->compileAsArray();

            if (! empty($embed)) {
                $data['embed'] = $embed;
            }
        }

        if ($this->security !== null) {
            $security = $this->security->compileAsArray();

            if (! empty($security)) {
                $data['security'] = $security;
            }
        }

        if ($this->transcoding !== null) {
            $transcoding = $this->transcoding->compileAsArray();

            if (! empty($transcoding)) {
                $data['transcoding'] = $transcoding;
            }
        }

        if ($this->ingest !== null) {
            $ingest = $this->ingest->compileAsArray();

            if (! empty($ingest)) {
                $data['ingest'] = $ingest;
            }
        }

        if ($this->external_uploads !== null) {
            $external_uploads = $this->external_uploads->compileAsArray();

            if (! empty($external_uploads)) {
                $data['external_uploads'] = $external_uploads;
            }
        }

        if ($this->language !== null) {
            $language = $this->language->compileAsArray();

            if (! empty($language)) {
                $data['language'] = $language;
            }
        }

        if ($this->multi_audio !== null) {
            $multi_audio = $this->multi_audio->compileAsArray();

            if (! empty($multi_audio)) {
                $data['multi_audio'] = $multi_audio;
            }
        }

        if ($this->availability !== null) {
            $availability = $this->availability->compileAsArray();

            if (! empty($availability)) {
                $data['availability'] = $availability;
            }
        }

        $http->withData($data);
    }
}
