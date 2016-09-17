<?php
/**
 *  HTResult.class.php
 *
 *  HTResult class is near the top of the Framework heirarchy.
 *
 *  Caution: This class has a high degree dependency on it. Modifications are
 *  extremely likely to impact code you have never even seen before. Be afraid,
 *  be very afraid.
 *  @package HTFramework
 *  @subpackage HTModel
 *  @filesource
 */
/**
 * HTResult - class
 *  Implements the data member accessor methods used for syntax like:
 *  $objEntity->dataMember = someVal;
 *              - and -
 *  $someVar = $objEntity->dataMember;
 *  Note that no data members are actually defined explicitly. That's because
 *  PHP implements the __get and __set "magic" methods that are called when
 *  data members are updated or referenced (i.e. are RHS or LHS in assignments)
 */
class HTResult
{
/**
 * @var $result - an array of accessor values keyed by accessor name
 */
  private $result = array();
  private $types = array();       // array of types keyed by accessor name
  private $modelName = 'unknown'; // keep the name of the owning model class for errors
  private $objModel = null;       // keep a reference to the owning model object
  /**
   *  HTResult constructor. Construct a result with an array of accessor names
   *  and values
   */
  public function __construct($inResult, $in_objModel = null)
  {
  	if (!is_object($in_objModel)) {
  		$this->modelName = "";
  	}
  	else {
    	$this->modelName = get_class($in_objModel);
  	}
    $this->objModel = &$in_objModel;
    if(count($inResult) <= 0)
      throw new HTException("$in_modelName Cannot construct result with no accessors", HTFRK_EX_WARNING);
    $this->result = $inResult;
  }

  public function get($nm)
  {
    return $this->__get($nm);
  }
  /**
   * Accessor name is RHS in an assignment, return it's value
   */
   public function getFields() {
     $ret = array_keys($this->result);
     return $ret;
   }

  public function __get($nm)
  {
    if (array_key_exists($nm,$this->result)) {
      $r = $this->result[$nm];
      return $r;    // value is stored in array
    } else {
      if(($this->objModel != null) && method_exists($this->objModel, $nm)) {
        return $this->objModel->$nm($this->result); // value is calc'ed
      }
      else {
        $names = print_r($this->result, true);
        throw new
        HTException("$this->modelName result cannot retrieve or calculate $nm. Names are:<pre>$names</pre>",
                HTFRK_EX_WARNING);
      }
    }
  }
  /**
   * Accessor name is LHS in an assignment, set it's value given accessor name
   */
  public function __set($nm, $val)
  {
     if (array_key_exists($nm, $this->result)) {
         $this->result[$nm] = $val;
     } else {
          $names = print_r($this->result, true);
         throw new HTException(
                      "$this->modelName result cannot set $nm to $val - invalid accessor name. "
                      . "Names are:<pre>$names</pre>",
                       HTFRK_EX_WARNING);
     }
  }
  /**
   * Return true if the accessor name is known and accociated value is set
   */
  public function __isset($nm)
  {
     return isset($this->result[$nm]);
  }
  /**
   * Make sure the accessor name is not associated with a value
   */
  public function __unset($nm)
  {
     unset($this->result[$nm]);
  }

  public function toHTML($retStr = false)
  {
    $ret = "<p>$this->modelName<table>";
    foreach($this->result as $acc => $val)
      $ret .= "<tr><td>$acc</td><td>$val</td></tr>";
    $ret .= '</table>';
    return $ret;
  }

   public function toXML()
  {
   	$ret = "\n<data>";
    foreach($this->result as $acc => $val) {
    	$val = htmlentities($val, ENT_QUOTES);
     	$ret .= "<$acc>$val</$acc>";
    }
    $ret .= "</data>";
    return $ret;
  }

	 public function getModelName()
  {
    return $this->modelName;
  }
}
