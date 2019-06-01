<?php

namespace App\Http\Controllers\Account\CommunityManagementRequests;

use App\Http\Controllers\Controller;
use App\Repositories\CommunityRepository;
use Illuminate\Http\Request;

class CommunityManagementRequestController extends Controller {

    public function create(Request $request, CommunityRepository $repository){
        $community = $repository->find($request->get('community_key'));
        return view('account.community-management-request.create',[
            'community'=>$community,
        ]);
    }

    public function store(Request $request, CommunityRepository $repository){
        $this->validate($request,[
            'community_uuid' => 'required',
        ]);
        $community = $repository->find($request->get('community_uuid'));
        $existingCommunityManagementRequest = \App\CommunityManagementRequest::where('community_uuid',$request->get('community_uuid'))->where('user_id',\Auth::user()->id)->first();
        if(!$existingCommunityManagementRequest){
            $communityManagementRequest = \App\CommunityManagementRequest::create([
                'user_id' => \Auth::user()->id,
                'community_uuid' => $request->get('community_uuid'),
            ]);
        }
        return redirect('/dashboard')->withSuccess('Request created, we will notify you soon!');
    }

}