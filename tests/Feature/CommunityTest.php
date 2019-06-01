<?php

namespace Tests\Feature;

use App\Models\Community;
use App\Repositories\CommunityRepository;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommunityTest extends TestCase
{

    use RefreshDatabase;

    public function test_index()
    {
        $repository = \Mockery::mock(CommunityRepository::class);
        $repository->shouldReceive('getAll')
            ->once()
            ->andReturn(collect()->push(new Community([
                'name'=>'Demo Community Name',
            ])));

        $this->app->instance(CommunityRepository::class, $repository);

        $response = $this->get('/community');

        $response->assertStatus(200);
        $response->assertSee('Demo Community Name');
    }

    public function test_show()
    {
        $repository = \Mockery::mock(CommunityRepository::class);
        $repository->shouldReceive('find')
            ->with('12345')
            ->once()
            ->andReturn(new Community([
                'name'=>'Demo Community Name',
            ]));

        $this->app->instance(CommunityRepository::class, $repository);

        $response = $this->get('/community/12345');

        $response->assertStatus(200);
        $response->assertSee('Demo Community Name');
    }

}
