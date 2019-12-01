<?php

declare(strict_types = 1);

namespace McMatters\FullContactApi\Resources;

use function urlencode;

use const false;

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
     */
    public function lookupByDomain(
        string $domain,
        bool $keyPeople = false
    ): array {
        return $this->httpClient
            ->withQuery(['domain' => $domain, 'keyPeople' => $keyPeople])
            ->get('company/lookup.json')
            ->json();
    }

    /**
     * @param string $company
     * @param string $sort
     * @param array $locationFilters
     *
     * @return array
     */
    public function lookupByCompanyName(
        string $company,
        string $sort = 'traffic',
        array $locationFilters = []
    ): array {
        return $this->httpClient
            ->withQuery(
                ['sort' => $sort, 'companyName' => urlencode($company)] + $locationFilters
            )
            ->get('company/search.json')
            ->json();
    }
}
