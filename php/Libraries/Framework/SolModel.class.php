<?php
/**
 *  Solomon database class
 *  All Solomon database access is accomplished through objects of this class.
 *  @package HTFramework
 *  @subpackage DBMSModel 
 */    
if (!defined('ADODB_ASSOC_CASE'))
  define ('ADODB_ASSOC_CASE',0);
include_once('adodb/adodb.inc.php');
//require_once 'adodb/adodb-exceptions.inc.php';
$ADODB_FETCH_MODE=ADODB_FETCH_ASSOC;
$ADODB_COUNTRECS = false;

class SolModel extends clsHTModel implements iHTModel, Iterator {
  private $resultList; // array of database data for iteration
  private $dsn; // the odbc data source name, extending classes can set 
	protected static $conn = null; // extending classes can access the connection
	private $config;   // appConfig object
	private $EOF;
	private $objModel; // keep a ref to the child, call back for calc'ed column
	private $childName;// keep child model name for error messages
/**
 * __construct - Construct a model based on Solomon (or any Pervasive) table(s)
 */	
	public function __construct($in_child = null, $in_dsn = null)
	{
	  $this->config = new HTConfig();
    if($in_dsn == null)
      $this->dsn = $this->config->solDSN;
    else
      $this->dsn = $in_dsn;
    $this->assureConnect();
    $this->objModel = &$in_child;
	  $this->childName = get_class($in_child);
 //SolModel::$conn->debug=true;
	  $this->resultList = array();
	  $this->EOF = true;
  	foreach($this->accessorNames as $col => $acc)
  	 $ans[strtolower($col)] = $acc;
  	unset($this->accessorNames);
  	$this->accessorNames = $ans;
	}
  
	protected function assureConnect()
	{
 	  if (self::$conn==null || !isset(self::$conn[$this->dsn])) {
      self::$conn[$this->dsn] = &ADONewConnection('odbc');
	    self::$conn[$this->dsn]->autoRollback = true; // default is false
	  }
		if (!self::$conn[$this->dsn]->isConnected()) 
    {
      self::$conn[$this->dsn]->Connect($this->dsn);
    }
		if (!self::$conn[$this->dsn]->isConnected()) 
    {
      throw new Exception("$this->childName: SolModel cannot connect. DSN:[$this->dsn]");
    }
	}

  // HTModel required methods
  public function open()    // Do everything necessary to populate the object
	{
    $this->assureConnect();
    $sql = $this->getOpenSQL();
    $this->echol(print_r('DSN:' . $this->dsn . '<br>SQL:' . $sql, true));
    $rs = self::$conn[$this->dsn]->Execute($sql);
//    if (defined('HT_CAPTURE_RECENT_SQL'))
    if($rs === false)
    {
      $this->EOF = true;
      unset($this->resultList);
      $this->resultList=array();
      return;
    }
    $rs = $rs->GetRows();
    unset($this->resultList);
    foreach($rs as $row)
    {
      $resValues = array();
      foreach($row as $colName => $colVal)
      {
        $colName = strtolower($colName);
        if(isset($this->accessorNames[$colName]))
        {
          $resValues[$this->accessorNames[$colName]] = $colVal;
          //echo "<br>$colName(".$this->accessorNames[$colName].")=>$colVal";
        }
      }
      $objResult = new HTResult($resValues, $this->objModel);
      unset($resValues);
      $this->resultList[] = $objResult;
    } // next row
    if(isset($this->resultList))
    {
      reset($this->resultList);
      $this->EOF = false;
    }
    else
    {
      $this->EOF = true;
    }
	} // Open

	public function insert($row = null)  // Execute insert using current entity object data 
	{
    $this->assureConnect();
    if($row == null)
      $sql = $this->getInsertSQL($this->current());
    else
      $sql = $this->getInsertSQL($row);
    if (defined('HT_CAPTURE_RECENT_SQL'))
      $this->echol(print_r($sql, true));
    if(is_array($sql)) {
      foreach($sql as $stmt) {
        $res = self::$conn[$this->dsn]->Execute($stmt); 
        if ($res===false) throw new HTException ("$this->childName:Insert failed - $stmt - ".
                                            self::$conn[$this->dsn]->ErrorMsg(),HTFRK_EX_STOP);
      }
    }
    else {
      $res = self::$conn[$this->dsn]->Execute($sql); 
      if ($res===false) throw new HTException ("$this->childName:Insert failed - $sql - ".
                                          self::$conn[$this->dsn]->ErrorMsg(),HTFRK_EX_STOP);
    }      
    if ($res===false) 
      throw new HTException ("$this->childName: Insert failed - $sql - ".
                                          self::$conn[$this->dsn]->ErrorMsg(),HTFRK_EX_STOP);
	}
	public function update($row = null)  // Execute update using current or supplied object data
	{
    $this->assureConnect();
    if($row == null)
      $sql = $this->getUpdateSQL($this->current());
    else
      $sql = $this->getUpdateSQL($row);
    if (defined('HT_CAPTURE_RECENT_SQL'))
      $this->echol(print_r($sql, true));
    $res = self::$conn[$this->dsn]->Execute($sql); 
    if ($res===false) 
      throw new HTException ("$this->childName: Update failed - $sql - ".
                                          self::$conn[$this->dsn]->ErrorMsg(),HTFRK_EX_STOP);
	}
	public function delete($row = null)  // Execute delete using current or supplied object as key
	{
    $this->assureConnect();
    if($row == null)
      $sql = $this->getDeleteSQL($this->current());
    else
      $sql = $this->getDeleteSQL($row);
    if (defined('HT_CAPTURE_RECENT_SQL'))
      $this->echol(print_r($sql, true));
    $res = self::$conn[$this->dsn]->Execute($sql); 
    if ($res===false) 
      throw new HTException ("$this->childName: Delete failed - $sql - ".
                                          self::$conn[$this->dsn]->ErrorMsg(),HTFRK_EX_STOP);
	}
	public function lastError() // Return a string describing database error
	{
	 return self::$conn[$this->dsn]->ErrorMsg();
	}
	public function close() // Some DBMS's may need to be closed to conserve resources
	{
	}
  protected function getOpenSQL() 
  { 
    throw new HTException('This method must be overridden', HTFRK_EX_WARNING); 
  }
  protected function getInsertSQL($current)
  {
    throw new HTException('This method must be overridden', HTFRK_EX_WARNING); 
  }
  protected function getUpdateSQL($current)
  {
    throw new HTException('This method must be overridden', HTFRK_EX_WARNING); 
  }
  protected function getDeleteSQL($current)
  {
    throw new HTException('This method must be overridden', HTFRK_EX_WARNING); 
  }
	
	/**
	 * EOF() get the end of file boolean.\
	 * This function allows getting (reading)
	 * but does not allow client to change it.
	 */         	
  public function EOF()
  {
    if(!isset($this->resultList) || count($this->resultList)<=0)
      return true;
    return $this->EOF;
  }
  /**
   *   Iterator required methods. Note that these methods are called when
   *   this class is used in a foreach statement.   
   *   Because this class implements the PHP defined interface 'Iterator'
   *   we must define these methods. We update EOF when we move the array 
   *   pointer on rewind() and and next(). 
   */            	
  public function rewind() {
    if(!isset($this->resultList) || count($this->resultList)<=0) {
      $this->EOF = true;
      return false;
    }
    $ret = reset($this->resultList);
    $this->EOF = ($ret === false);
    return $ret;
  }
  public function current() {
    if(count($this->resultList)<=0) {
      $this->EOF = true;
      return false;
    }
    $ret = current($this->resultList);
    return $ret;
  }
  public function key() {
    if(count($this->resultList)<=0) {
      $this->EOF = true;
      return false;
    }
    $ret = key($this->resultList);
    return $ret;
  }
  public function next() {
    if(count($this->resultList)<=0) {
      $this->EOF = true;
      return false;
    }
    $ret = next($this->resultList);
    $this->EOF = ($ret === false);
    return $ret;
  }
  public function valid() {
    if(!isset($this->resultList)) {
      $this->EOF = true;
      return false;
    }
    else
      return (!$this->EOF);
  }
  /**
   *  Add a new obj to the list.         
   */   
  public function addNew($row = null)
  {
    if(($row <> null) && ($nm = $row->getModelName()) <> $this->childName)
      throw new HTException("SolModel cannot $this->childName::addNew($nm)");
    if($row == null)
    {
      $newPropVals = array();
      foreach($this->accessorNames as $accessorName)
      {
        $newPropVals[$accessorName] = '';
      }
      $objResult = new HTResult($newPropVals, $this->objModel);
    }
    else
      $objResult = $row;
    $this->resultList[] = $objResult;
    return $objResult;
  }   
 
  public function dump()
  {
    $ret = "<p><b>$this->childName</b><table>";
    foreach($this->accessorNames as $col => $acc)
      $ret .= "<tr><td>$col</td><td>{$this->current()->get($acc)}</td></tr>";
    $ret .= "</table>";
    return $ret;
  }
   
  public function startTrans()
  {
    //$this->assureConnect();
       if (self::$conn==null || !isset(self::$conn[$this->dsn])) {
           throw new HTException("No Connection before transaction starts!!".HTFRK_EX_STOP);
       }
    self::$conn[$this->dsn]->StartTrans();    
  }   
  public function completeTrans()
  {
		if (!self::$conn[$this->dsn]->isConnected()) {
       throw new Exception('SoModel is not connected.');
    }
    if(self::$conn[$this->dsn]->transCnt <= 0) {
       throw new Exception('No transaction to complete.');
    }
    self::$conn[$this->dsn]->CompleteTrans();    
  }   
  public function failTrans()
  {
		if (!self::$conn[$this->dsn]->isConnected()) {
       throw new Exception('SoModel is not connected.');
    }
    if(self::$conn[$this->dsn]->transCnt <= 0) {
       throw new Exception('No transaction to fail.');
    }
    self::$conn[$this->dsn]->FailTrans();    
  }  

 public function beginTrans()
  {
    //$this->assureConnect();
       if (self::$conn==null || !isset(self::$conn[$this->dsn])) {
           throw new HTException("No Connection before transaction starts!!".HTFRK_EX_STOP);
       }
   // self::$conn[$this->dsn]->BeginTrans();
   self::$conn[$this->dsn]->Execute("start transaction");
  }

  public function commitTrans()
  {
                if (!self::$conn[$this->dsn]->isConnected()) {
       throw new Exception('SoModel is not connected.');
    }
    //self::$conn[$this->dsn]->CommitTrans();i
    self::$conn[$this->dsn]->Execute("commit");
  }

 

  public function rollbackTrans()
  {
                if (!self::$conn[$this->dsn]->isConnected()) {
       throw new Exception('SoModel is not connected.');
    }
    //self::$conn[$this->dsn]->RollbackTrans();
    self::$conn[$this->dsn]->Execute("rollback");

  }


  public function getNextId()
  {
    if(!method_exists($this->objModel, 'getNextIdSQL'))
    	throw new Exception('getNextIdSQL must be implemented in order to call getNextId()');
  	$sql = $this->getNextIdSQL();
    $this->assureConnect();
    $rs = self::$conn[$this->dsn]->Execute($sql);
    if(!is_object($rs))
      return 0;
    else 
    {
      $rs = $rs->GetRows();
      $id = $rs[0]['id'];
      $id++;
      return $id;
    }
  }   
} // class SolModel


?>
