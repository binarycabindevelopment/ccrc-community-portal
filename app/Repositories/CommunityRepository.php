<?php

namespace App\Repositories;

use App\Models\Community;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

class CommunityRepository{

    private $client;

    public function __construct(Client $client = null) {
        if(!$client){
            $client = new \GuzzleHttp\Client();
        }
        $this->client = $client;
    }

    private function getDefaultClientHeaders(){
        return [
            'Authorization' => 'Bearer '.config('services.lifeplanliving.secret_key'),
        ];
    }

    private function getBaseURL(){
        return 'https://portal.lifeplanliving.com/api';
    }

    private function getResponseContents($method,$uri,$options=[]){
        $headers = $this->getDefaultClientHeaders();
        $request = $this->client->request($method, $uri,['headers'=>$headers]);
        $response = json_decode($request->getBody()->getContents());
        return $response;
    }

    public function getAll(){
        if(!config('services.lifeplanliving.live')){
            $response = json_decode(file_get_contents(resource_path('json/fakes/communities.json')));
        }else{
            $response = Cache::remember('communities_all', 120, function () {
                return $this->getResponseContents('GET', $this->getBaseURL().'/v1/community');
            });
        }
        $results = collect();
        foreach($response as $responseItem){
            $results->push(new Community((array) $responseItem));
        }
        return $results;
    }

    public function find($uuid){
        if(!config('services.lifeplanliving.live')){
            foreach($this->getAll() as $item){
                if($item->uuid == $uuid){
                    return $item;
                }
            }
            return null;
        }
        $response = Cache::remember('communities_find_'.$uuid, 120, function () use($uuid) {
            return $this->getResponseContents('GET', $this->getBaseURL().'/v1/community/'.$uuid);
        });
        $result = new Community((array) $response);
        return $result;
    }

}