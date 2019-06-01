<?php

namespace App\Http\Controllers\Communities\ContactSubmissions;

use App\Http\Controllers\Controller;
use App\Repositories\CommunityRepository;
use Illuminate\Http\Request;

class ContactSubmissionController extends Controller {

    public function store(Request $request, CommunityRepository $repository, $communityUUID){
        $this->validate($request,[
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'email|required',
            'phone' => 'required',
        ]);
        $community = $repository->find($communityUUID);
        $contactSubmissionData = $request->all();
        $contactSubmissionData['community_uuid'] = $community->uuid;
        $contactSubmission = \App\ContactSubmission::create($contactSubmissionData);
        $contactSubmission->sendMail();
        return redirect($community->getPath())->withSuccess('Thank you, your form has been submitted!');
    }



}