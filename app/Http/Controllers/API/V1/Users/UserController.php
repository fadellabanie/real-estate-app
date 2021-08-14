<?php

namespace App\Http\Controllers\API\V1\Users;

use Carbon\Carbon;
use App\Models\User;
use App\Models\ReportUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Api\Auth\UpdateRequest;
use App\Services\SubscriptionService;

class UserController extends Controller
{

    public function show()
    {
        return $this->respondWithItem(new UserResource(Auth::user()));
    }

    public function update(UpdateRequest $request,$id)
    {
        $user = User::find($id);

        if(!$user) $this->errorNotFound();

        $user->update([
            'email' => $request->email,
            'username' => $request->username,
            'image' => upload($request->username,'users'),
        ]);

        return $this->successStatus(__("Update profile successfully"));
    }
   
    public function report(Request $request)
    {
        ReportUser::create([
            'user_id' => Auth::id(),
            'suspicious_user_id' => $request->user_id,
            'note' => $request->note,
        ]);

        return $this->successStatus(__("Report user successfully"));

    }
    public function subscription(Request $request)
    {     

        $response = SubscriptionService::subscription($request);
    
        if (! $response['success']) {     
            return $this->errorStatus($response['message']);
        }

        $title = __("Subscription");
        $body = __("Subscription package Success");
        $this->send(Auth::user()->device_token, $title, $body);
        
        return $this->successStatus(__("Subscription successfully"));
    }
}
