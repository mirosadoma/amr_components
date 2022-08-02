<?php

namespace App\Models;

use \GuzzleHttp\Client;

class SocketIoService
{
    public $serverUrl;
    public $broadCastUrl;
    public $broadCastToUserUrl;
    public $connectedUsersUrl;
    public $client;

    public function __construct()
    {
        $this->serverUrl = env('SOCKET_SERVER_URL').':'.env('SOCKET_SERVER_PORT');
        $this->broadCastUrl = $this->serverUrl.'/'.'broadCastToChannel';
        $this->broadCastToUserUrl = $this->serverUrl.'/'.'broadCastToUser';
        $this->connectedUsersUrl = $this->serverUrl.'/'.'getConnectedUsers';
        $this->client = new Client(['verify' => false]);
        // $this->client->setDefaultOption('verify', false);
    }


    public function broadCastTo(string $channel , $data){
        $res = $this->client->post($this->broadCastUrl,
            [            
                'json' => [
                    'channel' => $channel,
                    'data'    => $data
                ]
            ]
        );
        return json_decode($res->getBody());
    }
    
    public function broadCastToUser(string $channel, $data, $userId){
        $res = $this->client->post($this->broadCastToUserUrl,
            [            
                'json' => [
                    'channel' => $channel,
                    'data'    => $data,
                    'userId'  => $userId
                ]
            ]
        );
        return json_decode($res->getBody());
    }

    public function getOnlineSockets(){
        
        $res = $this->client->get($this->connectedUsersUrl);
        return json_decode($res->getBody());
    }
}