<?php

declare(strict_types=1);

namespace App\Containers\Authentication\Notifications;

use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    public function __construct(public string $token) {}

    public function via(CanResetPassword $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(CanResetPassword $notifiable): MailMessage
    {
        $email = $notifiable->getEmailForPasswordReset();

        $url = config('app.frontend_url').'/reset-password?token='.$this->token.'&email='.urlencode($email);

        return (new MailMessage)
            ->subject('Reset your password')
            ->line('Click the button below to reset your password:')
            ->action('Reset Password', $url)
            ->line('If you did not request a password reset, no further action is required.');
    }
}
