<?
require_once("credentials.php");
require "twitteroauth/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;

class pps_tweeter
{
    private $conn;
    private $img_dir;
    
    function __construct()
    {
        $this->conn = new TwitterOAuth( TWITTER_CONSUMER_KEY,
                                        TWITTER_CONSUMER_SECRET,
                                        OAUTH_TOKEN,
                                        OAUTH_SECRET);
                                        
        $this->img_dir = './images';
    }
    
    // currently, tweets out the time
    // eventually, should tweet out a dynamically generated photograph
    function tweet($text = null, $reply_id = null)
    {
        if($text === null)
        {
            date_default_timezone_set("Europe/London");
            $dt_fmt = "H.i.s"; 
            $text = date($dt_fmt);
        }
        
        // $img_path = "./images/yellow.png";
        
        // get all files in the images directory
        $images = scandir($this->img_dir);
        
        // remove '.' and '..'
        array_shift($images);
        array_shift($images);
        
        // randomise
        shuffle($images);
        
        // pick one to post
        $img_path = $this->img_dir."/".$images[0];
        
        $media = $this->conn->upload('media/upload', ['media' => $img_path]);
            
        $parameters = [
            "status" => $text,
            // "in_reply_to_status_id" => $reply_id,
            'media_ids' => implode(',', [$media->media_id_string])
        ];
        $result = $this->conn->post("statuses/update", $parameters);
    }
    
    function get_tweets($stream_id, 
                        $count=null,
                        $max_pos=null,
                        $min_pos=null)
    {
        $parameters = [
                'id' => $stream_id
        ];
        
        if (isset($count))
            $parameters['count'] = $count;
        if (isset($max_pos))
            $parameters['max_position'] = $max_pos;
        if (isset($min_pos))
            $parameters['min_position'] = $min_pos;
        
        
        // file_put_contents("out.txt", print_r($parameters, true));
        $result = $this->conn->get("collections/entries", $parameters);
        
        return $result;
    }
}

?>