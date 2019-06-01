<?php

namespace Tests\Feature;

use App\Mail\ContactSubmission;
use App\Models\Community;
use App\Repositories\CommunityRepository;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;

class CommunityContactSubmissionTest extends TestCase
{

    use RefreshDatabase;

    public function test_store()
    {
        Mail::fake();
        $repository = \Mockery::mock(CommunityRepository::class);
        $repository->shouldReceive('find')
            ->with('12345')
            ->once()
            ->andReturn(new Community([
                'uuid'=>'12345',
                'name'=>'Demo Community Name',
            ]));

        $this->app->instance(CommunityRepository::class, $repository);

        $contactSubmissionData = factory(\App\ContactSubmission::class)->make();

        $response = $this->post('/community/12345/contact-submission',[
            'first_name' => $contactSubmissionData->first_name,
            'last_name' => $contactSubmissionData->last_name,
            'email' => $contactSubmissionData->email,
            'phone' => $contactSubmissionData->phone,
            'subscribe' => $contactSubmissionData->subscribe,
            'message' => $contactSubmissionData->message,
        ]);

        $response->assertRedirect('/community/12345');
        $contactSubmission = \App\ContactSubmission::where('community_uuid','12345')->first();
        $this->assertNotNull($contactSubmission);
        $this->assertEquals($contactSubmissionData->first_name,$contactSubmission->first_name);
        $this->assertEquals($contactSubmissionData->last_name,$contactSubmission->last_name);
        $this->assertEquals($contactSubmissionData->email,$contactSubmission->email);
        $this->assertEquals($contactSubmissionData->phone,$contactSubmission->phone);
        $this->assertEquals(boolval($contactSubmissionData->subscribe),boolval($contactSubmission->subscribe));
        $this->assertEquals($contactSubmissionData->message,$contactSubmission->message);
        Mail::assertSent(ContactSubmission::class);
    }

}
