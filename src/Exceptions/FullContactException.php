<?php

declare(strict_types = 1);

namespace McMatters\FullContactApi\Exceptions;

use Exception;
use Throwable;
use const null;
use function is_callable;

/**
 * Class FullContactException
 *
 * @package McMatters\FullContactApi\Exceptions
 */
class FullContactException extends Exception
{
    /**
     * FullContactException constructor.
     *
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(
        string $message = '',
        int $code = 0,
        Throwable $previous = null
    ) {
        parent::__construct(
            $this->setMessage($message, $previous),
            $this->setCode($code),
            $previous
        );
    }

    /**
     * @param string $message
     * @param Throwable|null $previous
     *
     * @return string
     */
    protected function setMessage(
        string $message = '',
        Throwable $previous = null
    ): string {
        if ($message) {
            return $message;
        }

        if (null !== $previous) {
            return $previous->getMessage();
        }

        return '';
    }

    /**
     * @param int $code
     * @param Throwable|null $previous
     *
     * @return int
     */
    protected function setCode(int $code = 0, Throwable $previous = null): int
    {
        if (null !== $previous) {
            if (is_callable([$previous, 'getResponse'])) {
                $response = $previous->getResponse();

                if (is_callable([$response, 'getStatusCode'])) {
                    return $response->getStatusCode();
                }
            } else {
                return $previous->getCode();
            }
        }

        return $code;
    }
}
