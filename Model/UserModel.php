<?php

require_once PROJECT_ROOT_PATH . "/Model/Database.php";
 
class UserModel extends Database
{
    public function getDomain($limit, $client)
    {
    return $this->select("SELECT * FROM monitor WHERE client = '$client' ORDER BY id ASC LIMIT ?", ["i", $limit]);
    }
    public function getError($limit, $client)
    {
    return $this->select("SELECT * FROM monitor WHERE client = '$client' AND error = 1 ORDER BY id ASC LIMIT ?", ["i", $limit]);
    }
    public function getOK($limit, $client)
    {
    return $this->select("SELECT * FROM monitor WHERE client = '$client' AND error = 0 ORDER BY id ASC LIMIT ?", ["i", $limit]);
    }
    public function getHTTP($limit, $client, $http_code)
    {
    return $this->select("SELECT * FROM monitor WHERE client = '$client' AND http_code = '$http_code' ORDER BY id ASC LIMIT ?", ["i", $limit]);
    }
    public function getHTTPERRO($limit, $client, $http_code)
    {
    return $this->select("SELECT * FROM monitor WHERE client = '$client' AND error = 1 AND http_code = '$http_code' ORDER BY id ASC LIMIT ?", ["i", $limit]);
    }
    public function getHTTPOK($limit, $client, $http_code)
    {
    return $this->select("SELECT * FROM monitor WHERE client = '$client' AND error = 0 AND http_code = '$http_code' ORDER BY id ASC LIMIT ?", ["i", $limit]);
    }
    public function setSend($id)
    {
    return $this->update("UPDATE monitor SET send_notify = '1' WHERE id = ?", ["i", $id]);
    }
    public function unsetSend($id)
    {
    return $this->update("UPDATE monitor SET send_notify = '0' WHERE id = ?" , ["i", $id]);
    }
    public function setNotify($id)
    {
    return $this->update("UPDATE monitor SET notify = '1' WHERE id = ?" , ["i", $id]);
    }
    public function unsetNotify($id)
    {
    return $this->update("UPDATE monitor SET notify = '0' WHERE id = ?" , ["i", $id]);
    }
    public function getBYID($limit, $client, $id)
    {
    return $this->select("SELECT * FROM monitor WHERE client = '$client' AND id = '$id' ORDER BY id ASC LIMIT ?", ["i", $limit]);
    }
    public function getBYURL($url)
    {
    return $this->select("SELECT * FROM monitor WHERE url = '$url' ");
    }
    public function getNotify($client, $id)
    {
    return $this->select("SELECT notify FROM monitor WHERE client = '$client' AND id = '$id' ");
    }   
    public function getHTTPSTAT($client, $id)
    {
    return $this->select("SELECT http_code FROM monitor WHERE client = '$client' AND id = '$id' ");
    }    
    public function setError($url, $http_code, $status)
    {
    return $this->update("UPDATE monitor SET error = 1, notify = 1, http_code = $http_code, status = $status WHERE url = '$url' ");
    }  
}

?>
