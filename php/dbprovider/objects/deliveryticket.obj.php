    <?php

require_once "basetable.class.php";

class DeliveryTicket {

    protected $htubdhdr;
    protected $hdrFields = array(
        "deltcktno"     => "ubd",
        "lastname"      => "c",
        "custid"        => "dt",
        "shipdate"      => "ubd",
        "ordernum"      => "ubd",
        "shipaddressid" => "ubd",
        "shipfirstname" => "ubd",
        "shiplastname"  => "ubd",
        "shipaddr1"     => "ubd",
        "shipaddr2"     => "ubd",
        "shipcity"      => "ubd",
        "shipstate"     => "ubd",
        "shipzip"       => "ubd",
        "fob"           => "ubd",
        "shipvia"       => "ubd",
        "custordnbr"    => "ubd",
        "invnbr"        => "ubd",
        "invdate"       => "ubd",
        "shipmemo"      => "dt",
        "shipmemo2"     => "dt",
        "shipmemo3"     => "dt",
        "shipmemo4"     => "dt",
        "shipmemo5"     => "dt",
        "delinst"       => "dt",
        "shipstatus"    => "dt",
        "bundles"       => "dt",
        "carrier"       => "dt",
        "prepaid"       => "dt",
        "collect"       => "dt",
    );
    protected $dtlFields = array(
        "linenbr"  => "det",
        "invtid"   => "det",
        "pcsdelvd" => "det",
        "qtydelvd" => "det",
        "lsn"      => "det",
    );

    public function __construct() {
        $this->htubdhdr = new GenericPVSWTable("htubdhdr");
    }

    public function findOpen() {
        throw new Exception("Failed. Sorry");
    }

    protected function bldQuery($parms) {
        //$hdrQuery = "";
        $dtlQuery = array();
        if (isset($parms['ordnbr'])) {
            $parms['ordernum'] = $parms['ordnbr'];
            unset($parms['ordnbr']);
        }
        $where = $this->htubdhdr->buildWhere(array_keys($parms), array_values($parms), false);
        //throw new Exception($where);
        //return array_merge(array("header" => array("query" => $hdrQuery, "alias" => "ubd")), $dtlQuery);
        return array_merge(array("header" => array("query" => $where, "alias" => "ubd")), $dtlQuery);
    }

    public function findWhere($parms) {
        $rs      = $this->htubdhdr->multiJoin(
            "ubd",
            array(
                new JoinTable("det", "htubddet"),
                new JoinTable("dt", "htdeltck"),
                new JoinTable("c", "customer", array("lastname", "addrid")),
                new JoinTable("xp", "htxdt"),

            ),
            array(
                new JoinLink("OJ", "ubd.deltcktno", "det.deltcktno"),
                new JoinLink("OJ", "ubd.deltcktno", "dt.deltcktno"),
                new JoinLink("OJ", " dt.custid", "c.custid"),
                new JoinLink("OJ", "ubd.deltcktno", "xp.deltcktno"),
                new JoinLink("OJ", "ubd.ordernum", "xp.ordnbr"),
            ),
            $this->bldQuery($parms)
        );
        $dataset = array();
        foreach ($rs as $row) {
            //throw new Exception(var_export($row, true));
            $deltcktno = $row->deltcktno_ubd;
            if (!isset($dataset[$deltcktno])) {
                $item = new StdClass();
                foreach ($this->hdrFields as $field => $alias) {
                    $rsName              = $field . "_" . $alias;
                    $item->$field        = $row->$rsName;
                    $dataset[$deltcktno] = $item;
                }
            }
            $dtObj   = $dataset[$deltcktno];
            $dtlItem = new StdClass();
            foreach ($this->dtlFields as $field => $alias) {
                $rsName          = $field . "_" . $alias;
                $dtlItem->$field = $row->$rsName;
            }
            $dtObj->detail[] = $dtlItem;
            $dtObj->export = false;
            if ($row->deltcktno_xp != null) {
                $dtObj->export = true;
            }
        }
        return array_values($dataset);
    }

    protected function updateFile($file, $dtNbr, $values) {
        if (count($values) > 0) {
            $dtFile = new GenericPVSWTable($file);
            $res = $dtFile->update(array("deltcktno"=>$dtNbr), $values);
            if ($res === false) {
                throw new Exception("Failed during update of $file with ".var_export($values, true));
            }
        }
    }

    public function update($values) {
        // Check for DT #
        $values = (array) $values;
        if (!isset($values['deltcktno'])) {
            throw new Exception("You must pass a delivery ticket # to be update");
        }
        $dtNbr = $values['deltcktno'];
        // separate the fields to be updated into the component files
        // for the htdeltck file
        $dtUpd = array();
        // for the htubdhdr file
        $hdrUpd = array();
        // for the htupddet file
        $detUpd = array();
        foreach($values as $field => $value) {
            if ($field == 'detail') {
                // @TODO: handle the detail here
                $count = 0;
                $dtlTbl = new GenericPVSWTable("htubddet");
                foreach($value as $dtlRow) {
                    $dtlObj = (object) $dtlRow;
                    $updDTKey = array(
                        "deltcktno"=>$values['deltcktno'],
                        "invtid"=>$dtlObj->invtid
                    );
                    $dtlTbl->update($updDTKey, $dtlRow);
                }
            }
            if (isset($this->hdrFields[$field])) {
                // which file?
                switch ($this->hdrFields[$field]) {
                    case "ubd":
                        $hdrUpd[$field] = $value;
                        break;
                    case "dt":
                        $dtUpd[$field] = $value;
                        break;
                    default:
                        continue;
                }
            }
        }
        unset($hdrUpd['deltcktno']);
        // Update DT File
        $this->updateFile("htdeltck", $dtNbr, $dtUpd);
        // Update Hdr File
        $this->updateFile("htubdhdr", $dtNbr, $hdrUpd);

        // get and return the updated record
        return $this->findWhere(array("deltcktno"=>$dtNbr));
    }

}
