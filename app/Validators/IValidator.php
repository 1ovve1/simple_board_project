<?php declare(strict_types=1);

namespace Lowel\Workproject\App\Validators;

interface IValidator
{
    function validate($args = []): array;
}