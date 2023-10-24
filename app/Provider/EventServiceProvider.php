<?php

namespace App\Provider;

use App\Event\Event;
use App\Exception\NoListenerEventException;
use App\Event\{OpenEvent, RequestEvent, StartEvent, MessageEvent};
use App\Listener\{Listener, MessageLogListener, OpenListener, RequestListener, StartListener, MessageListener};

class EventServiceProvider
{

    private static array $listen = [
        StartEvent::class => [
            StartListener::class,
        ],
        OpenEvent::class => [
            OpenListener::class,
        ],
        MessageEvent::class => [
            MessageListener::class,
            MessageLogListener::class,
        ],
        RequestEvent::class => [
            RequestListener::class,
        ]
    ];

    /**
     * @throws NoListenerEventException
     */
    public static function dispatcher(Event $event): void
    {
        if (empty(self::$listen[$event::class])) {
            throw new NoListenerEventException(
                'Nenhum listener esta reagindo ao evento ' . $event::class);
        }

        /** @var Listener $listener */
        foreach (self::$listen[$event::class] as $listener) {
            $listener = new $listener($event);
            $listener->resolve();
        }
    }

}