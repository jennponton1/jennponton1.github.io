<?php

require_once "basetable.class.php";

class QuoteHistory {

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
        'stkitem',);
    protected $baseSql;

    public function __construct() {
        //parent::__construct("quotes");
        $this->eMgr = new GenericMySqlTable("quotes.quotehdr");
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

        $this->baseSql = "select $fieldList
            from quotes.Quotehdr h left join quotes.Quotedtl d
            on ( h.quotenbr=d.quotenbr and h.revnbr=d.revnbr )
            where h.revnbr = (select max(revnbr) from Quotes.Quotehdr q where q.quotenbr=h.quotenbr)
            /**/
            order by h.quotenbr             ";
    }

    protected function appendQueryString($query, $newStr) {
        if ($query != '') {
            $query .= 'and ';
        }
        $query .= " $newStr ";
        return $query;
    }

    public function findWhere($parms = "") {
        $critStr = "";
        $opValMap = array(
            "quotenbr"=>array(
                "op"=>"=",
                "field"=>"h.quotenbr",
            ),
            "revnbr"=>array(
                "op"=>"=",
                "field"=>"h.revnbr",
            ),
            "openquote"=>array(
                "op"=>"=",
                "field"=>"h.openquote",
            ),
            "plant"=>array(
                "op"=>"=",
                "field"=>"h.plant",
            ),
            "siteid"=>array(
                "op"=>"=",
                "field"=>"h.plant",
            ),
            "site"=>array(
                "op"=>"=",
                "field"=>"h.plant",
            ),
            "custid"=>array(
                "op"=>"=",
                "field"=>"h.custid",
            ),
            "solid"=>array(
                "op"=>"=",
                "field"=>"h.addrid",
            ),
            "slsper"=>array(
                "op"=>"=",
                "field"=>"h.slsper",
            ),
            "issuedate"=>array(
                "op"=>">=",
                "field"=>"h.issuedate",
            ),

        );
        foreach ($parms as $key => $val) {
            $clause = '';
            $opModifier = "";
			if (substr($key, strlen($key)-1, 1) == '!') {
				$key = substr($key, 0, strlen($key)-1);
				$opModifier = "!";
			}
            if (isset($opValMap[$key])) {
                $clause = " ".$opValMap[$key]['field']." $opModifier".$opValMap[$key]['op']." '$val' ";
                $critStr = $this->appendQueryString($critStr, $clause);
                continue;
            }
            else {
                throw new Exception("NOT IMPLEMENTED IN THIS CLASS");
            }
            //$critStr = $this->appendQueryString($critStr, $clause);
        }
        $newSql = str_replace("/**/", " and $critStr ", $this->baseSql);
        //throw new Exception($newSql);
        $query  = $this->eMgr->directQuery($newSql);
        return $this->construcDataSet($query);
    }

    protected function construcDataSet($ds) {
        $list     = array();
        $last     = "";
        $count    = 0;
        $dtlArray = array();
        foreach ($ds as $item) {
            $count++;
            $item = (array) $item;
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
            $dtlArray[] = $dtlItem;
            $last       = $item['quotenbr'] . $item['revnbr'];
        }
        // Do last record
        if (count($dtlArray) != 0  || isset($main['quotenbr'])) {
            $main['detail'] = $dtlArray;
            $list[]         = $main;
        }
        return $list;
    }

    public function findOpen() {

        $sql   = str_replace("/**/", "", $this->baseSql);
        $query = $this->eMgr->directQuery($sql);
        $res   = $query; //$query->getArrayResult();

        return $this->construcDataSet($res);
    }
}
