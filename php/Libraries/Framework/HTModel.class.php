<?php
// Database Types
// define(HT_TEXT, 1);
// define(HT_INT, 2);
// define(HT_FLOAT, 3);
// define(HT_DATE, 4);
// Presentation attributes
// define(HT_RAW_TXT, 5);
// define(HT_DOLLAR, 6);
// define(HT_FOOTAGE, 7);
// define(HT_SITE, 8);
// define(HT_PERIOD, 9);
// define(HT_ACCT, 10);
// define(HT_PART, 11);
// define(HT_HIDE, 12);
// Validation attributes
// define(HT_VAL_TXT_LEN, 13);
// define(HT_VAL_NUM_INT, 14);
// define(HT_VAL_NUM_DOLLAR, 15);
// define(HT_VAL_NUM_DECI, 16);
/**
 *  HTModel.class.php
 *   
 *  HTModel interfaces and classes at the top of the Framework heirarchy.
 *   
 *  Caution: These classes and interfaces have a high degree dependency on 
 *  them. Modifications are extremely likely to impact code you have never
 *  even seen before. Be afraid, be very afraid.
 *  @package HTFramework
 *  @subpackage HTModel
 *  @filesource      
 */
/**
 * iHTModel - interface 
 * Enforces implementation of open(), insert(), update(), delete() ...etc. methods
 * in higher level framework classes
 */
interface iHTModel {
/*

  Here is an example of how to use the Models :
 
  $mod = new exampleModel($optCriteria);
  $mod->optSetCriteria($optSomeOtherCriteria);
  $mod->open();
  if(!$mod->EOF())
    $obj1 = $mod->current();
  if(!$mod->EOF())
    $obj2 = $mod->next();
  if(!$mod->EOF())
    $obj3 = $mod->next();
  
  $newObj = &$mod->addNew();  // Note the reference operator
  $newObj->exampleProp = 'a value';  
  $newObj->anotherExampleProp = 'another value';  
  $mod->insert();   // The reference was to the current row object. 
                    // It is inserted, creating a new row in the DB.
  $newMod = new exampleModel();
  $newMod->insert($newObj); // The row to insert was provided as a parameter.
                            // insert always creates a new row in the DB.
                            // But the row is not in the list yet.
  $newMod->addNew($newObj); // Now the row is in the list as well.
  
  $mod->delete(); // The current row (in the list) is deleted from the db
  $mod->delete($newObj);  // The supplied row is to be deleted from the db.
  
  // Now go crazy inserting and updating at will
  $mod->insert();
  $newObj->anyProp = 'some example value';
  $mod->insert($newObj);
  $mod->update();
  $newObj->anotherProp = 'another example value';
  $mod->update($newObj);
*/    
  /**
   * method Open() - Do everything necessary to populate the object
   * 
   */
  public function open();

  /**
   *  Create a new result ("row") object with all data memebers set to empty
   *  string (''). Use with insert(). 
   *  The process to add and insert a new logical model object is:
   *  $row = $objMyModel->addNew();
   *  ...   
   *  $row->property = 'some new value';
   *  ...   
   *  $objMyModel->insert($row);
   */     
  /**
   *  Append a new logical data model object to the list and point the iterator 
   *  to it. 
   */
  public function addNew($row = '');
  /**
   *  Database insert of entity object data.
   */       
	public function insert($row = '');
  /**
   *  Database update of current entity object data and key. Key must uniquely
   *  define the set of objects in the database to be updated.   
   */       
	public function update($row = '');
  /**
   *  Database delete using current key which must uniquely define the set of 
   *  objects in the database to be deleted.
   */       
	public function delete($row = '');
	/**
	 * Return a string describing latest (last) database error.
	 */   	
	public function lastError();
	/**
	 * Some DBMS's may need to be closed to conserve resources.	
	 */	
	public function close();   
}
/**
 * clsHTModel - class (abstract) 
 *
 * Both the <DB>Model and <Logical>Model children should implement these methods.
 * <DB>Model class should return false while <Logical>Model should return 
 * appropriate value.
 *  @package HTFramework
 *  @subpackage HTModel
 */  
abstract class clsHTModel {
  private $emptyVals;
  private $orderByList;
  /**
   *  newRow()
   *  
   */        
  public function newRow()
  {
    if(!isset($this->emptyVals))
    {
      foreach($this->accessorNames as $acc)
        $this->emptyVals[$acc] = '';
    }
    return new HTResult($this->emptyVals);
  }
  /**
   *   getColumnList() - Return a SQL style list of column names, sorted.   
   *   
   */      
  protected function getColumnList()
  {
    $k = array_keys($this->accessorNames);
    sort($k);
    return implode(', ', $k);
  }
  /**
   *   getAccessorNames() - Return an array of accessor names, sorted.   
   *   
   */      
  public function getAccessorNames()
  {
    $k = array_values($this->accessorNames);
    sort($k);
    return $k;
  }
  public function setSortOrder($in_accessorList)
  {
    foreach($in_accessorList as $acc)
      if(array_search($acc, array_values($this->accessorNames)) === false)
        throw new HTException("clsHTModel::setSortOrder() called with invalid accessor name $acc");
    foreach($in_accessorList as $acc)
      $cols[] = array_search($acc, $this->accessorNames);
    $this->orderByList = implode(', ', $cols);
  }
 /**
  *   string getColList([string $accessor [, string $accessor]...])
  *
  *   Returns a comma separated list of all column names if no $accessor(s) is 
  *   given, or a partial list if one or more $accessor's are supplied. Note that
  *   no provision for standard SQL functions is made. This means that usage
  *   of the following form will be typical:
  *   $sql = 'select ' . getColList('AccOne', 'AccTwo') . ', COUNT(col), ' . 
  *                                             getColList('AccThree', 'AccFour');
  *
  *   which would yield:
  *
  *   select col1, col2, COUNT(col), col3, col4
  *
  *   This method throws an exception if any accessor is unknown.
  */
  protected function getColList()
  {
    $ret = '';
    foreach($this->accessorNames as $col => $acc)
      $ret .= $col . ', ';
    if(strlen($ret) > 2)
    $ret = substr($ret, 0, strlen($ret) -2);
    return $ret;
  }

  protected function getOrderByList()
  {
    return ($this->orderByList == '') ? '' : ' order by ' . $this->orderByList;
  }
  /**
   * The inheriting (child) class should return the SQL select statement that
   * defines the set of rows that will be used to populate the object.
   */           
abstract protected function getOpenSQL();
  /**
   * The inheriting (child) class should return the SQL insert statement that
   * defines how to insert the values from the given current object.
   */           
abstract protected function getInsertSQL($current);
  /**
   * The inheriting (child) class should return the SQL update statement that
   * defines the set of rows that will be updated and the values to update
   * given the values in the current object.
   */           
abstract protected function getUpdateSQL($current);
  /**
   * The inheriting (child) class should return the SQL select statement that
   * defines the set of rows that will be deleted.
   */           

public function toXML()
{
	foreach($this as $row)
		$ret .= '  ' . $row->toXML($htNamesAttr, $rowTag, $colTag) . "\n";
	return $ret;
}

abstract protected function getDeleteSQL($current);
  /**
   *  echol(...)  
   * Write a message to a log file 
   * Log file name is taken from $_REQUEST['log'] i.e. simply add ?log=my.log.txt
   * to your URL. If none is given the name is built from this script file name
   * with ".echol." appended and the requesters ip address appended to that, finally,
   * ".html" is appended as all messages are enclosed with pre and code tags.	
   * Example:
   * X:/Inetpub/php/Libraries/Framework/HTModel.class.php.echol.10.0.0.172.html	 	  	    
   *	 	    
   * Log file size is kept between 10k and 5k on growth.
   *
   */	 	 
protected  function echol($message)
{
	if(($_SERVER['SERVER_NAME'] <> 'mirror.htwp.com') || 
//			($_SERVER['SERVER_ADDR'] <> '10.0.0.1') || 
			($_SERVER['SERVER_PORT'] <> '80'))
		return;
	$message = print_r($message, true);
	$dt = date('l dS \of F Y h:i:s A');
	$fname =  __FILE__ . '.echol.' . $_SERVER['REMOTE_ADDR'];
	if(isset($_REQUEST['log']))
		$fname = $fname . $_REQUEST['log'].'.html';
	else
		$fname = $fname . '.html';
	$txt = "<pre><code>\n===================" . __FILE__ . "=====================\n";
	$txt .= "<b>Request Tick:</b> " . $_SERVER['REQUEST_TIME'] . "  <b>URI:</b> " . $_SERVER['REQUEST_URI'];
	$txt .= "    <b>Method</b>: " . $_SERVER['REQUEST_METHOD'] .  "  <br><b>Class</b>: " . get_class($this);
	$txt .=  '::' . get_parent_class($this) . '::' . get_parent_class(get_parent_class($this));
	$txt .= "\n$dt\n<b>------message-begin-------</b>\n$message\n<b>------message-end-------</b>\n</code></pre>\n";
	if(file_exists($fname)) {
		$content = file_get_contents($fname);
		if(strlen($content) > 30000) {
			$content = substr($content, strlen($content) - 5000);
			$content = substr($content, strpos($content, "\n<pre><code>")); 
			file_put_contents($fname, $content . $txt);
		} else
			file_put_contents($fname, $txt, FILE_APPEND);
	}
	else {
		file_put_contents($fname, $txt);
	}
}
} // end class clsHTModel
?>