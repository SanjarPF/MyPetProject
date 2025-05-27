<?php

declare(strict_types=1);

namespace App\Ship\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public User $user) {}

    public function build(): self
    {
        return $this
            ->subject('Welcome to ' . config('app.name'))
            ->markdown('emails.welcome', ['user' => $this->user]);
    }
}
