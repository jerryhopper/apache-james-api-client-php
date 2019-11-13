<?php

namespace JerryHopper\JamesApiClient\api;

//use JerryHopper\JamesApiClient\httpClient;

class domain extends httpClient{

    public $path = '/domains';

    /*
     *  Create a domain
     *
     * curl -XPUT http://ip:port/domains/domainToBeCreated
     * responseCodes
     * 204: The domain was successfully added
     * 400: The domain name is invalid
     */
    function create($domainToBeCreated){
        $res = $this->client->request('PUT',$this->path.'/'.$domainToBeCreated,[]);
        $this->checkResponse($res,array(204, 400));
        return $res;
    }


    /*
     *  Delete a domain
     * responseCodes
     * 204: The domain was successfully removed
     */
    function delete($domainToBeDeleted){
        $res = $this->client->request('DELETE',$this->path.'/'.$domainToBeDeleted,[]);
        $this->checkResponse($res,array(204));
        return $res;
    }

    /*
     *  domain exists
     * Response codes:
     * 204: The domain exists
     * 404: The domain does not exist
     */
    function exists($domainName){
        $res = $this->client->request('GET',$this->path.'/'.$domainName,[]);

        $this->checkResponse($res,array(204, 400,404));

        return $res;
    }
    /*
     *  list domains
     * Response codes:
     * 200: The domain list was successfully retrieved
     */
    function list(){
        $res = $res = $this->client->request('GET',$this->path,[]);
        $this->checkResponse($res,array(200));
        return $res;
    }
    /*
     *  list alias
     * Response codes:
     * 200: The domain aliases was successfully retrieved
     * 400: destination.domain.tld has an invalid syntax
     * 404: destination.domain.tld is not part of handled domains and does not have local domains as aliases.
     */
    function listAlias($dstdomain){
        $res = $this->client->request('GET',$this->path.'/'.$dstdomain.'/aliases',[]);
        $this->checkResponse($res,array(200, 400, 404));
        return $res;
    }
    /*
     *  create alias
     * Response codes:
     * 204: The redirection now exists
     * 400: source.domain.tld or destination.domain.tld have an invalid syntax
     * 400: source domain and destination domain are the same
     * 404: source.domain.tld are not part of handled domains.
     */
    function createAlias($dstdomain,$srcdomain){

        $res = $res = $this->client->request('PUT',$this->path.'/'.$dstdomain.'/aliases/'.$srcdomain,[]);
        $this->checkResponse($res,array(204, 400, 404));
        return $res;
    }
    /*
     *  delete alias
     * Response codes:
     * 204: The redirection now exists
     * 400: source.domain.tld or destination.domain.tld have an invalid syntax
     * 400: source domain and destination domain are the same
     * 404: source.domain.tld are not part of handled domains.
     */
    function deleteAlias($dstdomain,$srcdomain){
        $res = $this->client->request('DELETE',$this->path.'/'.$dstdomain.'/aliases/'.$srcdomain,[]);
        $this->checkResponse($res,array(204, 400, 404));
        return $res;
    }

}

