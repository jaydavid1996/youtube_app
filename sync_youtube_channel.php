<?php


class YoutubeChannel {
    public static function getChannel($Username){
        $url = 'https://www.googleapis.com/youtube/v3/channels?key=AIzaSyDuXcavezwBqd9NbfNvUBnxtrM7qaKnQfI&forUsername='.$Username.'&part=id,snippet';
        $channel = json_decode(file_get_contents($url), true);
        $response['channel_id'] = $channel['items'][0]['id'];
        $response['title'] = $channel['items'][0]['snippet']['title'];
        $response['description'] = $channel['items'][0]['snippet']['description'];
        $response['photo'] = $channel['items'][0]['snippet']['thumbnails']['default']['url'];
        
        return $response;
    }
}
class YoutubeChannelVideos {
    protected $API_KEY = 'AIzaSyDuXcavezwBqd9NbfNvUBnxtrM7qaKnQfI';
    protected $channelID = '';
    protected $maxResults=50;
    public function __construct($channelID){
        $this->channelID = $channelID;
    }

    public function getVideosPage1(){
        $url = 'https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&channelId='.$this->channelID.'&maxResults='.$this->maxResults.'&key='.$this->API_KEY.'';
        // $this->nextpage_token ='CDIQAA';
  
        $videoList = json_decode(file_get_contents($url), true);
        $this->nextpage_token =$videoList['nextPageToken'];
        $videos = [];
        foreach ($videoList['items'] as $key => $value) {
            $video = [];
            $video['video_id'] = isset($value['id']['videoId'])?$value['id']['videoId']:'';
            $video['playlist_id'] = isset($value['id']['playlistId'])?$value['id']['playlistId']:'';
            $video['video_title'] = $value['snippet']['title'];
            $video['video_thumbnails'] = $value['snippet']['thumbnails']['medium']['url'];
            $video['index'] = 
            $videos[] =$video;

         
        }
        
        return $videos;
    }
    public function getVideosPage2()
    {
        $url = 'https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&channelId='.$this->channelID.'&maxResults='.$this->maxResults.'&key='.$this->API_KEY.'&pageToken='.$this->nextpage_token;
        $videoList = json_decode(file_get_contents($url), true);
        $videos = [];
        foreach ($videoList['items'] as $key => $value) {
            $video = [];
            $video['video_id'] = isset($value['id']['videoId'])?$value['id']['videoId']:'';
            $video['playlist_id'] = isset($value['id']['playlistId'])?$value['id']['playlistId']:'';
            $video['video_title'] = $value['snippet']['title'];
            $video['video_thumbnails'] = $value['snippet']['thumbnails']['medium']['url'];
            $video['index'] = 
            $videos[] =$video;

         
        }        
        return $videos;
    }
}

class main {
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
    public function sync(){
        $channel = YoutubeChannel::getChannel('NBA');
        if($this->insertChannel($channel)){
            $this->insertVideos($channel['channel_id']);
            echo 'success sync';
        }else{
            echo 'failed to sync';
        }
            
    }
    public function insertChannel($channel){
        $channel = (object)$channel;
        $channel->title= $this->conn->real_escape_string($channel->title);
        $channel->description= $this->conn->real_escape_string($channel->description);
        $sql = "INSERT IGNORE INTO youtube_channels (channel_id, title, descriptions,photo)
                VALUES ('".$channel->channel_id."', '".$channel->title."', '".$channel->description."','".$channel->photo."')";
        if ($this->conn->query($sql) === TRUE) {
            echo "New record created successfully";
            return true;
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
            return false;
        }
    }
    public function insertVideos($channel_id){
        $youtube = new YoutubeChannelVideos($channel_id);
       
        $sql = "INSERT IGNORE INTO youtube_channel_videos (channel_id, title, descriptions,thumbnails,video_id,playlist_id) VALUES ";
        $batch1 = $youtube->getVideosPage1(); 
        
        foreach ($batch1 as $key => $value) {
            // $value = (object) $value;
        //     echo '<pre>';
        // print_r($value);exit;
        // echo '</pre>';
            $value['video_title']= $this->conn->real_escape_string($value['video_title']);
            $value['video_title'] = str_replace('|','',$value['video_title']);
            if($key!=0){
                $sql.= ', ';
            }
            $sql.="  ('".$channel_id."', '".$value['video_title']."', ' ','".$value['video_thumbnails']."','".$value['video_id']."','".$value['playlist_id']."')";
        }

        if ($this->conn->query($sql) === TRUE) {
            echo "New records created successfully";
            // return true;
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
            // return false;
        }

        $sql = "INSERT IGNORE INTO youtube_channel_videos (channel_id, title, descriptions,thumbnails,video_id,playlist_id) VALUES ";
        $batch1 = (object)$youtube->getVideosPage2(); 
        foreach ($batch1 as $key => $value) {

            $value['video_title']= $this->conn->real_escape_string($value['video_title']);
            $value['video_title'] = str_replace('|','',$value['video_title']);
            if($key!=0){
                $sql.= ', ';
            }
            $sql.=" ('".$channel_id."', '".$value['video_title']."', ' ','".$value['video_thumbnails']."','".$value['video_id']."','".$value['playlist_id']."')";
        }

        if ($this->conn->query($sql) === TRUE) {
            echo "New records created successfully";
            // return true;
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
            // return false;
        }

    }
    public function __destruct(){
        $this->conn->close();
    }
}
$main = new main();
$main->sync();
?>