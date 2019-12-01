<?php

declare(strict_types = 1);

namespace McMatters\FullContactApi;

use McMatters\FullContactApi\Resources\CompanyResource;
use McMatters\FullContactApi\Resources\PersonResource;

/**
 * Class FullContactClient
 *
 * @package McMatters\FullContactApi
 */
class FullContactClient
{
    /**
     * @var string
     */
    protected $apiKey;

    /**
     * @var array
     */
    protected $resources = [];

    /**
     * FullContactClient constructor.
     *
     * @param string $apiKey
     */
    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @return \McMatters\FullContactApi\Resources\CompanyResource
     */
    public function company(): CompanyResource
    {
        return $this->getResource('company', CompanyResource::class);
    }

    /**
     * @return \McMatters\FullContactApi\Resources\PersonResource
     */
    public function person(): PersonResource
    {
        return $this->getResource('person', PersonResource::class);
    }

    /**
     * @param string $resource
     * @param string $class
     *
     * @return mixed
     */
    protected function getResource(string $resource, string $class)
    {
        if (!isset($this->resources[$resource])) {
            $this->resources[$resource] = new $class($this->apiKey);
        }

        return $this->resources[$resource];
    }
}
