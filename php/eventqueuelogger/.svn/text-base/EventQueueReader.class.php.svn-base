<?php

class EventQueueReader {
    public static function read() {
        $path = EventQueueWriter::getQueuePath();
        $out = $path."/outfile.txt";
        // Make sure i'm not already running
        if (file_exists($path."/eqr.pid")) {
            // Already running -- return
            file_put_contents($path."/error.txt", "already running ".date("m/d/Y H:i:s")."\n", FILE_APPEND);
            throw new Exception("Already running");
        }
        // Create pid file
        file_put_contents($path."/eqr.pid", getmypid());
        // get a list of the files
        $queue = opendir($path);
        file_put_contents($out, "Started reading at ".date("m/d/Y H:i:s")."\n", FILE_APPEND);
        while (($entry = readdir($queue)) !== false) {
            if ($entry == "." || $entry == "..") {
                continue;
            }
            if (substr($entry, 0, 2) != "ev") {
                continue;
            }
            // Read the file
            $eventData = file_get_contents($path."/".$entry);
            $newFileName = $path.'/ol'.substr($entry, 2);
            rename($path."/".$entry, $newFileName);
            $data = explode("|", $eventData);
            file_put_contents($out."2", var_export($data, true), FILE_APPEND);
            file_put_contents($out, $entry."\n", FILE_APPEND);
            unlink($newFileName);
        }
        file_put_contents($out, "Donereading at ".date("m/d/Y H:i:s")."\n", FILE_APPEND);
        
        //arbitrary pause
        sleep(1);

        
        unlink($path."/eqr.pid");
    }
    
    public static function trigger() {
        $path = EventQueueWriter::getQueuePath();
        $path = $path."/..";

        proc_close(
            proc_open(
                "$path\\readqueue.bat $path",
                array(
                    "0" => array("pipe", "r"),
                    "1" => array("pipe", "w"),
                    "2" => array("pipe", "a")
                ),
                $tmp
            )
        );
        unset($tmp);
        
        /** 
         * This works, but is Windows specific
        $WshShell = new COM("WScript.Shell");
        $oExec = $WshShell->Run("C:\\windows\\system32\\cmd.exe /c $path\\readqueue.bat >NULL", 0, false);
        var_dump($oExec);
         */
        
    }
}
