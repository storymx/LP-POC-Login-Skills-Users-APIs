<?php
namespace App\Http\Controllers;

use App\Helpers\UsersHelper;
use Illuminate\Http\Request;

class LPUsersController extends Controller{

    protected $helper;

    public function __construct(UsersHelper $helper){
        $this->helper = $helper;
    }

    //NEED OAUTH BEARER
    public function getUsers(Request $request){

        $bearer = $request->input('bearer');
        $account = $request->input('account');

        if(!$bearer ||!$account){
            return response()->json(['message'=>'No Parameters were received.'],404);
        }

        $response = $this->helper->getUsers($account,$bearer);
        return response()->json($response,200);
    }

    //NEED OAUTH BEARER
    public function getUserById(Request $request){
        $account = $request->input('account');
        $bearer = $request->input('bearer');
        $user_id = $request->input('user_id');

        if(!$bearer ||!$account ||!$user_id){
            return response()->json(['message'=>'No Parameters were received.','data'=>[$bearer,$account,$user_id]],404);
        }

        $response = $this->helper->getUserById($account,$user_id,$bearer);

        return response()->json($response,200);
    }

    //NEED OAUTH BEARER
    //[WORKS]
    public function createUser(Request $request){

        $body = $request->input('user');
        $account = $request->input('account');
        $bearer = $request->input('bearer');

        if(!$body || !$bearer || !$account){
            return response()->json(['Message'=>'Error, some parameters are empty.','body'=>$body,'account'=>$account,'bearer'=>$bearer],404);
        }

        $response = $this->helper->createUser($account,$body,$bearer);

        return response()->json($response,200);
    }

    //NEED OAUTH BEARER
    //[WORKS]
    public function updateUser(Request $request){

        $body = $request->input('userUpdate');
        $account = $request->input('account');
        $bearer = $request->input('bearer');
        $etag = $request->input('ETag');

        //breakpoint to be commented
        // return response($request->all(),200);

        if(!$body || !$account || !$bearer || !$etag){
            return response()->json(['Message'=>'Error, some parameters are empty.'],404);
        }

        $response = $this->helper->updateUser($account,$body,$bearer, $etag);

        return response()->json($response,200);
    }

    //NEED OAUTH Bearer
    //[WORKS]
    // public function deleteUsers(Request $request){
    //     $users = $request->input('users');
    //     $account = $request->input('account');
    //     $bearer = $request->input('bearer');
    //     $etag = $request->input('etag');
    //
    //     if(count($users)<0 || !$account || !$bearer || !$etag){
    //         return response()->json(['message'=>'No users were received.'],404);
    //     }
    //
    //     $response = $this->helper->deleteUsers($account,$users,$bearer,$etag);
    //
    //     return response()->json($response,200);
    // }

    //NEED OAUTH Bearer
    //[WORKS]
    public function deleteUser(Request $request){
        $id = "".$request->input('user_id');
        $body = [$id];
        $account = $request->input('account');
        $bearer = $request->input('bearer');
        $etag = $request->input('ETag');

        // return response($body,200);

        if(!$body || !$account || !$bearer || !$etag){
            return response()->json(['message'=>'No users were received.'],404);
        }

        // return response()->json(['data'=>$request->all()],200);
        $response = $this->helper->deleteUser($account,$body,$bearer,$etag);

        return response()->json($response,200);
    }

    public function changeUserPassword(Request $request){
        $account = $request->input('account');
        $user_id = $request->input('user_id');
        $body = $request->input('passwords');
        $bearer = $request->input('bearer');

        // return response($body,200);

        if(!$account || !$user_id || !$body || !$bearer){
            return response()->json(['message'=>'No users were received.'],404);
        }

        // return response()->json(['data'=>$request->all()],200);
        $response = $this->helper->changeUserPassword($account,$user_id,$body,$bearer);

        return response()->json($response,200);

    }

    //account,user_id,newPassword,bearer
    public function resetUserPassword(Request $request){

        $account = $request->input('account');
        $user_id = $request->input('user_id');
        $body = [
            'newPassowrd'=>$request->input('newPassword')
        ];
        $bearer = $request->input('bearer');
        $etag = $request->input('ETag');

        if(!$account || !$user_id || !$body || !$bearer || !$etag){
            return response()->json(['message'=>'No users were received.'],404);
        }

        $response = $this->helper->resetUserPassword($account,$user_id,$body,$bearer,$etag);

        return response()->json($response,200);
    }

}
