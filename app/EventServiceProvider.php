<?php

declare(strict_types=1);

namespace App;

use App\Event\{DisconnectEvent, MessageClientEvent, MessageServerEvent, OpenEvent, RequestEvent, StartEvent};
use App\Event\Event;
use App\Exception\EventHasNoListenersException;
use App\Listener\{DisconnectListener,
    Listener,
    MessageClientToMessageServerListener,
    MessageListener,
    MessageLogListener,
    OpenListener,
    RequestListener,
    StartListener};

class EventServiceProvider
{

    private static array $listen = [
        StartEvent::class => [
            StartListener::class,
        ],
        OpenEvent::class => [
            OpenListener::class,
        ],
        MessageClientEvent::class => [
            MessageClientToMessageServerListener::class,
        ],
        MessageServerEvent::class => [
            MessageListener::class,
            MessageLogListener::class,
        ],
        RequestEvent::class => [
            RequestListener::class,
        ],
        DisconnectEvent::class => [
            DisconnectListener::class,
        ]
    ];

    /**
     * @throws EventHasNoListenersException
     */
    public static function dispatcher(Event $event): void
    {
        if (empty(self::$listen[$event::class])) {
            throw new EventHasNoListenersException(
                'Nenhum listener esta reagindo ao evento ' . $event::class);
        }

        /** @var Listener $listener */
        foreach (self::$listen[$event::class] as $listener) {
            $listener = new $listener($event);
            $listener->resolve();
        }
    }

}