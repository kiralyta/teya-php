<?php

namespace Kiralyta\TeyaPhp;

use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use Kiralyta\TeyaPhp\Exceptions\TeyaClientException;
use Kiralyta\TeyaPhp\Responses\AuthResponse;
use Kiralyta\TeyaPhp\Responses\TokenResponse;

class TeyaClient
{
    protected string $url = 'https://api.cloud.saltpay.co';
    protected string $authUrl = 'https://identity.cloud.saltpay.co/oauth/v2/device';
    protected string $tokenUrl = 'https://identity.cloud.saltpay.co/oauth/v2/oauth-token';

    protected Client $client;
    protected array  $lastRequest;
    protected array  $lastResponse;
    protected int    $lastRequestTime; // milliseconds

    public function __construct(
        protected bool $testing = false
    ) {

        $this->client = new Client([
            'base_uri' => $this->url,
        ]);
    }

    public function message(
        array  $json,
        string $uri,
        string $accessToken,
        string $method = 'post'
    ): array {
        return $this->request(
            params: $json,
            uri:    $uri,
            method: $method,
            headers: ['Authorization' => 'Bearer '.$accessToken]
        );
    }

    public function auth(string $clientId, string $clientSecret): AuthResponse
    {
        $form = [
            'client_id'     => $clientId,
            'client_secret' => $clientSecret,
        ];

        $response = $this->request(
            uri:         $this->authUrl,
            params:      $form,
            formRequest: true
        );

        return new AuthResponse(
            userCode:                $response['user_code'],
            deviceCode:              $response['device_code'],
            qrCode:                  $response['qr_code'],
            verificationUrlComplete: $response['verification_url_complete'],
        );
    }

    public function token(
        string  $clientId,
        string  $clientSecret,
        string  $deviceCode,
        ?string $refreshToken = null
    ): TokenResponse {
        $grantType = $refreshToken !== null
            ? 'refresh_token'
            : 'urn:ietf:params:oauth:grant-type:device_code';

        $form = [
            'client_id'     => $clientId,
            'client_secret' => $clientSecret,
            'grant_type'    => $grantType,
            'device_code'   => $deviceCode
        ];

        if ($refreshToken !== null) {
            $form['refresh_token'] = $refreshToken;
        }

        $response = $this->request(
            uri:         $this->tokenUrl,
            params:      $form,
            formRequest: true
        );

        return new TokenResponse(
            accessToken: $response['access_token'],
            refreshToken: $response['refresh_token'],
            expiresIn: $response['expires_in']
        );
    }

    public function request(
        array  $params,
        string $uri,
        string $method = 'post',
        bool   $formRequest = false,
        array  $headers = [],
    ): array {
        try {
            $this->lastRequest = $params;

            if ($this->testing) {
                $headers['Mock-Response'] = true;
            }

            $guzzleOption = $formRequest
                ? 'form_params'
                : 'json';

            $start = Carbon::now();

            $response = $this->client->request(
                $method,
                $uri,
                [
                    $guzzleOption => $params,
                    'headers'     => $headers,
                ]
            );

            $this->lastRequestTime = Carbon::now()->diffInMilliseconds($start);

        } catch (RequestException $e) {
            throw new TeyaClientException(
                message: $e->getResponse()->getBody()->getContents(),
                code:    $e->getCode()
            );
        } catch (ClientException $e) {
            throw new TeyaClientException(
                message: $e->getMessage(),
                code:    $e->getCode()
            );
        }

        return $this->buildResponse($response);
    }

    protected function buildResponse($response): array
    {
        return $this->lastResponse = is_array($response)
            ? $response
            : json_decode($response->getBody(), true) ?? [];
    }

    public function url(): string
    {
        return $this->url;
    }

    public function lastRequest(): ?array
    {
        return $this->lastRequest;
    }

    public function lastResponse(): ?array
    {
        return $this->lastResponse;
    }

    public function lastRequestTime(): ?int
    {
        return $this->lastRequestTime;
    }
}
