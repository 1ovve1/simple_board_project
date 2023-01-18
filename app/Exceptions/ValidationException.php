<?php declare(strict_types=1);

namespace Lowel\Workproject\App\Exceptions;

use Exception;

class ValidationException extends Exception
{
    public array $errors;

    /**
     * Username that was wrong or not found
     * @param string $type
     * @param string $message
     */
    public function __construct(string $type, string $message)
    {
        $this->errors[$type] = $message;

        parent::__construct();
    }

    function getErrors(): array
    {
        return $this->errors;
    }
}