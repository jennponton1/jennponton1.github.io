<?php

require_once "basetable.class.php";

if (isset($argv[1])) {
    $str = file_get_contents($argv[1]);
    $var = unserialize($str);
    
    $table = new GenericMySqlTable("slslogevent");
    var_dump($table);
    
    $slsLogEvent = new stdClass();
    $slsLogEvent->eventdate = date("Y-m-d");
    $slsLogEvent->eventtime = date("h:i:s");
    $slsLogEvent->username = $var->username;
    $slsLogEvent->mainid = null;
    $slsLogEvent->changetype = 'update';
    $slsLogEvent->itemkeys = json_encode($var->header->keys);
    $headerChanges = $var->header;
    unset($headerChanges->keys);
    $slsLogEvent->updates = json_encode($headerChanges);
    $table->insert($slsLogEvent);
    // get ID
    $eventID = $table->getLastInsertID();
    foreach($var->detail as $dtlItem) {
        $slsDtlLogEvent = new StdClass();
        $slsDtlLogEvent->eventdate = $slsLogEvent->eventdate;
        $slsDtlLogEvent->eventtime = $slsLogEvent->eventtime;
        $slsDtlLogEvent->username = $slsLogEvent->username;
        $slsDtlLogEvent->mainid = $eventID;
        if (isset($dtlItem->changeType)) {
            // This is a change/update
            $slsDtlLogEvent->changetype = 'update:detail';
            $dtlItem->keys['originvtid'] = $dtlItem->origInvtid;
            $slsDtlLogEvent->itemkeys = json_encode($dtlItem->keys);
            //$slsDtlLogEvent->invtid = $dtlItem->origInvtid;
            unset($dtlItem->keys);
            unset($dtlItem->origInvtid);
            unset($dtlItem->changeType);
        }
        else {
            // This is an insert
            $slsDtlLogEvent->changetype = 'insert:detail';
            $slsDtlLogEvent->itemkeys = json_encode(new StdClass());
        }
        $slsDtlLogEvent->updates = json_encode($dtlItem);
        $table->insert($slsDtlLogEvent);
    }
    
    
    unlink($argv[1]);
}
