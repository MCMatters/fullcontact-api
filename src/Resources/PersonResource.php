<?php

declare(strict_types = 1);

namespace McMatters\FullContactApi\Resources;

use function array_filter;

use const null;

/**
 * Class PersonResource
 *
 * @package McMatters\FullContactApi\Resources
 */
class PersonResource extends AbstractResource
{
    /**
     * @param string $email
     *
     * @return array
     */
    public function lookupByEmail(string $email): array
    {
        return $this->httpClient
            ->withQuery(['email' => $email])
            ->get('person.json')
            ->json();
    }

    /**
     * @param string $emailMd5
     *
     * @return array
     */
    public function lookupByEmailMd5(string $emailMd5): array
    {
        return $this->httpClient
            ->withQuery(['emailMD5' => $emailMd5])
            ->get('person.json')
            ->json();
    }

    /**
     * @param string $emailSha256
     *
     * @return array
     */
    public function lookupByEmailSha256(string $emailSha256): array
    {
        return $this->httpClient
            ->withQuery(['emailSHA256' => $emailSha256])
            ->get('person.json')
            ->json();
    }

    /**
     * @param string $phone
     * @param string|null $countryCode
     *
     * @return array
     */
    public function lookupByPhone(
        string $phone,
        string $countryCode = null
    ): array {
        return $this->httpClient
            ->withQuery(array_filter(['phone' => $phone, 'countryCode' => $countryCode]))
            ->get('person.json')
            ->json();
    }

    /**
     * @param string $twitter
     *
     * @return array
     */
    public function lookupByTwitter(string $twitter): array
    {
        return $this->httpClient
            ->withQuery(['twitter' => $twitter])
            ->get('person.json')
            ->json();
    }
}
