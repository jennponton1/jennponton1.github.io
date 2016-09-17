<?php

/**
 * TODO Maintain valid state : valid() to return bool based on all input vars
 *  Trt == SlsPrice - wood - frt - misc
 *  ExtTrt == ExtTot - ExtWood - ExtFrt - ExtMisc
 *  On order entry:
 *     wood+trt+trt adj+frt+misc == total slsprice
 */

/**
 *  Class:      extCalculator.class
 *  Purpose:    To calculate extended pricing details
 *  Uses:       PHP magic __get(...) and __set(...)
 *  Returns:    Extended pricing values in output vars
 *
 */
class extCalculator {

    // Price inputs - can only be set (LHS)
    private $invtid;
    private $wood;
    private $misc;
    private $freight;
    private $treating;
    private $trtadj;
    private $slsprice;
    private $pieces;
    private $bffac;
    private $bndlfac;
    private $sffac;
    private $credit;
    private $stkitem;
    private $invctot;

    /**
     *  priceKeys - used to allow setting an entire array of  price components
     *  with one call. These are the keys to the array to be passed.
     *  IMPORTANT: These array elements must match, one to one, the above members.
     */
    private $priceKeys     = array('invtid',
        'wood',
        'misc',
        'freight',
        'treating',
        'trtadj',
        'slsprice',
        'pieces',
        'bffac',
        'sffac',
        'bndlfac',
        'credit',
        'stkitem',
        'invctot');
    // Calculated extensions - can only be retrieved (RHS)
    private $extTreating;
    private $extWood;
    private $extMisc;
    private $extFreight;
    private $extOther;  //Freight, Misc
    private $extBF;
    private $extBU;
    private $extPrice;

    /**
     * extensionKeys - used to allow checking retrieval of values
     *  IMPORTANT: These array elements must match, one to one, the above members.
     */
    private $extensionKeys = array(
        'extTreating',
        'extWood',
        'extMisc',
        'extFreight',
        'extOther',
        'extBF',
        'extBU',
        'extPrice');
    private $dirty;

    public function __construct() {
        $this->dirty = false;
    }

    //end InvoiceObject
    // set  - fill in input values
    public function __set($name, $val) {
        switch ($name) {
            case 'dirty':
                $this->dirty = $val;
                break;
            default:
                // TODO: Perform validity checks of 13 values here
                if (array_search($name, $this->priceKeys) !== false) {
                    $this->$name = $val;
                }
                else {
                    throw new Exception("extCalculator::set... member $name not found.");
                }
                $this->dirty = true;
        } // end switch
    }

    public function __get($name) {
        switch ($name) {
            case 'dirty':
                return $this->dirty;
                break;
            default:
                if ($this->dirty) {
                    $this->calculate();
                }
                if (array_search($name, $this->extensionKeys) === false) {
                    throw new Exception("extCalculator::get... member $name not found.");
                }
                if (isset($name)) {
                    return $this->$name;
                }
                else {
                    throw new Exception("extCalculator::get... member $name not set.");
                }
        } // end switch
    }

    public function setPriceComponents($in_price) {
        if (!is_array($in_price)) {
            throw new Exception('extCalculator::set... parameter must be array.');
        }
        foreach ($in_price as $component => $val) {
            if (array_search($component, $this->priceKeys) !== false) {
                $this->$component = $val;
            }
            else {
                throw new Exception("extCalculator::setPriceComponents(...) member $component not found.");
            }
        }
        $this->dirty = true;
    }

    /**
     * Method: valid()
     * Access: private
     * Purpose: determine if the object is in a state which will allow calculation
     * Output: boolean
     */
    private function valid() {
        return true;
    }
    
    private function checkDirty() {
        if (!$this->dirty) {
            throw new Exception('extCalculaor::calculate() called while clean');
        }
    }
    
    private function checkValid() {
        if (!$this->valid()) {
            throw new Exception('extCalculaor::calculate() invalid object state');
        }
    }

    /**
     *    Method:     calculate()
     *    Access:     private
     *    Purpose:    To calculate extensions. Object must be dirty, i.e. inputs
     *      changed from initial state or changed after previoius calculation.
     *      Object must also be valid.
     *    Calls:      GetBillUnit, GetBdFt
     *    Input from:
     *    pieces
     *    invtid
     *
     *    Output to:
     *
     */
    private function calculate() {
        $this->checkDirty();
        $this->checkValid();
        $this->pieces = round($this->pieces);
        $type         = substr($this->invtid, 0, 1);
        $bu           = 0;
        //Board Footage & BU:
        switch ($type) {
            case 'B':
                $bu = $this->pieces * $this->sffac;
                $bf = $this->pieces * $this->sffac * $this->bffac;
                break;
            case 'A':
                $bu = $this->pieces * $this->bffac;
                $bf = $this->pieces * $this->bffac;
                break;
            default:
                $bu = $this->pieces;
                $bf = $this->pieces * $this->bffac;
        }  //end switch
        $bu = round($bu);
        if (($type == 'A' or $type == 'B') && ($this->stkitem)) {
            $bu = round($bu / 1000, 3);
        }  //end if
        $this->extBU = $bu;
        $this->extBF = round($bf);

        //Wood:
        $this->extWood = round($this->wood * $bu, 2);

        //Misc:
        $this->extMisc = round($this->misc * $bu, 2);

        //Freight:
        $this->extFreight = round($this->freight * $bu, 2);

        //Treating
        $trt               = $this->slsprice - ($this->misc + $this->wood + $this->freight);
        $this->extTreating = round($trt * $bu, 2);
        if (isset($this->stkitem) && !$this->stkitem) {
            $this->extBF       = 0;
            $this->extTreating = 0;  //can't have treating on non-stock item
            $this->extMisc     = $this->invctot - $this->extTreating - $this->extWood - $this->extFreight;
        } //end if

        $this->extOther    = round(($this->misc + $this->freight) * $bu, 2);
        $this->extPrice    = round($this->slsprice * $bu, 2);
        // added by rsk
        $this->extTreating = $this->extPrice - $this->extFreight - $this->extWood - $this->extMisc;

        //Credit:
        if ($this->credit) {
            $this->invctot     = $this->invctot * (-1);
            $this->extBF       = $this->extBF * (-1);
            $this->extBU       = $this->extBU * (-1);
            $this->extWood     = $this->extWood * (-1);
            $this->extMisc     = $this->extMisc * (-1);
            $this->extFreight  = $this->extFreight * (-1);
            $this->extOther    = $this->extOther * (-1);
            $this->extTreating = $this->extTreating * (-1);
            $this->extPrice    = $this->extPrice * (-1);
        }  //end if
    }

    //end function Calculate

    /**
     * Some diagnostic functions
     *
     */
    public function priceToHTML() {
        $ret = "
      invtid: $this->invtid
      wood: $this->wood
      misc: $this->misc
      freight: $this->freight
      treating: $this->treating
      trtadj: $this->trtadj
      slsprice: $this->slsprice
      pieces: $this->pieces
      bffac: $this->bffac
      bndlfac: $this->bndlfac
      sffac: $this->sffac
      credit: $this->credit
      stkitem: $this->stkitem
      invctot: $this->invctot";
        return $ret;
    }

    public function extensionsToHTML() {
        $ret = "
      extTreating: $this->extTreating
      extWood: $this->extWood
      extMisc: $this->extMisc
      extFreight: $this->extFreight
      extOther: $this->extOther
      extBF: $this->extBF
      extBU: $this->extBU
      extPrice: $this->extPrice";
        return $ret;
    }

    public function toHTML() {
        $ret = '<pre><code>' . $this->priceToHTML()
            . $this->extensionsToHTML() . '</code></pre>';
        return $ret;
    }

}

// end class extCalculator
