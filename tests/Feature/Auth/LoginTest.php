<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use Livewire\Volt\Volt;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_view_login_page()
    {
        $this->get('/auth/login')
            ->assertSuccessful();
    }

    /** @test */
    public function is_redirected_if_already_logged_in()
    {
        $user = User::factory()->create();

        $this->be($user)
            ->get('/auth/login')
            ->assertRedirect(route('home'));
    }

    /** @test */
    public function a_user_can_login_and_is_redirected()
    {
        $user = User::factory()->create();

        Volt::test('auth.login')
            ->set([
                'email' => $user->email,
                'password' => 'password',
            ])
            ->call('authenticate')
            ->assertRedirect('/');

        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function login_requires_both_email_and_password()
    {
        Volt::test('auth.login')
            ->set([
                'email' => '',
                'password' => 'password',
            ])
            ->call('authenticate')
            ->assertHasNoErrors('password')
            ->assertHasErrors(['email' => ['required']])
            ->set([
                'email' => 'test@example.com',
                'password' => '',
            ])
            ->call('authenticate')
            ->assertHasNoErrors('email')
            ->assertHasErrors(['password' => ['required']]);
    }

    /** @test */
    public function email_must_be_valid_email()
    {
        Volt::test('auth.login')
            ->set('email', 'invalid-email')
            ->set('password', 'password')
            ->call('authenticate')
            ->assertHasErrors(['email' => ['email']]);
    }

    /** @test */
    public function bad_login_attempt_shows_message()
    {
        $user = User::factory()->create();

        Volt::test('auth.login')
            ->set([
                'email' => $user->email,
                'password' => 'bad-password',
            ])
            ->call('authenticate')
            ->assertHasErrors('email')
            ->assertSee('These credentials do not match our records.');

        $this->assertGuest();
    }
}
