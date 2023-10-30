<?php

declare(strict_types=1);

namespace App\Entity;

use OpenSwoole\WebSocket\Frame;

class MessageClient
{

    public readonly int $from;

    /** @var int[] */
    public readonly array $to;

    public readonly string|null $content;

    public function __construct(Frame $frame)
    {
        $data = json_decode($frame->data, true);
        $this->from = $data['from'];
        $this->to = array_map(fn($id) => (int) $id, $data['to']);
        $this->content = json_encode($data['content']);
    }

}