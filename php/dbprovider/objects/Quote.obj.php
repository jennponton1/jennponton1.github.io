<?php

require_once "dbDoctrineBase.class.php";

class Quote extends dbDoctrineBase {

    protected $hdrFields = array(
        'quotenbr',
        'revnbr',
        'custid',
        'addrid',
        'slsper',
        'issuedate',
        'trkrate',
        'railrate',
        'carrier',
        'shipvia',
        'stateship',
        'cityship',
        'plant',
        'adjft',
        'quotetot',
        'bftot',
        'instr',
        'fupdate',
        'notes',
        'rkey',
        'resolv',
        'rdate',
        'altused',
        'altid',
        'shiptofname',
        'shiptolname',
        'shiptoaddr1',
        'shiptoaddr2',
        'shiptocity',
        'shiptostate',
        'shiptozip',
        'shiptophone',
        'shiptofax',
        'email',
        'openquote',
        'confirmto',
        'perent',
        'perclosed',
        'leadtime',
        'linecntr',
        'rchrg',
        'crmname',
        'ordnbr',
        'tso',
        'dto',
    );
    protected $dtlFields = array(
        'linenbr',
        'invtid',
        'descr',
        'qty',
        'unit',
        'woodcost',
        'treatcost',
        'treatadj',
        'sddisc',
        'addr',
        'freight',
        'ffactor',
        'totcost',
        'tsize',
        'bf',
        'bu',
        'misc',
        'stkitem',);
    protected $baseSql;
    protected $fieldList;

    public function __construct() {
        parent::__construct("quotes");
        $fieldList = "";
        foreach ($this->hdrFields as $field) {
            if ($fieldList != "") {
                $fieldList .= ", ";
            }
            $fieldList .= "h.$field";
        }
        foreach ($this->dtlFields as $field) {
            if ($fieldList != "") {
                $fieldList .= ", ";
            }
            $fieldList .= "d.$field";
        }
        $this->fieldList = $fieldList;

        $this->baseSql = "select $fieldList
            from Quotes\\Quotehdr h left join Quotes\\Quotedtl d
            with ( h.quotenbr=d.quotenbr and h.revnbr=d.revnbr ) ";
    }

    protected function appendQueryString($query, $newStr) {
        if ($query != '') {
            $query .= 'and ';
        }
        $query .= " $newStr ";
        return $query;
    }

    public function findWhere($parms = "") {
        $critStr  = "";
        $opValMap = array(
            "quotenbr"  => array(
                "op"    => "=",
                "field" => "h.quotenbr",
            ),
            "revnbr"    => array(
                "op"    => "=",
                "field" => "h.revnbr",
            ),
            "openquote" => array(
                "op"    => "=",
                "field" => "h.openquote",
            ),
            "plant"     => array(
                "op"    => "=",
                "field" => "h.plant",
            ),
            "siteid"    => array(
                "op"    => "=",
                "field" => "h.plant",
            ),
            "site"      => array(
                "op"    => "=",
                "field" => "h.plant",
            ),
            "custid"    => array(
                "op"    => "=",
                "field" => "h.custid",
            ),
            "solid"     => array(
                "op"    => "=",
                "field" => "h.addrid",
            ),
            "slsper"    => array(
                "op"    => "=",
                "field" => "h.slsper",
            ),
            "issuedate" => array(
                "op"    => ">=",
                "field" => "h.issuedate",
            ),
        );
        foreach ($parms as $key => $val) {
            $clause     = '';
            $opModifier = "";
            if (substr($key, strlen($key) - 1, 1) == '!') {
                $key        = substr($key, 0, strlen($key) - 1);
                $opModifier = "!";
            }
            if (isset($opValMap[$key])) {
                $clause  = " " . $opValMap[$key]['field'] . " $opModifier" . $opValMap[$key]['op'] . " '$val' ";
                $critStr = $this->appendQueryString($critStr, $clause);
                continue;
            }
            else {
                throw new Exception("NOT IMPLEMENTED IN THIS CLASS");
            }
            //$critStr = $this->appendQueryString($critStr, $clause);
        }
        $newSql = $this->baseSql . " where $critStr ";
        //throw new Exception($newSql);
        $query  = $this->eMgr->createQuery($newSql);
        $list   = $query->getArrayResult();
        return $this->construcDataSet($list);
    }

    protected function construcDataSet($ds, $isTemplate = false) {
        $list     = array();
        $last     = "";
        $count    = 0;
        $dtlArray = array();
        foreach ($ds as $item) {
            if ($item['revnbr'] == -1 && !$isTemplate) {
                continue;
            }
            $count++;
            if ($last != $item['quotenbr'] . $item['revnbr']) {
                // Output last record
                if ($last != "") {
                    $main['detail'] = $dtlArray;
                    $list[]         = $main;
                }
                // Start New Record
                $main = array();
                foreach ($this->hdrFields as $field) {
                    $main[$field] = $item[$field];
                }
                $dtlArray = array();
            }
            $dtlItem = array();
            foreach ($this->dtlFields as $field) {
                $dtlItem[$field] = $item[$field];
            }
            if ($dtlItem['invtid'] != '') {
                $dtlArray[] = $dtlItem;
            }
            $last       = $item['quotenbr'] . $item['revnbr'];
        }
        // Do last record
        if (count($dtlArray) != 0 || isset($main['quotenbr'])) {
            $main['detail'] = $dtlArray;
            $list[]         = $main;
        }
        return $list;
    }

    public function findOpen() {

        $sql   = $this->baseSql . " where h.openquote = 'Y' and h.quotenbr=d.quotenbr and
                                  h.revnbr=d.revnbr order by h.quotenbr ";
        $query = $this->eMgr->createQuery($sql);
        $res   = $query->getArrayResult();

        return $this->construcDataSet($res);
    }

    protected function insertDetail($values) {
        foreach ($values['detail'] as $dtlItem) {
            $dtlItem             = (array) $dtlItem;
            $entityDtl           = new Quotes\Quotedtl();
            $entityDtl->quotenbr = $values['quotenbr'];
            $entityDtl->revnbr   = $values['revnbr'];
            foreach ($this->dtlFields as $fieldName) {
                if (isset($dtlItem[$fieldName])) {
                    $entityDtl->$fieldName = $dtlItem[$fieldName];
                }
                else {
                    $entityDtl->$fieldName = "";
                }
            }
            $this->insertEntity($entityDtl);
        }
    }

    public function insert($values) {
        try {
            $values    = (array) $values;
            $entityHdr = new Quotes\Quotehdr();
            foreach ($this->hdrFields as $fieldName) {
                if (isset($values[$fieldName])) {
                    $entityHdr->$fieldName = $values[$fieldName];
                }
                else {
                    //$entityHdr->$fieldName = "";
                }
            }
            $this->insertEntity($entityHdr);
            $this->insertDetail($values);
            return $this->findWhere(array("quotenbr" => $values['quotenbr'], 'revnbr' => $values['revnbr']));
        }
        catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function update($values) {
        $values   = (array) $values;
        $quoteNbr = $values['quotenbr'];
        $revNbr   = $values['revnbr'];
        if ($quoteNbr == '' || $revNbr == '') {
            throw new Exception("You must include a quote and revision number to update!!!");
        }
        // Get the Header Object
        $hdrTable = $this->eMgr->getRepository("Quotes\Quotehdr");
        $entity   = $hdrTable->findBy(array("quotenbr" => $quoteNbr, "revnbr" => $revNbr));
        if (!is_array($entity) || count($entity) == 0) {
            throw new Exception("Quote $quoteNbr Revision $revNbr NOT FOUND!!!");
        }
        $hdr = $entity[0];
        foreach ($values as $field => $value) {
            $hdr->$field = $value;
        }
        $this->eMgr->flush();
        return $this->findWhere(array("quotenbr" => $quoteNbr, "revnbr" => $revNbr));
    }

}
