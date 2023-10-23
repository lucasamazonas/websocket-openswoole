<?php

declare(strict_types=1);

namespace App\Entity;

use JsonSerializable;

class Message
{

    private User $from;

    /** @var User[] */
    private array $do;

    private JsonSerializable $data;

}