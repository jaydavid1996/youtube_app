<?php 

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

class ApiService {
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "youtube_app";
    private $conn = null;
        public function __construct(){
            
            $this->conn = new mysqli($this->servername, $this->username, $this->password,$this->dbname);

            if ($this->conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            } 
        }
    public function youtubeChannel(){
        
        $sql = "SELECT channel_id, title ,descriptions,photo FROM youtube_channels";
        $result = $this->conn->query($sql);
        $response = [];
        $response = ['status'=>'error'];
        

        if ($result->num_rows > 0) {
            echo 1;
            exit;
            // output data of each row
            $response = [];
            
            while($row = $result->fetch_assoc()) {
                $response[]= ['channel_id'=>$row['channel_id'],'title'=>$row['title'],,'descriptions'=>$row['descriptions'],'photo'=>$row['photo']];
            }
        } else {
            $response = ['status'=>'empty'];
        }
        print json_encode($response);
    }
    
    public function __destruct(){
        $this->conn->close();
    }
}
exit;
$api = new ApiService();
$api->youtubeChannel();
?>