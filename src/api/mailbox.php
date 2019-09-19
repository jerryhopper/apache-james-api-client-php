<?php

namespace JerryHopper\JamesApiClient\api;

use JerryHopper\JamesApiClient\httpClient;

class mailbox extends httpClient{
    $path = '/users';
    /*
     * Creating a mailbox
     * curl -XPUT http://ip:port/users/usernameToBeUsed/mailboxes/mailboxNameToBeCreated
     *
     * Response codes:
     *  204: The mailbox now exists on the server
     * 400: Invalid mailbox name
     * 404: The user name does not exist
     * 500: Internal error
     *
     */
    function create($usernameToBeUsed,$mailboxNameToBeCreated){
        $res = $this->client->request('PUT','/users/'.$usernameToBeUsed.'/mailboxes/'.$mailboxNameToBeCreated,[]);
        $this->checkResponse($res,array(204, 400,404,500));
        return $res;
    }

    /*
     * Deleting a mailbox and its children
     * curl -XDELETE http://ip:port/users/usernameToBeUsed/mailboxes/mailboxNameToBeCreated
     *
     * Response codes:
     *  204: The mailbox now does not exist on the server
     * 400: Invalid mailbox name
     * 404: The user name does not exist
     *
     */
    function delete($usernameToBeUsed,$mailboxNameToBeCreated){
        $res = $this->client->request('DELETE','/users/'.$usernameToBeUsed.'/mailboxes/'.$mailboxNameToBeCreated,[]);
        $this->checkResponse($res,array(204, 400,404));
        return $res;
    }

    /*
     *  Testing existence of a mailbox
     * curl -XGET http://ip:port/users/usernameToBeUsed/mailboxes/mailboxNameToBeCreated
     *
     * Response codes:
     * 204: The mailbox exists
     * 400: Invalid mailbox name
     * 404: The user name does not exist, the mailbox does not exist
     *
     *
     */
    function exists($usernameToBeUsed,$mailboxNameToBeCreated){
        $res = $this->client->request('GET','/users/'.$usernameToBeUsed.'/mailboxes/'.$mailboxNameToBeCreated,[]);
        $this->checkResponse($res,array(204, 400,404));
        return $res;
    }

    /*
     * Listing user mailboxes
     *  curl -XGET http://ip:port/users/usernameToBeUsed/mailboxes
     *
     * Response codes:
     *  200: The mailboxes list was successfully retrieved
     * 404: The user name does not exist
     *
     */
    function listUser($usernameToBeUsed){
        $res = $this->client->request('GET','/users/'.$usernameToBeUsed.'/mailboxes',[]);
        $this->checkResponse($res,array(204, 400));
        return $res;
    }

    /*
     * Deleting user mailboxes
     *  curl -XDELETE http://ip:port/users/usernameToBeUsed/mailboxes
     *
     * Response codes:
     * 204: The user do not have mailboxes anymore
     * 404: The user name does not exist
     *
     */
    function deleteUser(){
        $res = $this->client->request('DELETE','/users/'.$usernameToBeUsed.'/mailboxes',[]);
        $this->checkResponse($res,array(204, 400));
        return $res;
    }


}

