<?php declare(strict_types=1);

namespace Lowel\Workproject\DB;

use RuntimeException;

class UnknownDbProperty extends RuntimeException
{
    const MESSAGE = "Unknown property '%s' in db.php configuration";

    /**
     * @inheritDoc
     */
    public function __construct(string $property_name)
    {
        parent::__construct(
            sprintf(self::MESSAGE, $property_name),
            33
        );
    }


}