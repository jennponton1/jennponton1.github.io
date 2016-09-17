<?php
/*
 * Logger Class: 
 */
class Logger {
    
//    protected $emInstance;
    protected $date;
    
    function __construct() {       
        $this->date = date('Y-m-d H:i:s');
    }
    
    /**
     * Create a log record 
     * @param type $user
     * @param type $fieldName
     * @param type $oldValue
     * @param type $newValue
     * @return \Dwh\Logger 
     */
    public function insertLog($recordId, $user, $tableName, $fieldName, $oldValue, $newValue){
        $addRecord = new Dwh\Logger($recordId, $user, $this->date, $tableName, $fieldName, $oldValue, $newValue);
        
        $addRecord = new Dwh\Logger($user, $this->date, $fieldName, $oldValue, $newValue);
        return $addRecord;
    }
}