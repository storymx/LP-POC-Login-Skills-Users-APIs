<?php
namespace App\Helpers;
use GuzzleHttp\Client;

class UsersHelper {

    protected $client;

    //constructor
    public function __construct(){
        $this->client = new Client();
    }
    //NEED TESTING
    //[METHOD IS WORKING !!]
    public function setClient($method,$base_uri,$partial_uri,$clientHeaders,$requestHeaders,$body){
        $this->client = new Client();
        //IF THERE IS CLIENT HEADERS
        if($clientHeaders != null || $clientHeaders != ''){
            $this->client = new Client([
                'base_uri'=>$base_uri,
                'headers'=>$clientHeaders
            ]);
        }else{
            $this->client = new Client([
                'base_uri'=>$base_uri
            ]);
        }

        $response = '';

        //IF THERE IS SECOND HEADERS But no body
        if(($requestHeaders != null || $requestHeaders != '') && ($body !=null || $body != '')){

            $response = $this->client->request($method,$partial_uri,[
                'headers' => $requestHeaders,
                'json' => $body
            ]);
        }else if($requestHeaders != null || $requestHeaders != ''){
            $response = $this->client->request($method,$partial_uri,[
                'headers' => $requestHeaders
            ]);
        }else if($body !=null || $body != ''){
            $response = $this->client->request($method,$partial_uri,[
                'json' => $body
            ]);
        }else{
            $response = $this->client->request($method,$partial_uri);
        }

        $response = [
            'data'=>json_decode($response->getBody()->getContents(),true),
            'header'=>$response->getHeaders()
        ];

        return $response;
    }

    //SHOULD INCLUDE OAUTH 1.0
    public function getUsers($account,$bearer){
        $method = 'GET';
        $base_uri = 'https://va.ac.liveperson.net/api/account/';
        $partial_uri = $account.'/configuration/le-users/users';
        $clientHeaders = ['Authorization'=>'Bearer '.$bearer];
        $requestHeaders = [];
        $body = [];

        $response = $this->setClient($method,$base_uri,$partial_uri,$clientHeaders,$requestHeaders,$body);

        return $response;
    }

    // public function
    public function getUserById($account,$user_id,$bearer){
        $method = 'GET';
        $base_uri = 'https://va.ac.liveperson.net/api/account/';
        $partial_uri = $account.'/configuration/le-users/users/'.$user_id;
        $clientHeaders = ['Authorization'=>'Bearer '.$bearer];
        $requestHeaders = [];
        $body = [];

        $response = $this->setClient($method,$base_uri,$partial_uri,$clientHeaders,$requestHeaders,$body);

        return $response;
    }

    public function createUser($account,$body,$bearer){
        $method = 'POST';
        $base_uri = 'https://va.ac.liveperson.net/api/account/';
        $partial_uri = $account.'/configuration/le-users/users';
        $clientHeaders = ['Authorization'=>'Bearer '.$bearer];
        $requestHeaders = ['Content-Type'=>'Application/JSON','Accept'=>'Application/JSON'];
        // $requestHeaders = [];
        // $body = $body);

        $response = $this->setClient($method,$base_uri,$partial_uri,$clientHeaders,$requestHeaders,$body);

        return $response;
    }

    //THIS MAY RECEIVE ONE USER
    //[WORKS]
    public function updateUser($account,$body,$bearer,$etag){
        $method = 'PUT';
        $base_uri = 'https://va.ac.liveperson.net/api/account/';
        $partial_uri = $account.'/configuration/le-users/users/'.$body['id'];
        $clientHeaders = ['Authorization'=>'Bearer '.$bearer, "ETag"=> $etag, 'if-Match' => -1];
        $requestHeaders = [];
        $body = $body;

        $response = $this->setClient($method,$base_uri,$partial_uri,$clientHeaders,$requestHeaders,$body);

        return $response;
    }
    //THIS RECEIVES ONE TO N USER IDS
    //[WORKS]
    // public function deleteUsers($account,$users,$bearer){
    //     $method = 'DELETE';
    //     $base_uri = 'https://va.ac.liveperson.net/api/account/';
    //     $partial_uri = $account.'/configuration/le-users/users';
    //     $clientHeaders = ['Authorization'=>'Bearer '.$bearer];
    //     $requestHeaders = [];
    //     $body = [];
    //
    //     $response = $this->setClient($method,$base_uri,$partial_uri,$clientHeaders,$requestHeaders,$body);
    //
    //     return $response;
    // }

    //THIS RECEIVES ONE TO N USER IDS
    //[WORKS]
    public function deleteUser($account,$users,$bearer,$etag){

        $method = 'DELETE';
        $base_uri = 'https://va.ac.liveperson.net/api/account/';
        $partial_uri = $account.'/configuration/le-users/users';
        $clientHeaders = ['Authorization'=>'Bearer '.$bearer, 'if-Match'=> -1, 'ETag' => $etag];
        $requestHeaders = [];
        $body = $users;

        $response = $this->setClient($method,$base_uri,$partial_uri,$clientHeaders,$requestHeaders,$body,$etag);

        return $response;
    }
    //NEED TO RECEIVE BODY WITH PARAMETERS
    public function changeUserPassword($account,$user_id,$body,$bearer){
        $method = 'PUT';
        $base_uri = 'https://va.ac.liveperson.net/api/account/';
        $partial_uri = $account.'/configuration/le-users/users/'.$user_id.'/changePassword';
        $clientHeaders = ['Authorization'=>'Bearer '.$bearer, 'if-Match'=> -1];
        $requestHeaders = [];
        $body = $body;

        $response = $this->setClient($method,$base_uri,$partial_uri,$clientHeaders,$requestHeaders,$body);
    }

    public function resetUserPassword($account,$user_id,$body,$bearer,$etag){
        $method = 'PUT';
        $base_uri = 'https://va.ac.liveperson.net/api/account/';
        $partial_uri = $account.'/configuration/le-users/users/'.$user_id.'/resetPassword';
        $clientHeaders = ['Authorization'=>'Bearer '.$bearer, 'if-Match' => -1, 'ETag'=> $etag];
        $requestHeaders = [];
        $body = $body;

        $response = $this->setClient($method,$base_uri,$partial_uri,$clientHeaders,$requestHeaders,$body);
    }

}
?>
