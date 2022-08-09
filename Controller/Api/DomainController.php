<?php
class DomainController extends BaseController
{
    /**
     * "/user/list" Endpoint - Get list of users
     */
    public function listAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $limit = $this->getQueryStringParams("limit");
        $client = $this->getQueryStringParams("client");
        $status_code = $this->getQueryStringParams("status");
        $http_code = $this->getQueryStringParams("http_code");
        $id = $this->getQueryStringParams("id");
        $url = $this->getQueryStringParams("url");
         
        if (strtoupper($requestMethod) == 'GET') {
            try {
                $userModel = new DomainModel(); 
                if (isset($limit) && $limit ){
                    $intLimit = $limit;
                }else{
                    $intLimit = 10;
                }
                if ($status_code == "erro" && $http_code == null && $id == null){
                    $arrUsers = $userModel->getError(); 
                } elseif ($status_code == "ok" && $http_code == null && $id == null) {
                    $arrUsers = $userModel->getOK(); 
                } elseif ($status_code == "all" && $http_code == null && $id == null) {
                    $arrUsers = $userModel->getALL(); 
                } elseif ($status_code == "url" && $http_code == null && $id == null) {
                    $arrUsers = $userModel->getURL(); 
                } elseif(isset($http_code) && $status_code == null && $id == null){
                    $arrUsers = $userModel->getHTTP($intLimit, $client, $http_code);
                } elseif(isset($http_code) && $status_code == "erro" && $id == null){
                    $arrUsers = $userModel->getHTTPERRO($intLimit, $client, $http_code);
                } elseif ($status_code == "ok" && isset($http_code) && $id == null) {
                    $arrUsers = $userModel->getHTTPOK($intLimit, $client, $http_code);
                } elseif (isset($url)) {
                    $arrUsers = $userModel->getBYURL($url);
                } elseif (isset($id)) {
                    $arrUsers = $userModel->getBYID($intLimit, $client, $id);
                } else
                    $arrUsers = $userModel->getDomain($intLimit, $client);                  
                $responseData = json_encode($arrUsers);
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
 
        // send output
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }
    /**
    * "unset notify and set send_notify -> notify = 0 and send_notify = 1"
    */
    public function postSend()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $id = $this->getPostQueryStringParams("id");
        if (strtoupper($requestMethod) == 'POST') {
            $userModel = new DomainModel();
            $userModel->postSend($id);            
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
 
        // send output
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    } 
    /**
    * "unset send_notify -> send_notify = 1"
    */
    public function delSend()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $id = $this->getPostQueryStringParams("id");
        if (strtoupper($requestMethod) == 'POST') {
            $userModel = new DomainModel();
            $userModel->delSend($id);            
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
 
        // send output
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    } 
    /**
    * "unset send_notify -> send_notify = 0"
    */
    public function setError()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $url = $this->getPostQueryStringParams("url");
        $status = $this->getPostQueryStringParams("status");
        $http_code = $this->getPostQueryStringParams("http_code");
        if (strtoupper($requestMethod) == 'POST') {
            $userModel = new DomainModel();
            $userModel->setError($url, $http_code, $status);  
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
 
        // send output
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    } 
    /**
    * "unset send_notify -> send_notify = 0"
    */
    public function unsetError()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $url = $this->getPostQueryStringParams("url");
        $status = $this->getPostQueryStringParams("status");
        $http_code = $this->getPostQueryStringParams("http_code");
        if (strtoupper($requestMethod) == 'POST') {
            $userModel = new DomainModel();
	    print("cheguei no unset\n");
            $userModel->unsetError($url, $http_code, $status);  
	    print("User Model: " . $userModel);
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
 
        // send output
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    } 
}
