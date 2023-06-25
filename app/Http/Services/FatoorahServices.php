<?php

namespace App\Http\Services;


use GuzzleHttp\Client;
use  GuzzleHttp\Psr7\Request;

class FatoorahServices{
    private $request_client;
    private $base_url;
    private $headers;

    //Client -> class built in laravel used to connect with third party/system (help you to connect with anything outside your website and routes)
    //request_client -> instance from Client
    public function __construct(Client $request_client){
        $this->request_client = $request_client;
        //url-> route in my Fatoorah website
        $this->base_url = env('fatoorah_base_url');
        $this->headers=[
            'Content-Type' => 'application/json' ,
            'authorization'=> 'Bearer ' . env('fatoorah_token')
        ];

    }
    //Handle request -> make default way to call any outside services
    private function buildRequest($url , $method , $body = []){
        $request = new Request($method , $this->base_url . $url , $this->headers);
        if(!$body){
            return false;
        }
        $response = $this->request_client->send($request ,[
             'json' => $body
            ]);
        if($response->getStatusCode() != 200){
            return false;
        }
        $response = json_decode($response->getBody() , true);

        return $response;
    }

    
    public function sendPayment($data){
        return $response = $this->buildRequest('/v2/SendPayment' , 'POST' , $data);
    }
     

    public function getPaymentStatus($data){
        return $response = $this->buildRequest('/v2/getPaymentStatus' , 'POST' , $data);
    }




}