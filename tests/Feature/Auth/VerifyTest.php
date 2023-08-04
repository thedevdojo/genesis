<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Livewire\Volt\Volt;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Notification;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;

class VerifyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_view_verification_page()
    {
        $user = User::factory()->create([
            'email_verified_at' => null,
        ]);

        $this
            ->be($user)
            ->get('/auth/verify')
            ->assertSuccessful();
    }

    /** @test */
    public function can_resend_verification_email()
    {
        Notification::fake();

        $user = User::factory()->create();

        $this->be($user);

        Volt::test('auth.verify')
            ->call('resend')
            ->assertDispatched('resent');

        Notification::assertSentTo($user, VerifyEmail::class);
    }

    /** @test */
    public function can_verify()
    {
        $user = User::factory()->create([
            'email_verified_at' => null,
        ]);

        Event::fake();

        $url = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(config('auth.verification.expire', 60)),
            ['id' => $user->getKey(), 'hash' => sha1($user->getEmailForVerification())]
        );

        $this
            ->be($user)
            ->get($url)
            ->assertRedirect(route('home'));

        Event::assertDispatched(Verified::class);
        $this->assertTrue($user->fresh()->hasVerifiedEmail());
    }

    /** @test */
    public function can_not_verify_invalid_hash()
    {
        $user = User::factory()->create([
            'email_verified_at' => null,
        ]);

        $url = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(config('auth.verification.expire', 60)),
            ['id' => $user->getKey(), 'hash' => sha1('invalid-email')]
        );

        $this
            ->be($user)
            ->get($url)
            ->assertForbidden();

        $this->assertFalse($user->fresh()->hasVerifiedEmail());
    }
}
