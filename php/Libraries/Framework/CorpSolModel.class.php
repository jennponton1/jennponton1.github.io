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

class CorpSolModel extends clsHTModel implements iHTModel, Iterator {
  private $resultList; // array of database data for iteration
	private static $conn;
	private $config;   // appConfig object
	private $keyColList; // array[] of 
	private $EOF;
	private $childName;
	
	function __construct($in_child = '')
	{
	  $this->childName = get_class($in_child);
	  $this->conn = ADONewConnection('odbc');
	  $conn->autoRollback = true; // default is false
	  $conn->debug=true;
	  $this->config = new HTConfig();
	  $this->resultList = array();
	  $this->EOF = true;
  	$this->keyColList = array();
  	foreach($this->accessorNames as $col => $acc)
  	 $ans[strtolower($col)] = $acc;
  	unset($this->accessorNames);
  	$this->accessorNames = $ans;
	}
  
	private function connect()
	{
  	$this->conn->Connect("adocorp");
		if (!$this->conn->isConnected()) 
    {
      throw new Exception("$this->childName: SoModel cannot connect.");
    }
	}

  // HTModel required methods
  public function open()    // Do everything necessary to populate the object
	{
		if (!$this->conn->isConnected()) 
    {
      $this->connect();
  		if (!$this->conn->isConnected()) 
      {
        throw new Exception("$this->childName: SolModel::Open() - could not connect");
      } 
    }
    $sql = $this->getOpenSQL();
//    echo $sql;
    $rs = $this->conn->Execute($sql);
    if(!$rs)
    {
      $this->EOF = true;
      unset($this->resultList);
      $this->resultList=array();
      return;
    }
    $rs = $rs->GetRows();
    unset($this->resultList);
    $objKeys = new ArrayObject($this->keyColList);
    $keyColListEmpty = ($objKeys->count() == 0);
    if(!$keyColListEmpty)
    {
      $itrKeys = $objKeys->getIterator(); 
      $itrKeys->rewind();
    }
    $this->resultList = array();
    foreach($rs as $row)
    {
      $resValues = array();
      foreach($row as $colName => $colVal)
      {
        $colName = strtolower($colName);
         if(isset($this->accessorNames[$colName]))
        {
          if((!$keyColListEmpty) && ($itrKeys->key() == $colName))
          {
            $keyColVal = $colVal;
          }
            
          $resValues[$this->accessorNames[$colName]] = $colVal;
          //echo "<br>$colName(".$this->accessorNames[$colName].")=>$colVal";
        }
      }
      $objResult = new HTResult($resValues, $this->childName);
      unset($resValues);
      if($keyColListEmpty)
        $this->resultList[] = $objResult;
      else  // TODO implement composite key - for now assume first only
        $this->resultList[$keyColVal] = $objResult;
//  TODO
//  If there is a list of keys (a composite key) iterate through to index results
//      else
//        foreach($this->keyColList as $keyCol)
    } // next row
    if(count($this->resultList)>0)
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
    if (!$this->conn->isConnected())
      $this->connect();
    if (!$this->conn->isConnected()) 
      throw new HTException("$this->childName: Not Connected",HTFRK_EX_STOP);
    if($row == null)
      $sql = $this->getInsertSQL($this->current());
    else
      $sql = $this->getInsertSQL($row);
    if(is_array($sql)) {
      foreach($sql as $stmt) {
        $res = $this->conn->Execute($stmt); 
        if ($res===false) throw new HTException ("$this->childName:Insert failed - $stmt - ".
                                            $this->conn->ErrorMsg(),HTFRK_EX_STOP);
      }
    }
    else {
      $res = $this->conn->Execute($sql); 
      if ($res===false) throw new HTException ("$this->childName:Insert failed - $sql - ".
                                          $this->conn->ErrorMsg(),HTFRK_EX_STOP);
    }      
    if ($res===false) 
      throw new HTException ("$this->childName: Insert failed - $sql - ".
                                          $this->conn->ErrorMsg(),HTFRK_EX_STOP);
	}
	public function update($row = null)  // Execute update using current entity object data and key
	{
    if (!$this->conn->isConnected())
      $this->connect();
    if (!$this->conn->isConnected()) 
      throw new HTException("$this->childName: Not Connected",HTFRK_EX_STOP);
    if($row == null)
      $sql = $this->getUpdateSQL($this->current());
    else
      $sql = $this->getUpdateSQL($row);
    $res = $this->conn->Execute($sql); 
    if ($res===false) 
      throw new HTException ("$this->childName: Update failed - $sql - ".
                                          $this->conn->ErrorMsg(),HTFRK_EX_STOP);
	}
	public function delete($row = null)  // Execute delete using current etity object key
	{
    if (!$this->conn->isConnected())
      $this->connect();
    if (!$this->conn->isConnected()) 
      throw new HTException("$this->childName: Not Connected",HTFRK_EX_STOP);
    if($row == null)
      $sql = $this->getDeleteSQL($this->current());
    else
      $sql = $this->getDeleteSQL($row);
    $res = $this->conn->Execute($sql); 
    if ($res===false) 
      throw new HTException ("$this->childName: Delete failed - $sql - ".
                                          $this->conn->ErrorMsg(),HTFRK_EX_STOP);
	}
	public function lastError() // Return a string describing database error
	{
	 return $this->conn->ErrorMsg();
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
    return $this->EOF;
  }
  /**
   *   Iterator required methods
   *   Because this class implements the PHP defined interface 'Iterator'
   *   we must define these methods. We update EOF when we move the array pointer
   *   on rewind() and and next(). Note that these methods are called when
   *   this class is used in a foreach statement.   
   */            	
  public function rewind() {
    if(count($this->resultList)<=0)
      return false;
    $ret = reset($this->resultList);
    $this->EOF = ($ret === false);
    return $ret;
  }
  public function current() {
    if(count($this->resultList)<=0)
      return false;
    $ret = current($this->resultList);
    return $ret;
  }
  public function key() {
    if(count($this->resultList)<=0)
      return false;
    $ret = key($this->resultList);
    return $ret;
  }
  public function next() {
    if(count($this->resultList)<=0)
      return false;
    $ret = next($this->resultList);
    $this->EOF = ($ret === false);
    return $ret;
  }
  public function valid() {
    if(count($this->resultList)<=0)
      return false;
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
      $objResult = new HTResult($newPropVals, $this->childName);
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
   
  public static function startTrans()
  {
		if (!is_object(SolModel::$conn) || !SolModel::$conn->isConnected()) 
    {
  	  SolModel::$conn = ADONewConnection('odbc');
  	  $conn->autoRollback = true; // default is false
  	  $config = new HTConfig();
  	  $conn->debug=true;
    	SolModel::$conn->Connect("adocorp");
  		if (!SolModel::$conn->isConnected()) {
        throw new Exception('SoModel cannot connect.');
      }
    }
    SolModel::$conn->StartTrans();    
  }   
  public static function completeTrans()
  {
		if (!SolModel::$conn->isConnected()) {
       throw new Exception('SoModel is not connected.');
    }
    if(SolModel::$conn->transCnt <= 0) {
       throw new Exception('No transaction to complete.');
    }
    SolModel::$conn->CompleteTrans();    
  }   
  public static function failTrans()
  {
		if (!SolModel::$conn->isConnected()) {
       throw new Exception('SoModel is not connected.');
    }
    if(SolModel::$conn->transCnt <= 0) {
       throw new Exception('No transaction to fail.');
    }
    SolModel::$conn->FailTrans();    
  }   
} // class SolModel


?>
