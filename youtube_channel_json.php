<?php

include_once 'config.php';
class ApiService
{
    private $servername = SERVER_NAME;
    private $username = SERVER_USERNAME;
    private $password = SERVER_PASSWORD;
    private $dbname = SERVER_DATABASE;
    private $conn = null;

    public function __construct()
    {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        if ($this->conn->connect_error) {
            die('Connection failed: '.$conn->connect_error);
        }
    }

    public function youtubeChannel()
    {
        $sql = 'SELECT channel_id, title ,descriptions,photo FROM youtube_channels';
        $result = $this->conn->query($sql);
        $response = [];
        $response = ['status' => 'error'];

        if ($result->num_rows > 0) {
            // echo 1;
            // exit;
            // output data of each row
            $response = [];

            while ($row = $result->fetch_assoc()) {
                // print_r($row);
                $response[] = [
                    'channel_id' => $row['channel_id'],
                    'title' => $row['title'],
                    'descriptions' => $row['descriptions'],
                    'photo' => $row['photo'],
                    'videos' => $this->getChannelsVideo($row['channel_id']),
                    ];
            }
        } else {
            $response = ['status' => 'empty'];
        }
        // print_r($response);

        return json_encode($response);
    }

    public function getChannelsVideo($channel_id)
    {
        $sql = 'SELECT channel_id, title ,thumbnails,video_id,playlist_id FROM youtube_channel_videos where channel_id = "'.$channel_id.'"';
        $result = $this->conn->query($sql);
        $response = [];
        $response = ['status' => 'error'];

        if ($result->num_rows > 0) {
            // echo 1;
            // exit;
            // output data of each row
            $response = [];

            while ($row = $result->fetch_assoc()) {
                // print_r($row);
                $response[] = ['channel_id' => $row['channel_id'], 'title' => $row['title'], 'thumbnails' => $row['thumbnails'], 'video_id' => $row['video_id'], 'playlist_id' => $row['playlist_id']];
            }
        } else {
            $response = ['status' => 'empty'];
        }
        // print_r($response);

        return $response;
    }

    public function __destruct()
    {
        $this->conn->close();
    }
}
// exit;
$api = new ApiService();
header('Content-type: application/json');
echo $api->youtubeChannel();
