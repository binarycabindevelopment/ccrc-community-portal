<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AccountBillingTest extends TestCase
{

    use DatabaseMigrations;

    public function test_requires_management_access()
    {
        $auth = factory(\App\User::class)->create([
            'is_ccrc_manager' => false,
        ]);
        $response = $this->actingAs($auth)->get('/account/billing');
        $response->assertRedirect('/dashboard');
    }

    public function test_show()
    {
        $auth = factory(\App\User::class)->create([
            'is_ccrc_manager' => true,
        ]);
        $response = $this->actingAs($auth)->get('/account/billing');
        $response->assertStatus(200);
    }

    public function test_show_displays_current_billing_details()
    {
        $this->markTestIncomplete();
    }

    public function test_show_displays_payment_history()
    {
        $this->markTestIncomplete();
    }

    public function test_show_displays_amount_due()
    {
        $this->markTestIncomplete();
    }

    public function test_edit()
    {
        $auth = factory(\App\User::class)->create([
            'is_ccrc_manager' => true,
        ]);
        $response = $this->actingAs($auth)->get('/account/billing/edit');
        $response->assertStatus(200);
    }

    public function test_update()
    {
        $this->markTestIncomplete();
    }

}
