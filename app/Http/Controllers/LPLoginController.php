<?php
namespace App\Http\Controllers;

use App\Helpers\BaseHelper;
use Illuminate\Http\Request;

class LPLoginController extends Controller{

    protected $helper;

    public function __construct(BaseHelper $helper){
        $this->helper = $helper;
    }

    //NO NEED OAUTH
    public function login(Request $request){
        $username = $request->input('username');
        $password = $request->input('password');
        $account = $request->input('account');

        if(!$username || !$password){
            return response()->json(['message'=>'No Parameters were received.'],404);
        }

        $response = $this->helper->login($account,$username,$password);

        return response()->json($response,200);
    }
}
?>
