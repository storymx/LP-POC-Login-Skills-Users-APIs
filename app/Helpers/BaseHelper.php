<?php
namespace App\Helpers;
Use GuzzleHttp\Client;

class BaseHelper{

    protected $client;

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
            $response = $this->client->request($method,$partial_uri,[]);
        }

        $response = [
            'data'=>json_decode($response->getBody()->getContents(),true),
            'header'=>$response->getHeaders()
        ];

        return $response;
    }

    //this method get base uris with only an account as parameter
    //[WORKS WITH NEW SETCLIENT METHOD]
    public function getBaseURIs($account){
        $method = 'GET';
        $base_uri = 'https://adminlogin.liveperson.net/csdr/account/';
        $partial_uri = $account.'/service/baseURI.json?version=1.0';
        $clientHeaders = [];
        $headers = ['Content-Type'=>'Application/JSON','Accept'=>'Application/JSON'];
        $body = [];
        $response = $this->setClient($method,$base_uri,$partial_uri,$clientHeaders,$headers,$body);

        return $response;
    }

    //WORKS WITHOUT OAUTH 1.0
    //[WORKS WITH NEW SETCLIENT METHOD]
    public function getDomain($account,$service){
        $method = 'GET';
        $base_uri = 'https://api.liveperson.net/api/account/';
        $partial_uri = $account.'/service/'.$service.'/baseURI.json?version=1.0';
        $clientHeaders = ['Accept'=>'application/JSON','Content-Type'=>'application/JSON'];
        $requestHeaders = [];
        $body = [];
        $response = $this->setClient($method,$base_uri,$partial_uri,$clientHeaders,$requestHeaders,$body);

        return $response;

    }

    //WORKS WITHOUT OAUTH 1.0
    //[]
    public function login($account,$username,$password){
        $method = 'POST';
        $base_uri = 'https://va.agentvep.liveperson.net/api/account/';
        $partial_uri = $account.'/login?v=1.3';
        $clientHeaders = ['Accept'=>'application/JSON','Content-Type'=>'application/JSON'];
        $requestHeaders = [];
        $body = ['username' => $username, 'password' => $password];

        $response = $this->setClient($method,$base_uri,$partial_uri,$clientHeaders,$requestHeaders,$body);

        return $response;
    }

    public function getProfiles($account,$bearer){
        $method = 'GET';
        $base_uri = 'https://va.ac.liveperson.net/api/account/';
        $partial_uri = $account.'/configuration/le-users/profiles?v=4.0&select=$all&_=1502386640318&__d=60104';
        $clientHeaders = ['Authorization'=>'Bearer '.$bearer];
        $requestHeaders = [];
        $body = [];

        $response = $this->setClient($method,$base_uri,$partial_uri,$clientHeaders,$requestHeaders,$body);

        return $response;
    }

    //SHOULD INCLUDE OAUTH 1.0
    public function getAgentGroups($account,$bearer){
        $method = 'GET';
        $base_uri = 'https://va.ac.liveperson.net/api/account/';
        $partial_uri = $account.'/configuration/le-users/agentGroups';
        $clientHeaders = ['Authorization'=>'Bearer '.$bearer];
        $requestHeaders = [];
        $body = [];

        $response = $this->setClient($method,$base_uri,$partial_uri,$clientHeaders,$requestHeaders,$body);

        return $response;
    }

}

 ?>
