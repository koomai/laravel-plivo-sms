<?php

namespace Koomai\Plivo\Notifications;

use Illuminate\Notifications\Notification;
use Koomai\Plivo\Plivo;
use PlivoMessage;

class PlivoSmsChannel
{
    /**
     * The Plivo instance.
     *
     * @var \Koomai\Plivo\Plivo;
     */
    protected $plivo;

    /**
     * The phone number notifications should be sent from.
     *
     * @var string
     */
    protected $from;

    /**
     * Create a new Plivo channel instance.
     *
     * @param  \Koomai\Plivo\Plivo  $plivo
     * @return void
     */
    public function __construct(Plivo $plivo)
    {
        $this->plivo = $plivo;
        $this->from = $this->plivo->from();
    }

    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        if (! $to = $notifiable->routeNotificationFor('plivo')) {
            return;
        }

        $message = $notification->toPlivo($notifiable);

        if (is_string($message)) {
            $message = new PlivoMessage($message);
        }

        $this->plivo->send_message([
            'src' => $message->from ?: $this->from,
            'dst' => $to,
            'text' => trim($message->content),
        ]);
    }
}
