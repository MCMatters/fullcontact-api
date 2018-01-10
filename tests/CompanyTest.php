<?php

declare(strict_types = 1);

namespace McMatters\FullContactApi\Tests;

use InvalidArgumentException;
use const true;
use function in_array, is_array;

/**
 * Class CompanyTest
 *
 * @package McMatters\FullContactApi\Tests
 */
class CompanyTest extends TestCase
{
    /**
     * @throws \McMatters\FullContactApi\Exceptions\FullContactException
     * @throws \PHPUnit\Framework\Exception
     */
    public function testLookupByDomain(): void
    {
        $result = $this->client->company()->lookupByDomain('amgrade.com');

        $this->assertArrayHasKey('status', $result);
        $this->assertSame(200, $result['status']);
        $this->assertArrayHasKey('organization', $result);
        $this->assertSame('AMgrade', $result['organization']['name']);
    }

    /**
     * @throws InvalidArgumentException
     * @throws \McMatters\FullContactApi\Exceptions\FullContactException
     * @throws \PHPUnit\Framework\AssertionFailedError
     * @throws \PHPUnit\Framework\Exception
     */
    public function testLookupByCompanyName(): void
    {
        $result = $this->client->company()->lookupByCompanyName('AMgrade');

        $this->assertTrue(is_array($result));
        $this->assertCount(2, $result);

        $domains = ['amgrade.de', 'amgrade.com'];

        foreach ($result as $item) {
            $this->assertArrayHasKey('lookupDomain', $item);
            $this->assertTrue(in_array($item['lookupDomain'], $domains, true));
        }
    }

    /**
     * @throws InvalidArgumentException
     * @throws \McMatters\FullContactApi\Exceptions\FullContactException
     * @throws \PHPUnit\Framework\Exception
     */
    public function testLookupByCompanyNameWithException(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->client->company()->lookupByCompanyName('AMgrade', 'foobar');
    }
}
