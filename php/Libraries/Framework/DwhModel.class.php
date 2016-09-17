<?php
/**
 *  DwhModel - class
 *  All interaction with the DWH database (currently implemented in MYSQL) 
 *  is managed by this child class of HTModel. All operations specific to DWH 
 *  should be handled here. Also, any DBMS specific (e.g. MYSQL) accomodations
 *  are made here as well. If the DBMS were changed, this is the only source
 *  that should have to be changed to suit assuming similar functionality (keyed
 *  access, SQL, etc.)    
 *  @package HTFramework
 *  @subpackage HTModel
 *  @filesource
 *        
 */
/**
 * Use ADODB to access MYSQL
 */   
if (!defined('ADODB_ASSOC_CASE'))
define ('ADODB_ASSOC_CASE',0);
include_once('adodb/adodb.inc.php');
$ADODB_FETCH_MODE=ADODB_FETCH_ASSOC;
/**
 * DwhModel - class
 */  
class DwhModel extends clsHTModel implements iHTModel, Iterator {
  // Private properties
  private $resultList; // array of database data for iteration
  private $conn;
  private $config;   // HTConfig object
  private $EOF;
  private $childName;
  private $child;
  private $dwhServer;
  private $dwhDBUser;
  private $dwhDBPass;
  private $dwhDBName;
	/**
	 * construct with new ADO connection and HTConfig object
	 */   	
	function __construct($in_child = null, $in_dwhServer = null, $in_dwhDBUser = null,
                            $in_dwhDBPass = null, $in_dwhDBName = null)
	{
	  // Database credentials are all or nothing
    $this->dwhServer = $in_dwhServer;
    $this->dwhDBUser = $in_dwhDBUser;
    $this->dwhDBPass = $in_dwhDBPass;
    $this->dwhDBName = $in_dwhDBName;    
	  $this->childName = get_class($in_child);
	  $this->child = $in_child;
	  $this->keyColList = array();
	  $this->resultList = array();
	  $this->conn = ADONewConnection('mysql');
	  $this->config = new HTConfig();
	}
  /**
   * Only this class handles connections, not children, children call Open()
   */     
  private function connect()
  {
//    $this->conn->PConnect('devnew', $this->config->dwhDBUser,
//    $this->config->dwhDBPass, $this->config->dwhDBName);
    if($this->dwhServer == null)
      $this->conn->PConnect($this->config->dwhServer, $this->config->dwhDBUser,
                            $this->config->dwhDBPass, $this->config->dwhDBName);
    else
      $this->conn->PConnect($this->dwhServer, $this->dwhDBUser,
                            '', $this->dwhDBName);
//    echo '</pre>' . print_r($this->dwhServer, true) . '</pre>';
//
//    echo '</pre>' . print_r(, true) . '</pre>';
//    echo '</pre>' . print_r(, true) . '</pre>';
    
//    if(HTFRK_FRAMEWORK_DEBUG)
//    $this->conn->debug = false;
    if (!$this->conn->isConnected())
    {
      throw new Exception('DwhModel cannot connect. ' .
      								'Server: ' . $this->config->dwhServer . 
      								'User: ' . $this->config->dwhDBUser . 
     								'Database: ' . $this->config->dwhDBName);
    }
  }
  /**
   *   Implement these abstract HTModel methods in your model class. 
   *   Here, they explain misuse at runtime
   */   
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
   *   HTModel required methods - declared abstract in HTModel
   */   
  public function open()    // Do everything necessary to populate the object
  {
    if (!$this->conn->isConnected())
    {
      $this->connect();
      if (!$this->conn->isConnected())
      {
        throw new Exception('DwhModel::Open() - could not connect');
      }
    }
    $sql = $this->getOpenSQL();
    $rs = $this->conn->Execute($sql);
    $this->echol($sql);
    if($rs===false)
    {
      $this->EOF = true;
      unset($this->resultList);
    }
    else
    {
      $rs = $rs->GetRows();
      unset($this->resultList);
      $this->resultList = array();
      foreach($rs as $row)
      {
        foreach($row as $colName => $colVal)
        {
          if(isset($this->accessorNames[$colName]))
          {
            $resValues[$this->accessorNames[$colName]] = $colVal;
          }
        }
        $objResult = new HTResult($resValues, $this->child);
        unset($resValues);
        $this->resultList[] = $objResult;
      } // next row
      if(isset($this->resultList) && (count($this->resultList) > 0))
      {
        reset($this->resultList);
        $this->EOF = false;
      }
      else
      {
        $this->EOF = true;
      }
    }
  } // Open
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
      $newPropVals[$accessorName] = '';
      $objResult = new HTResult($newPropVals, $this->childName);
    }
    else
    $objResult = $row;
    $this->resultList[] = $objResult;
    return $objResult;
  }
  /**
   * CRUD methods required by declarations in interface iHTModel
   */   
  public function insert($row = null)  // Execute insert using current logical object data
  {
    if (!$this->conn->isConnected())
    	$this->connect();
    if (!$this->conn->isConnected()) throw new HTException("Not Connected",HTFRK_EX_STOP);
    if($row == null)
    	$sql = $this->getInsertSQL($this->current());
    else
    	$sql = $this->getInsertSQL($row);
    $this->echol($sql);
    if(is_array($sql))
    {
      foreach($sql as $stmt)
      {
        $res = $this->conn->Execute($stmt);
        if ($res===false) throw new HTException ("$this->childName:Insert failed - $stmt - ".
        $this->conn->ErrorMsg(),HTFRK_EX_STOP);
      }
    }
    else
    {
      $res = $this->conn->Execute($sql);
      if ($res===false) throw new HTException ("$this->childName:Insert failed - $sql - ".
      $this->conn->ErrorMsg(),HTFRK_EX_STOP);
    }
  }
  public function update($row = null)  // Execute update using current logical object data and key
  {
    if (!$this->conn->isConnected())
    	$this->connect();
    if (!$this->conn->isConnected()) throw new HTException("Not Connected",HTFRK_EX_STOP);
    if($row == null)
    	$sql = $this->getUpdateSQL($this->current());
    else
    	$sql = $this->getUpdateSQL($row);
    $res = $this->conn->Execute($sql);
    if ($res===false) throw new HTException ("update failed - $sql - ".$this->conn->ErrorMsg(),
    																																	HTFRK_EX_STOP);
  }
  public function delete($row = null)  // Execute update using current logical object key
  {
    if (!$this->conn->isConnected())
	    $this->connect();
    if (!$this->conn->isConnected()) throw new HTException("Not Connected",HTFRK_EX_STOP);
    if($row == null)
	    $sql = $this->getDeleteSQL($this->current());
    else
	    $sql = $this->getDeleteSQL($row);
    $res = $this->conn->Execute($sql);
    if ($res===false) throw new HTException ("Delete failed - $sql - ".$this->conn->ErrorMsg(),
    																																	HTFRK_EX_STOP);
  }
  public function truncate($TName)
  {
    if (!$this->conn->isConnected())
    	$this->connect();
    if (!$this->conn->isConnected()) throw new HTException("Not Connected",HTFRK_EX_STOP);
    	$sql = "TRUNCATE $TName";
    	$res = $this->conn->Execute($sql);
  }
  
  public function lastError() // Return a string describing database error
  {
    return $this->conn->ErrorMsg();
  }
  public function close() // Some DBMS may need to be closed to conserve resources
  {
  }
	/**
	 * EOF() get the end of file boolean.\
	 * This function allows getting (reading)
	 * but does not allow client to change it.
	 */         	
	public function EOF()
	{
    if(count($this->resultList)<=0)
      return true;
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
    if(count($this->resultList)<=0) {
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
    if(count($this->resultList)<=0) {
      $this->EOF = true;
      return false;
    }
    else
    return (!$this->EOF);
  }
  public function getResultList()
  {
    return $this->resultList;
  } 

  public function datetimeToDate($in_datetime)
  {
    Date('Y/m/d', strtotime($in_datetime));
  }
}

?>
