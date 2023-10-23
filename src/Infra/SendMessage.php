<?php

declare(strict_types=1);

namespace App\Infra;

use App\Entity\Message;

class SendMessage
{

    public function __construct(
        private App $app,
        private Message $message,
    )
    {
    }

    public function send()
    {
        $this->app->getServer()->push('', '');
    }

}