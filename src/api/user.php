<?php

namespace JerryHopper\JamesApiClient\api;

use JerryHopper\JamesApiClient;

class user extends httpClient{

    public $path = '/users';

    /*
    *  Create a user
    *
    * curl -XPUT http://ip:port/users/usernameToBeUsed -d '{"password":"passwordToBeUsed"}'
    *
    * Response codes:
    * 204: The user was successfully created
    * 400: The user name or the payload is invalid
    * 409: Conflict: A concurrent modification make that query to fail
    * Note: if the user is already, its password will be updated.
    */
    function create($usernameToBeUsed,$passwordToBeUsed)
    {
        $res = $this->client->request('PUT', $this->path.'/'.$usernameToBeUsed, ['json'=>['password'=>$passwordToBeUsed]]);
        $this->checkResponse($res,array(204, 400, 409));
        return $res;
    }


    /*
     * curl -XDELETE http://ip:port/users/userToBeDeleted
     *
     * Response codes:
     * 204: The user was successfully deleted
     *
     */
    function delete($userToBeDeleted){
        $res = $this->client->request('DELETE',$this->path.'/'.$userToBeDeleted,[]);
        $this->checkResponse($res,array(204));
        return $res;
    }

    /*
     * curl -XGET http://ip:port/users
     *
     * Response codes:
     * 200: The user name list was successfully retrieved
     */
    function list(){
        $res = $this->client->request('GET',$this->path.'',[]);
        $this->checkResponse($res,array(200));
        return $res;
    }



}
