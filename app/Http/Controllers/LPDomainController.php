<?php
namespace App\Http\Controllers;

use App\Helpers\BaseHelper;
use Illuminate\Http\Request;

class LPDomainController extends Controller{

    protected $helper;

    public function __construct(BaseHelper $helper){
        $this->helper = $helper;
    }

    //NO NEED OAUTH
    //[WORKS]
    public function getDomain(Request $request){
        $account = $request->input('account');
        $service = $request->input('service');

        if(!$account || !$service){
            return response()->json(['message'=>'No Parameters were received.'],404);
        }

        $response = $this->helper->getDomain($account,$service);

        return response()->json($response,200);
    }
}
?>
