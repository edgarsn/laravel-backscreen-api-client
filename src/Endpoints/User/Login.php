<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Endpoints\User;

use Newman\LaravelTmsApiClient\AbstractEndpoint;
use Newman\LaravelTmsApiClient\Contracts\EndpointContract;
use Newman\LaravelTmsApiClient\Enums\AuthMethodEnum;
use Newman\LaravelTmsApiClient\Enums\HttpMethodEnum;
use Newman\LaravelTmsApiClient\HttpClient\PendingRequest;

/**
 * @link https://api.cloudycdn.services/api/v5/docs#/operations/User/Login
 */
class Login extends AbstractEndpoint implements EndpointContract
{
    protected ?string $twoFaCode = null;

    /**
     * @var array<string>|null
     */
    protected ?array $return = null;

    public function __construct(protected string $email, protected string $password)
    {
    }

    public function twoFaCode(?string $code): static
    {
        $this->twoFaCode = $code;

        return $this;
    }

    /**
     * @param array<string>|null $return
     * @return $this
     */
    public function return(?array $return): static
    {
        $this->return = $return;

        return $this;
    }

    /**
     * Define which authentication methods are allowed to call this endpoint.
     *
     * @return AuthMethodEnum[]
     */
    public function allowedAuthMethods(): array
    {
        return [AuthMethodEnum::NULL];
    }

    /**
     * HTTP Method to use for request.
     *
     * @return HttpMethodEnum
     */
    public function useHttpMethod(): HttpMethodEnum
    {
        return HttpMethodEnum::POST;
    }

    /**
     * Endpoint url.
     *
     * @return string
     */
    public function endpointUrl(): string
    {
        return '/User/Login';
    }

    /**
     * Prepares HTTP request for this endpoint.
     *
     * @param PendingRequest $http
     * @return void
     */
    public function prepareHttpRequest(PendingRequest $http): void
    {
        $data = [
            'email' => $this->email,
            'password' => $this->password,
        ];

        if ($this->twoFaCode !== null) {
            $data['mfa'] = [
                '2fa_code' => $this->twoFaCode,
            ];
        }

        if ($this->return !== null) {
            $data['return'] = $this->return;
        }

        $http->withData($data);
    }
}
