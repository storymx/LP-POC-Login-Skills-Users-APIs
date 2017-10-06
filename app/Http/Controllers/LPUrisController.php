<?php
namespace App\Http\Controllers;

use App\Helpers\BaseHelper;
use Illuminate\Http\Request;

class LPUrisController extends Controller{

    protected $helper;

    public function __construct(BaseHelper $helper){
        $this->helper = $helper;
    }

    //[WORKS]
    public function getBaseURIs(Request $request){

        $account = $request->input('account');

        if(!$account){
            return response()->json(['message'=>'No Parameters were Received'],404);
        }

        $response = $this->helper->getBaseURIs($account);

        return response()->json($response,200);

    }
}
?>
