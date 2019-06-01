<?php

namespace App\Http\Controllers\Manage\CommunityManagementRequests;

use App\Http\Controllers\Controller;
use App\Repositories\CommunityRepository;
use Illuminate\Http\Request;

class CommunityManagementRequestController extends Controller {

    public function index(Request $request, CommunityRepository $repository){
        $communityManagementRequests = \App\CommunityManagementRequest::latest()->get();
        return view('manage.community-management-request.index',[
            'communityManagementRequests'=>$communityManagementRequests,
        ]);
    }

    public function approve(Request $request, CommunityRepository $repository, $communityManagementRequestId){
        $communityManagementRequest = \App\CommunityManagementRequest::find($communityManagementRequestId);
        $communityManagementRequest->approved_at = \Carbon\Carbon::now();
        $communityManagementRequest->approved_by_user_id = \Auth::user()->id;
        $communityManagementRequest->save();
        return redirect('/manage/community-management-request');
    }

    public function destroy(Request $request, CommunityRepository $repository, $communityManagementRequestId){
        $communityManagementRequest = \App\CommunityManagementRequest::find($communityManagementRequestId);
        $communityManagementRequest->delete();
        return redirect('/manage/community-management-request');
    }

}