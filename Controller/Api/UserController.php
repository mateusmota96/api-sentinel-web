<?php
class UserController extends BaseController
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
                $userModel = new UserModel(); 
                if (isset($limit) && $limit ){
                    $intLimit = $limit;
                }else{
                    $intLimit = 10;
                }
                if ($status_code == "erro" && $http_code == null && $id == null){
                    $arrUsers = $userModel->getError($intLimit, $client); 
                } elseif ($status_code == "ok" && $http_code == null && $id == null) {
                    $arrUsers = $userModel->getOK($intLimit, $client); 
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
     * "unset notify -> notify = 0"
     */
    public function postAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $id = $this->getPostQueryStringParams("id");
        if (strtoupper($requestMethod) == 'POST') {
            $userModel = new UserModel();
            $userModel->unsetNotify($id);            
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
    * "set notify -> notify = 1"
    */
    public function delAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $id = $this->getPostQueryStringParams("id");
        if (strtoupper($requestMethod) == 'POST') {
            $userModel = new UserModel();
            $userModel->setNotify($id);  
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
    * "set send_notify -> send_notify = 1"
    */
    public function postsendAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $id = $this->getPostQueryStringParams("id");
        if (strtoupper($requestMethod) == 'POST') {
            $userModel = new UserModel();
            $userModel->setSend($id);  
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
    public function delsendAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $id = $this->getPostQueryStringParams("id");
        if (strtoupper($requestMethod) == 'POST') {
            $userModel = new UserModel();
            $userModel->unsetSend($id);  
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
        echo "Cheguei no set Error";
        $url = $this->getPostQueryStringParams("url");
        $status = $this->getPostQueryStringParams("status");
        $http_code = $this->getPostQueryStringParams("http_code");
        if (strtoupper($requestMethod) == 'POST') {
            $userModel = new UserModel();
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
}