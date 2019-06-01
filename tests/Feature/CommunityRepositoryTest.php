<?php

namespace Tests\Feature;

use App\Repositories\CommunityRepository;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Tests\TestCase;

class CommunityRepositoryTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_getAll_returns_a_collection_of_communities()
    {
        $mockHandler = new MockHandler([
            new Response(200,[],'[{"id":2,"uuid":"6b694f50-ba7d-11e7-952c-67615b93cb88","user_id":8,"agent_id":1,"name":"Attleboro Village","description":"Selected"},{"id":4,"uuid":"6b694f50-ba7d-11e7-952c-67615b93cb8822","user_id":3,"agent_id":2,"name":"Attleboro Village2","description":"Selected2"}]'),
        ]);
        $mockHandlerStack = HandlerStack::create($mockHandler);
        $client = new Client(['handler'=>$mockHandlerStack]);
        $communityRepository = new CommunityRepository($client);
        $response = $communityRepository->getAll();
        $this->assertEquals(2,$response->count());
        $this->assertEquals(\App\Models\Community::class,get_class($response->first()));
    }

    public function test_find_returns_a_community()
    {
        $mockHandler = new MockHandler([
            new Response(200,[],'{"id":2,"uuid":"6b694f50-ba7d-11e7-952c-67615b93cb88","user_id":8,"agent_id":1,"name":"Attleboro Village","description":"Selected"}]'),
        ]);
        $mockHandlerStack = HandlerStack::create($mockHandler);
        $client = new Client(['handler'=>$mockHandlerStack]);
        $communityRepository = new CommunityRepository($client);
        $response = $communityRepository->find('6b694f50-ba7d-11e7-952c-67615b93cb88');
        $this->assertEquals(\App\Models\Community::class,get_class($response));
    }

}
