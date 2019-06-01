<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AccountUserTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_edit_requires_auth()
    {
        $response = $this->get('/account/user');
        $response->assertStatus(302);
    }

    public function test_edit()
    {
        $auth = factory(\App\User::class)->create();
        $response = $this->actingAs($auth)->get('/account/user');
        $response->assertStatus(200);
    }

    public function test_update_email()
    {
        $this->withoutExceptionHandling();
        $auth = factory(\App\User::class)->create();
        $originalPasswordHash = $auth->password;
        $newEmail = 'newemail@email.com';
        $response = $this->actingAs($auth)->patch('/account/user',[
            'first_name' => $auth->first_name,
            'last_name' => $auth->last_name,
            'email' => $newEmail,
            'password' => '',
            'company_name' => $auth->company_name,
        ]);
        $response->assertRedirect('/account/user');
        $user = \App\User::find($auth->id);
        $this->assertEquals($newEmail,$user->email);
        $this->assertEquals($originalPasswordHash,$user->password);
    }

    public function test_update_password()
    {
        $auth = factory(\App\User::class)->create();
        $newPassword = 'newPassword100';
        $response = $this->actingAs($auth)->patch('/account/user',[
            'first_name' => $auth->first_name,
            'last_name' => $auth->last_name,
            'email' => $auth->email,
            'company_name' => $auth->company_name,
            'password' => $newPassword,
        ]);
        $response->assertRedirect('/account/user');
        $user = \App\User::find($auth->id);
        $this->assertTrue(\Auth::attempt([
            'email' => $auth->email,
            'password' => $newPassword,
        ]));
    }

    public function test_update_ccrc_manager()
    {
        $auth = factory(\App\User::class)->create();
        $response = $this->actingAs($auth)->patch('/account/user',[
            'first_name' => $auth->first_name,
            'last_name' => $auth->last_name,
            'email' => $auth->email,
            'company_name' => $auth->company_name,
            'is_ccrc_manager' => 1,
        ]);
        $response->assertRedirect('/account/user');
        $user = \App\User::find($auth->id);
        $this->assertEquals(true,boolval($user->is_ccrc_manager));
        $response = $this->actingAs($auth)->patch('/account/user',[
            'first_name' => $auth->first_name,
            'last_name' => $auth->last_name,
            'email' => $auth->email,
            'company_name' => $auth->company_name,
            'is_ccrc_manager' => null,
        ]);
        $response->assertRedirect('/account/user');
        $user = \App\User::find($auth->id);
        $this->assertEquals(false,boolval($user->is_ccrc_manager));
    }

    //TODO - Avatar
}
