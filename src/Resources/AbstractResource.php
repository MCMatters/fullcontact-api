<?php

declare(strict_types = 1);

namespace McMatters\FullContactApi\Resources;

use GuzzleHttp\Client;
use McMatters\FullContactApi\Exceptions\FullContactException;
use Throwable;
use const true;
use function array_merge_recursive, is_string, json_decode, json_encode;

/**
 * Class AbstractResource
 *
 * @package McMatters\FullContactApi\Resources
 */
abstract class AbstractResource
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * AbstractResource constructor.
     *
     * @param string $apiKey
     */
    public function __construct(string $apiKey)
    {
        $this->client = new Client([
            'base_uri' => 'https://api.fullcontact.com/v2/',
            'headers'  => [
                'X-FullContact-APIKey' => $apiKey,
            ],
        ]);
    }

    /**
     * @param string $uri
     * @param array $query
     *
     * @return array
     * @throws FullContactException
     */
    protected function requestGet(string $uri, array $query = []): array
    {
        return $this->request('GET', $uri, ['query' => $query]);
    }

    /**
     * @param string $uri
     * @param array $data
     *
     * @return array
     * @throws FullContactException
     */
    protected function requestPost(string $uri, $data = []): array
    {
        if (!is_string($data)) {
            $data = json_encode($data);
        }

        return $this->request('POST', $uri, ['json' => $data]);
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array $options
     *
     * @return array
     * @throws FullContactException
     */
    protected function request(
        string $method,
        string $uri,
        array $options
    ): array {
        try {
            $response = $this->client->request(
                $method,
                $uri,
                array_merge_recursive($this->client->getConfig(), $options)
            );

            return json_decode($response->getBody()->getContents(), true);
        } catch (Throwable $e) {
            throw new FullContactException('', 0, $e);
        }
    }
}
