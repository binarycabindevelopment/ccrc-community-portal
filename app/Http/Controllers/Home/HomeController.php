<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Repositories\CommunityRepository;

class HomeController extends Controller {

    public function show(){
        $communityRepository = new CommunityRepository();
        $communities = $communityRepository->getAll();
        return view('home.show',['communities'=>$communities]);
    }

}