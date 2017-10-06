<?php
namespace App\Http\Controllers;

use App\Helpers\BaseHelper;
use Illuminate\Http\Request;

class LPProfilesController extends Controller{

    protected $helper;

    public function __construct(BaseHelper $helper){
        $this->helper = $helper;
    }

    //NEED OAUTH BEARER
    public function getProfiles(Request $request){

        $bearer = $request->input('bearer');
        $account = $request->input('account');

        if(!$bearer ||!$account){
            return response()->json(['message'=>'No Parameters were received.'],404);
        }

        $response = $this->helper->getProfiles($account,$bearer);
        return response()->json($response,200);
    }

}
