<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\HtmlString;

class VerifyEmailWithCode extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject(__('Verify Your Email Address'))
            ->greeting(__('Hello ' . $notifiable->name . ','))
            ->line(__('Thank you for registering with us. To complete your registration, please use the verification code below:'))
            ->line(new HtmlString(
                '<div style="text-align:center; margin:20px 0;">
                    <span style="display:inline-block; background:#f4f4f4; padding:15px 25px;
                        border-radius:8px; font-size:24px; letter-spacing:4px; font-weight:bold; color:#333;">
                        ' . $notifiable->verify_code . '
                    </span>
                </div>'
            ))
            ->line(__('This code will expire in 24 hours.'))
            ->line(__('If you did not create an account, please ignore this email.'))
            ->salutation(__('Best regards'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
