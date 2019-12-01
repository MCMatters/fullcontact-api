<?php

declare(strict_types = 1);

namespace McMatters\FullContactApi\Resources;

use McMatters\Ticl\Client;

/**
 * Class AbstractResource
 *
 * @package McMatters\FullContactApi\Resources
 */
abstract class AbstractResource
{
    /**
     * @var \McMatters\Ticl\Client
     */
    protected $httpClient;

    /**
     * AbstractResource constructor.
     *
     * @param string $apiKey
     */
    public function __construct(string $apiKey)
    {
        $this->httpClient = new Client([
            'base_uri' => 'https://api.fullcontact.com/v2',
            'headers'  => [
                'X-FullContact-APIKey' => $apiKey,
            ],
        ]);
    }
}
