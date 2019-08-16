<?php

include_once 'config.php';

class Playlist
{
    public static function getFirst($playlist_id)
    {
        $url = 'https://www.googleapis.com/youtube/v3/playlistItems?part=snippet,id&playlistId='.$playlist_id.'&key='.API_KEY;
        $playlistVideos = json_decode(file_get_contents($url), true);
        $firstVideo = isset($playlistVideos['items'][0]['snippet']['resourceId']['videoId']) ? $playlistVideos['items'][0]['snippet']['resourceId']['videoId'] : '';
        $url = 'https://www.youtube.com/watch?v='.$firstVideo.'&list='.$playlist_id;
        if (!empty($firstVideo)) {
            header('Location: '.$url, true, 302);
        } else {
            echo 1;
            header('Location: index.html', true, 302);
        }

        exit();
    }
}
if (isset($_GET['play_id'])) {
    Playlist::getFirst($_GET['play_id']);
} else {
    header('Location: index.html', true, 302);
}
