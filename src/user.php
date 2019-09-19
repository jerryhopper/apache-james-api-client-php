<?php


namespace JerryHopper\JamesApiClient;


class user
{
    function __construct($baseuri,$token='')
    {
        $this->api = new api\user($baseuri,$token);
    }

    private function response($code,$message,$data){
        return (object)array(   'code' =>  $code,
            'message'   =>  $message,
            'result'      =>  $data
        );
    }
    public function create($userToBeCreated,$passwordToBeUsed){
        $Message = array();
        $Message[204] = 'The user was successfully created';
        $Message[400] = 'The user name or the payload is invalid';
        $Message[409] = 'Conflict: A concurrent modification make that query to fail';


        $res =  $this->api->create($userToBeCreated,$passwordToBeUsed);
        $statuscode =  $res->getStatusCode();

        return $this->response( $statuscode, $Message[$statuscode], $res->getBody()->getContents() );
    }


    public function delete($userToBeDeleted){
        $Message = array();
        $Message[204] = 'The user was successfully deleted';

        $res =  $this->api->delete($userToBeDeleted);
        $statuscode =  $res->getStatusCode();

        return $this->response( $statuscode, $Message[$statuscode], $res->getBody()->getContents() );
    }

    public function list(){
        $Message = array();
        $Message[200] = 'The user name list was successfully retrieved';

        $res =  $this->api->list();
        $statuscode =  $res->getStatusCode();

        return $this->response( $statuscode, $Message[$statuscode], json_decode($res->getBody()->getContents(),true) );
    }


}