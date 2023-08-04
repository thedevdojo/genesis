<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use Livewire\Volt\Volt;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function registration_page_contains_livewire_component()
    {
        $this->get('auth/register')
            ->assertSuccessful();
    }

    /** @test */
    public function is_redirected_if_already_logged_in()
    {
        $user = User::factory()->create();

        $this->be($user)
            ->get('auth/register')
            ->assertRedirect(route('home'));
    }

    /** @test */
    function a_user_can_register()
    {
        Event::fake();

        Volt::test('auth.register')
            ->set([
                'name' => 'Tall Stack',
                'email' => 'tallstack@example.com',
                'password' => 'password',
                'password_confirmation' => 'password',
            ])
            ->call('register')
            ->assertRedirect('/');

        $this->assertAuthenticated();

        Event::assertDispatched(Registered::class);
    }

    /** @test */
    function registration_requires_name_email_and_password()
    {
        Volt::test('auth.register')
            ->set([
                'name' => '',
                'email' => '',
                'password' => '',
            ])
            ->call('register')
            ->assertHasErrors([
                'name' => ['required'],
                'email' => ['required'],
                'password' => ['required'],
            ]);
    }

    /** @test */
    function email_is_valid_email()
    {
        Volt::test('auth.register')
            ->set('email', 'tallstack')
            ->call('register')
            ->assertHasErrors(['email' => ['email']]);
    }

    /** @test */
    function email_hasnt_been_taken_already()
    {
        $user = User::factory()->create();

        Volt::test('auth.register')
            ->set('email', $user->email)
            ->call('register')
            ->assertHasErrors(['email' => ['unique']]);
    }

    /** @test */
    function see_email_hasnt_already_been_taken_validation_message_as_user_types()
    {
        $user = User::factory()->create();

        Volt::test('auth.register')
            ->set('email', 'tallstack@example.com')
            ->assertHasNoErrors()
            ->set('email', $user->email)
            ->call('register')
            ->assertHasErrors(['email' => ['unique']]);

        $this->markTestSkipped('Need to be implement correctly.');
    }

    /** @test */
    function password_is_minimum_of_eight_characters()
    {
        Volt::test('auth.register')
            ->set([
                'password' => 'secret',
                'password_confirmation' => 'secret',
            ])
            ->call('register')
            ->assertHasErrors(['password' => ['min']]);
    }

    /** @test */
    function password_requires_password_confirmation()
    {
        Volt::test('auth.register')
            ->set([
                'password' => 'password',
                'password_confirmation' => 'not-password',
            ])
            ->call('register')
            ->assertHasErrors(['password' => ['confirmed']]);
    }
}
