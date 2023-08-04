<?php

namespace Tests\Feature\Auth\Passwords;

use Tests\TestCase;
use App\Models\User;
use Livewire\Volt\Volt;
use Livewire\Volt\FragmentAlias;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmailTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_view_password_request_page()
    {
        $this->get('/auth/password/reset')
            ->assertSuccessful()
            ->assertSeeLivewire(
                FragmentAlias::encode(
                    componentName: 'auth.password.reset',
                    path: resource_path('views/pages/auth/password/reset.blade.php')
                )
            );
    }

    /** @test */
    public function an_email_is_required_and_must_be_valid()
    {
        Volt::test('auth.password.reset')
            ->call('sendResetPasswordLink')
            ->assertHasErrors(['email' => ['required']])
            ->set('email', 'email')
            ->call('sendResetPasswordLink')
            ->assertHasErrors(['email' => ['email']]);
    }

    /** @test */
    public function a_user_who_enters_a_valid_email_address_will_get_sent_an_email()
    {
        $user = User::factory()->create();

        Volt::test('auth.password.reset')
            ->set('email', $user->email)
            ->call('sendResetPasswordLink')
            ->assertNotSet('emailSentMessage', false);

        $this->assertDatabaseHas('password_reset_tokens', [
            'email' => $user->email,
        ]);
    }
}
