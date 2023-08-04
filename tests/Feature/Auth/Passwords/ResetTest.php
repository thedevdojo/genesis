<?php

namespace Tests\Feature\Auth\Passwords;

use Tests\TestCase;
use App\Models\User;
use Livewire\Volt\Volt;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\FragmentAlias;

class ResetTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_view_password_reset_page()
    {
        $user = User::factory()->create();

        $token = Str::random(16);

        DB::table('password_reset_tokens')->insert([
            'email' => $user->email,
            'token' => Hash::make($token),
            'created_at' => Carbon::now(),
        ]);

        $this->get(url('/auth/password', [
            'token' => $token,
        ]).'?email='.$user->email)
            ->assertSuccessful()
            ->assertSee($user->email)
            ->assertSeeLivewire(
                FragmentAlias::encode(
                    componentName: 'auth.password.token',
                    path: resource_path('views/pages/auth/password/[token].blade.php')
                )
            );
    }

    /** @test */
    public function can_reset_password()
    {
        $user = User::factory()->create();

        $token = Str::random(16);

        DB::table('password_reset_tokens')->insert([
            'email' => $user->email,
            'token' => Hash::make($token),
            'created_at' => Carbon::now(),
        ]);

        Volt::test('auth.password.token', [
            'token' => $token,
        ])
            ->set('email', $user->email)
            ->set('password', 'new-password')
            ->set('passwordConfirmation', 'new-password')
            ->call('resetPassword');

        $this->assertTrue(Auth::attempt([
            'email' => $user->email,
            'password' => 'new-password',
        ]));
    }

    /** @test */
    public function token_is_required()
    {
        Volt::test('auth.password.token', [
            'token' => null,
        ])
            ->call('resetPassword')
            ->assertHasErrors(['token' => 'required']);
    }

    /** @test */
    public function email_is_required()
    {
        Volt::test('auth.password.token', [
            'token' => Str::random(16),
        ])
            ->set('email', null)
            ->call('resetPassword')
            ->assertHasErrors(['email' => 'required']);
    }

    /** @test */
    public function email_is_valid_email()
    {
        Volt::test('auth.password.token', [
            'token' => Str::random(16),
        ])
            ->set('email', 'email')
            ->call('resetPassword')
            ->assertHasErrors(['email' => 'email']);
    }

    /** @test */
    function password_is_required()
    {
        Volt::test('auth.password.token', [
            'token' => Str::random(16),
        ])
            ->set('password', '')
            ->call('resetPassword')
            ->assertHasErrors(['password' => 'required']);
    }

    /** @test */
    function password_is_minimum_of_eight_characters()
    {
        Volt::test('auth.password.token', [
            'token' => Str::random(16),
        ])
            ->set('password', 'secret')
            ->call('resetPassword')
            ->assertHasErrors(['password' => 'min']);
    }

    /** @test */
    function password_matches_password_confirmation()
    {
        Volt::test('auth.password.token', [
            'token' => Str::random(16),
        ])
            ->set('password', 'new-password')
            ->set('passwordConfirmation', 'not-new-password')
            ->call('resetPassword')
            ->assertHasErrors(['password' => 'same']);
    }
}
