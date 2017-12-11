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
     * @var CompanyResource
     */
    public $company;

    /**
     * @var PersonResource
     */
    public $person;

    /**
     * FullContactClient constructor.
     *
     * @param string $apiKey
     */
    public function __construct(string $apiKey)
    {
        $this->company = new CompanyResource($apiKey);
        $this->person = new PersonResource($apiKey);
    }
}
