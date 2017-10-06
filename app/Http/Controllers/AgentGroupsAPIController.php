<?php
namespace App\Http\Controllers;

use App\Helpers\BaseHelper;
use Illuminate\Http\Request;

class AgentGroupsAPIController extends Controller{

    protected $helper;

    public function __construct(BaseHelper $helper){
        $this->helper = $helper;
    }

    public function getAgentGroups(Request $request){

        $account = $request->input('account');
        $bearer = $request->input('bearer');

        if(!$account || !$bearer){
            return response()->json([],404);
        }

        $response = $this->helper->getAgentGroups($account,$bearer);
        return response()->json(['data'=>$response],200);

    }
}

?>
