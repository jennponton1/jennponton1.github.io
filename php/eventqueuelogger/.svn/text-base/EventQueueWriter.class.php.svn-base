<?php


class EventQueueWriter {
    protected $eventDate;
    protected $eventTime;
    protected $config;
    
    public static function getQueuePath() {
        return __DIR__."/eventQueue";
    }
    
    public function __construct() {
        $this->eventDate = date("Y-m-d");
        $this->eventTime = date("H:i:s");
        $this->config = array(
            "queuePath" => EventQueuWriter::getQueuePath()
        );
    }
    
    public static function log() {
        $tmp = func_get_args();
        $tmp2 = array();
        array_push($tmp2, date("Y-m-d"));
        array_push($tmp2, date("H:i:s"));
        for($i=0; $i<3; $i++) {
            if (isset($tmp[$i])) {
                array_push($tmp2, $tmp[$i]);
            }
            else {
                break;
            }
        }
        file_put_contents(
            EventQueueWriter::getQueuePath()."/ev".getmypid().date("siHdmy").".txt",
            implode("|", $tmp2)."\n"
            //            var_export($tmp2, true)
        );
        
    }
}
