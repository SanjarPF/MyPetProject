<?php
declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Event;
use App\Ship\Events\UserRegisteredEvent;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterUserTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register_and_event_is_dispatched(): void
    {
        Event::fake();

        $payload = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'secret123',
        ];

        $response = $this->postJson('/api/auth/register', $payload);

        $response->assertStatus(200);

        $response->assertJsonStructure(['token']);

        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
        ]);

        Event::assertDispatched(UserRegisteredEvent::class, function ($event) {
            return $event->user->email === 'test@example.com';
        });

        $user = User::query()->where('email', 'test@example.com')->first();
        $this->assertTrue(Hash::check('secret123', $user->password));
    }
}
