<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CheckoutNotification extends Notification
{
    use Queueable;

    protected $checkout;

    public function __construct($checkout)
    {
        $this->checkout = $checkout;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Checkout Confirmation')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('Your checkout for the book "' . $this->checkout->book->title . '" has been successfully processed.')
            ->line('Due Date: ' . $this->checkout->due_date)
            ->action('View Details', url('/member/checkout/' . $this->checkout->id))
            ->line('Thank you for using our library!');
    }
}
