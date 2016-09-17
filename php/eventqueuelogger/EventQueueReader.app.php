<?php

define("NOLOGIN", 1);
require_once "appclassfiles.class.php";
require_once "htwdoctrine/htwdoctrine.inc.php";

require_once "EventQueueReader.class.php";
require_once "EventQueueWriter.class.php";

class EventQueueReaderApp extends myAppClass {
    public function __construct() {
        parent::__construct();
        $this->addControllerElement("null", "runApp");
        $this->addControllerElement("cli", "runApp");
    }
    
    public function run() {
        // byPass the dispatcher
        EventQueueReader::read();
    }
    
    public function runApp() {
        $this->run();
    }
}

$app = new EventQueueReaderApp();
$app->run();

echo "Done";
