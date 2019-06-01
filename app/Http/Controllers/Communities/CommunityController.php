<?php

namespace App\Http\Controllers\Communities;

use App\Http\Controllers\Controller;
use App\Repositories\CommunityRepository;
use Illuminate\Http\Request;

class CommunityController extends Controller {

    public function index(Request $request, CommunityRepository $repository){
        $communities = $repository->getAll();
        $filteredCommunities = $communities;
        if(!empty($request->get('query'))){
            $fuse = new \Fuse\Fuse($filteredCommunities->toArray(), [
                "keys" => ['name','city','state','zipcode'],
                "distance" => 40,
            ]);
            $filteredCommunityResults = $fuse->search($request->get('query'));
            $filteredCommunities = collect();
            foreach($filteredCommunityResults as $filteredCommunityResult){
                $filteredCommunities->push($communities->firstWhere('id', $filteredCommunityResult['id']));
            }
        }
        if(!empty($request->get('city'))){
            $expectedValue = $request->get('city');
            $filteredCommunities = $filteredCommunities->filter(function($community, $key) use($expectedValue){
                return strtolower($community->city) == trim(strtolower($expectedValue));
            });
        }
        if(!empty($request->get('state'))){
            $expectedValue = $request->get('state');
            $filteredCommunities = $filteredCommunities->filter(function($community, $key) use($expectedValue){
                return strtolower($community->state) == trim(strtolower($expectedValue));
            });
        }
        return view('community.index',[
            'communities' => $communities,
            'filteredCommunities' => $filteredCommunities,
        ]);
    }

    public function show(CommunityRepository $repository, $communityUUID){
        $community = $repository->find($communityUUID);
        return view('community.show',[
            'community' => $community,
        ]);
    }



}