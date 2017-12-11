<?php

declare(strict_types = 1);

namespace McMatters\FullContactApi\Resources;

use InvalidArgumentException;
use McMatters\FullContactApi\Exceptions\FullContactException;
use const null, FILTER_VALIDATE_EMAIL;
use function array_filter, filter_var;

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
     * @throws InvalidArgumentException
     * @throws FullContactException
     */
    public function lookupByEmail(string $email): array
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Please provide valid email.');
        }

        return $this->requestGet('person.json', ['email' => $email]);
    }

    /**
     * @param string $emailMd5
     *
     * @return array
     * @throws FullContactException
     */
    public function lookupByEmailMd5(string $emailMd5): array
    {
        return $this->requestGet('person.json', ['emailMD5' => $emailMd5]);
    }

    /**
     * @param string $emailSha256
     *
     * @return array
     * @throws FullContactException
     */
    public function lookupByEmailSha256(string $emailSha256): array
    {
        return $this->requestGet('person.json', ['emailSHA256' => $emailSha256]);
    }

    /**
     * @param string $phone
     * @param string|null $countryCode
     *
     * @return array
     * @throws FullContactException
     */
    public function lookupByPhone(
        string $phone,
        string $countryCode = null
    ): array {
        return $this->requestGet(
            'person.json',
            array_filter(['phone' => $phone, 'countryCode' => $countryCode])
        );
    }

    /**
     * @param string $twitter
     *
     * @return array
     * @throws FullContactException
     */
    public function lookupByTwitter(string $twitter): array
    {
        return $this->requestGet('person.json', ['twitter' => $twitter]);
    }
}
