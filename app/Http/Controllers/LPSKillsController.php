<?php
namespace App\Http\Controllers;

use App\Helpers\SkillsHelper;
use Illuminate\Http\Request;

class LPSkillsController extends Controller{

    protected $helper;

    public function __construct(SkillsHelper $helper){
        $this->helper = $helper;
    }

    //NEED OAUTH BEARER
    public function getSkills(Request $request){
        $bearer = $request->input('bearer');
        $account = $request->input('account');

        if(!$bearer ||!$account){
            return response()->json(['message'=>'No Parameters were received.'],404);
        }

        $response = $this->helper->getSkills($account,$bearer);
        return response()->json($response,200);
    }

    //NEED OAUTH BEARER
    public function getSkillById(Request $request){
        $account = $request->input('account');
        $bearer = $request->input('bearer');
        $skill_id = $request->input('skill_id');

        if(!$bearer ||!$account || !$skill_id){
            return response()->json(['message'=>'No Parameters were received.'],404);
        }

        $response = $this->helper->getSkillById($account,$skill_id,$bearer);

        return response()->json($response,200);
    }

    //NEED OAUTH BEARER
    //[WORKS] THIS CAN SEND AN ARRAY WITH MULTIPLE SKILLS (NOW ONLY ONE)
    public function createSkill(Request $request){

        $body = $request->input('skill');
        $account = $request->input('account');
        $bearer = $request->input('bearer');

        // return response($request->input('skill'),200);

        //NO NEED TO CHECK DESCRIPTION
        if(!$body || !$account || !$bearer){
            return response()->json(['Message'=>'Error, some parameters are empty.'],404);
        }

        $response = $this->helper->createSkills($account,$body,$bearer);

        return response()->json($response,200);
    }

    //NEED OAUTH BEARER
    //[WORKS]
    public function updateSkill(Request $request){
        $body = $request->input('skill');
        $skill_id = $request->input('skill_id');
        $account = $request->input('account');
        $bearer = $request->input('bearer');
        $etag = $request->input('ETag');

        if(!$body || !$account || !$bearer || !$skill_id || !$etag){
            return response()->json(['Message'=>'Error, some parameters are empty.'],404);
        }

        $response = $this->helper->updateSkill($account,$body,$bearer,$skill_id,$etag);

        return response()->json($response,200);
    }

    //NEED OAUTH Bearer
    //[WORKS]
    public function deleteSkills(Request $request){
        $skills = $request->input('skills');
        $account = $request->input('account');
        $bearer = $request->input('bearer');

        if($skills == null || count($skills)<0 || $account == null || $account == '' ||  $bearer == null || $bearer == ''){
            return response()->json(['message'=>'No skills were received.'],404);
        }

        $response = $this->helper->deleteSkills($account,$skills,$bearer);

        return response()->json($response,200);
    }

    //NEED OAUTH Bearer
    //[WORKS]
    public function deleteSkill(Request $request){
        $skill_id = $request->input('skill_id');
        $account = $request->input('account');
        $bearer = $request->input('bearer');
        $etag = $request->input('ETag');

        if(!$account || !$bearer || !$skill_id || !$etag){
            return response()->json(['message'=>'No skills were received.'],404);
        }

        // return response()->json(['data'=>$request->all()],200);
        $response = $this->helper->deleteSkill($account,$skill_id,$bearer,$etag);

        return response()->json($response,200);
    }

}
?>
