<?php

declare(strict_types = 1);

namespace McMatters\FullContactApi\Tests;

use McMatters\FullContactApi\FullContactClient;
use PHPUnit\Framework\TestCase as BaseTestCase;
use function getenv;

/**
 * Class TestCase
 *
 * @package McMatters\FullContactApi\Tests
 */
abstract class TestCase extends BaseTestCase
{
    /**
     * @var FullContactClient
     */
    protected $client;

    /**
     * TestCase constructor.
     *
     * @param string|null $name
     * @param array $data
     * @param string $dataName
     */
    public function __construct(
        string $name = null,
        array $data = [],
        string $dataName = ''
    ) {
        parent::__construct($name, $data, $dataName);

        $this->client = new FullContactClient(getenv('FULLCONTACT_API_KEY'));
    }
}
