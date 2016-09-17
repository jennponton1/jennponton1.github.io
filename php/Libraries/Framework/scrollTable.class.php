<?php
/**
 * scrollTable - class
 * emit a scrolling table in HTML given an HTModel object and 
 * an array associating column header strings and widths with
 * model accessor names.  
 * Uses (does not extend) tableTemplate class
 *   
 */
   
define( 'ATTR_HDR', 0);
define( 'ATTR_WID', 1);

class scrollTable
{
  private $hdr;
  private $ttHdr;
  private $ttWid;
  private $ttAtt;
  private $tbl;
  private $det;
  private $height;
  public function __construct($inHdr, $inHeight, $inDet = '')
  {
    $this->tbl = new TableTemplate();
    $this->hdr = $inHdr;
    $i = 0;
    foreach($this->hdr as $acc => $attrs)
    {
      $this->ttHdr[$i] = $attrs[0];
      $this->ttWid[$i] = $attrs[1];
      $this->ttAtt[$i] = $attrs[2];
      $i++;
    }
    if($inDet != '')
      $this->setDetail($inDet);
    $this->height = $inHeight;
  }
  public function setDetail($inDet)
  {
    unset($this->det);
    $i = 0;
    foreach($inDet as $det)
    {
      foreach($this->hdr as $acc => $attrs)
        $this->det[$i][] = $det->get($acc);
      $i++;  
    }
  }
  public function toHTML($inHeight = '')
  {
    $this->height = ($inHeight == '') ? $this->height : $inHeight;
    foreach($this->ttAtt as $ndx => $attr)
      if(is_array($attr))
        foreach($attr as $name => $value)
          $this->tbl->setColumnStyle($ndx + 1, $name, $value);

    return $this->tbl->getTable($this->ttWid, $this->height, $this->ttHdr, $this->det);
  }
}
?>
