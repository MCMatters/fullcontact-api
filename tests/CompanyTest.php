<?php

declare(strict_types = 1);

namespace McMatters\FullContactApi\Tests;

use InvalidArgumentException;

/**
 * Class CompanyTest
 *
 * @package McMatters\FullContactApi\Tests
 */
class CompanyTest extends TestCase
{
    /**
     * @throws \PHPUnit\Framework\Exception
     */
    public function testLookupByDomain()
    {
        $result = $this->client->company()->lookupByDomain('amgrade.com');

        $this->assertArrayHasKey('status', $result);
        $this->assertSame(200, $result['status']);
        $this->assertArrayHasKey('organization', $result);
        $this->assertSame('AMgrade', $result['organization']['name']);
    }

    /**
     * @throws InvalidArgumentException
     * @throws \PHPUnit\Framework\AssertionFailedError
     * @throws \PHPUnit\Framework\Exception
     */
    public function testLookupByCompanyName()
    {
        $result = $this->client->company()->lookupByCompanyName('AMgrade');

        $this->assertCount(2, $result);

        $domains = ['amgrade.de', 'amgrade.com'];

        foreach ($result as $item) {
            $this->assertArrayHasKey('lookupDomain', $item);
            $this->assertContains($item['lookupDomain'], $domains);
        }
    }
}
