<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Tests\TestCase;

class adminTest extends TestCase
{
    public function test_admin_view_dashboard()
    {
        $user = User::find('5ac8d461-cd11-49fd-97bd-bbc9ba62a362');  // cari user
        $response = $this->actingAs($user)->get('/dashboard'); // acting as itu login jadi user 
        $response->assertStatus(200);
        $response->assertViewIs('admin.index');
    }
    public function test_admin_view_pengajuan()
    {
        $user = User::find('5ac8d461-cd11-49fd-97bd-bbc9ba62a362');  // cari user
        $response = $this->actingAs($user)->get('/application'); // acting as itu login jadi user 
        $response->assertStatus(200);
        $response->assertViewIs('application.index');
    }
    public function test_admin_view_report()
    {
        $user = User::find('5ac8d461-cd11-49fd-97bd-bbc9ba62a362');  // cari user
        $response = $this->actingAs($user)->get('/application/report'); // acting as itu login jadi user 
        $response->assertStatus(200);
        $response->assertViewIs('application.report');
    }
    public function test_admin_view_unit()
    {
        $user = User::find('5ac8d461-cd11-49fd-97bd-bbc9ba62a362');  // cari user
        $response = $this->actingAs($user)->get('/unit'); // acting as itu login jadi user 
        $response->assertStatus(200);
        $response->assertViewIs('unit.index');
    }
    public function test_admin_view_pengguna()
    {
        $user = User::find('5ac8d461-cd11-49fd-97bd-bbc9ba62a362');  // cari user
        $response = $this->actingAs($user)->get('/pengguna'); // acting as itu login jadi user 
        $response->assertStatus(200);
        $response->assertViewIs('user.index');
    }
    public function test_admin_view_profile()
    {
        $user = User::find('5ac8d461-cd11-49fd-97bd-bbc9ba62a362');  // cari user
        $response = $this->actingAs($user)->get('/profile'); // acting as itu login jadi user 
        $response->assertStatus(200);
        $response->assertViewIs('auth.profile');
    }
}
