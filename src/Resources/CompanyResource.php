<?php

declare(strict_types = 1);

namespace McMatters\FullContactApi\Resources;

use InvalidArgumentException;
use McMatters\FullContactApi\Exceptions\FullContactException;
use const false, true;
use function array_replace, in_array, urlencode;

/**
 * Class CompanyResource
 *
 * @package McMatters\FullContactApi\Resources
 */
class CompanyResource extends AbstractResource
{
    /**
     * @param string $domain
     * @param bool $keyPeople
     *
     * @return array
     * @throws FullContactException
     */
    public function lookupByDomain(
        string $domain,
        bool $keyPeople = false
    ): array {
        return $this->requestGet(
            'company/lookup.json',
            ['domain' => $domain, 'keyPeople' => $keyPeople]
        );
    }

    /**
     * @param string $company
     * @param string $sort
     * @param array $locationFilters
     *
     * @return array
     * @throws InvalidArgumentException
     * @throws FullContactException
     */
    public function lookupByCompanyName(
        string $company,
        string $sort = 'traffic',
        array $locationFilters = []
    ): array {
        if (!in_array($sort, ['traffic', 'relevance', 'employees'], true)) {
            throw new InvalidArgumentException(
                '$sort must be "traffic", "relevance" or "employees"'
            );
        }

        return $this->requestGet(
            'company/search.json',
            array_replace(
                $locationFilters,
                ['sort' => $sort, 'companyName' => urlencode($company)]
            )
        );
    }
}
