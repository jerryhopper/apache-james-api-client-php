<?php

namespace JerryHopper\JamesApiClient;



class domain {

    function __construct($baseuri,$token='')
    {
        $this->api = new api\domain($baseuri,$token);
    }

    private function response($code,$message,$data){
        return (object)array(   'code' =>  $code,
                                'message'   =>  $message,
                                'result'      =>  $data
        );
    }




    public function list(){
        $Message = array();
        $Message[200] = 'The domain list was successfully retrieved';

        $res =  $this->api->list();
        $statuscode =  $res->getStatusCode();

        return $this->response( $statuscode, $Message[$statuscode], $res->getBody()->getContents() );
    }

    public function create($domainName){

        try{
            $res = $this->exists($domainName);
        }catch(\Exception $e ){
            if($e->getCode()!=404){
                throw new \Exception($e->getMessage(),$e->getCode());
            }
        }
        if(isset($res) && $res->code==204){
            throw new \Exception('The domain already exists',500);
        }
        $Message = array();
        $Message[204] = 'The domain was successfully added';
        $Message[400] = 'The domain name is invalid';

        $res = $this->api->create($domainName);
        $statuscode =  $res->getStatusCode();

        if($statuscode==400){
            throw new \Exception($statuscode,$Message[$statuscode]);
        }
        return $this->response( $statuscode, $Message[$statuscode], $res->getBody()->getContents() );
    }

    public function delete($domainName){
        $Message = array();
        $Message[204] = 'The domain was successfully removed';


        $res = $this->api->delete($domainName);
        $statuscode =  $res->getStatusCode();


        return $this->response( $statuscode,$Message[$statuscode],  $res->getBody()->getContents() );
    }

    public function exists($domainName){
        $Message = array();
        $Message[204] = 'The domain exists';
        $Message[404] = 'The domain does not exist';

        $res = $this->api->exists($domainName);
        $statuscode =  $res->getStatusCode();

        if($statuscode==404 ){
            throw new \Exception($statuscode,$Message[$statuscode]);
        }

        return $this->response( $statuscode, $Message[$statuscode], true );
    }


    /*
    public function listAlias($dstdomain){
        $Message = array();
        $Message[200] = 'The domain aliases was successfully retrieved';
        $Message[400] = 'destination.domain.tld has an invalid syntax';
        $Message[404] = 'destination.domain.tld is not part of handled domains and does not have local domains as aliases.';

        $res =  $this->api->listAlias($dstdomain);
        $statuscode =  $res->getStatusCode();

        return $this->response( $statuscode, $Message[$statuscode], $res->getBody()->getContents() );
    }
    public function createAlias($dstdomain,$srcdomain){
        $Message = array();
        $Message[204] = 'The redirection now exists';
        $Message[400] = 'source.domain.tld or destination.domain.tld have an invalid syntax - or are the same.';
        $Message[404] = 'source.domain.tld are not part of handled domains.';

        $res =  $this->api->createAlias($dstdomain,$srcdomain);
        $statuscode =  $res->getStatusCode();

        return $this->response( $statuscode, $Message[$statuscode], $res->getBody()->getContents() );
    }
    public function deleteAlias($dstdomain,$srcdomain){
        $Message = array();
        $Message[204] = 'The redirection now exists';
        $Message[400] = 'source.domain.tld or destination.domain.tld have an invalid syntax - or are the same.';
        $Message[404] = 'source.domain.tld are not part of handled domains.';

        $res =  $this->api->deleteAlias($dstdomain,$srcdomain);
        $statuscode =  $res->getStatusCode();

        return $this->response( $statuscode, $Message[$statuscode], $res->getBody()->getContents() );
    }
    */

}