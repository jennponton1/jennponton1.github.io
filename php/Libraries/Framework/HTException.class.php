<?php
/**
 *  HTException - class
 *  @package HTFramework
 *  @subpackage HTCommon
 *  @filesource 
 */   
class HTException extends Exception
{
   /**
    *    Redefine the exception so message and code aren't optional
    */        
   public function __construct($message, $code = HTFRK_EX_NOTICE) 
   {
       parent::__construct($message, $code);
   }
  /**
   *  toString - text version of error message suitable for logs etc.
   */     
  public function toString($verbose = false)
  {
    return($this->getVerbage($verbose, "\n"));
  }
  /**
   *  toHtmlDiv - HTML version of error message suitable display to user.
   */     
  public function toHtmlDiv($verbose = false, $style = '')
  {
    $ret = "<div style='$style'>\n";
    $ret .= $this->getVerbage($verbose, "<br>\n");
    $ret .= "</div>\n";
    return $ret;
  }
  /**
   *  toHtmlPage - HTML version of error message suitable display to user.
   */     
  public function toHtmlPage($verbose = false, $style = '')
  {
    $ret = "<html>\n";
    $ret .= "<head><title>HTException</title></head>\n";
    $ret .= "<body>\n";
    $ret .= "<div style='$style'>\n";
    $ret .= $this->getVerbage($verbose, "<br>\n");
    $ret .= "</div>\n";
    $ret .= "</body>\n";
    return $ret;
  }

  private function getVerbage($verbose, $sep)
  {
    $ret = "HTException: ";
    if($verbose)
    {
      $ret .= $this->getMessage() . $sep;                // message of exception 
      $ret .= "Code: " . $this->getCode() . "(" . $this->decode($this->getCode()) . ")" . $sep;
      $ret .= "File: " . $this->getFile() . $sep;                   // source filename
      $ret .= "Line: " . $this->getLine() . $sep;                   // source line
      $trace = $this->getTrace();      // an array of the backtrace()
      foreach($trace as $level)
      {
        $ret .= $sep . "Function: " . $level['function'] . $sep;
        $ret .= "Arguments: " . print_r($level['args'], true) . $sep;
        $ret .= "File: " . $level['file'] . $sep;
        $ret .= "Line: " . $level['line'] . $sep;
      }                  
//      $ret .= "Trace: " . $this->getTraceAsString() . $sep;          // formated string of trace
    }
    else
    {
      $ret .= $this->__toString();
    }
    return $ret;
  }
/**
 *  The code of the HTException is related to the severity and should suggest 
 *  what to do with the exception.
 */ 
  private function decode($code)
  {
    $ret = '';
    switch($code){
      case HTFRK_EX_NOTICE : 
        $ret = 'HTFRK_EX_NOTICE';
        break;
      case HTFRK_EX_WARNING : 
        $ret = 'HTFRK_EX_WARNING';
        break;
      case HTFRK_EX_STOP : 
        $ret = 'HTFRK_EX_STOP';
        break;
      default: $ret = 'Invalid Code'; 
    }
    return $ret;
  }
}
?>
