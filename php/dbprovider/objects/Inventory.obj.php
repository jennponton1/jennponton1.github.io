<?php

require_once "basetable.class.php";

class Inventory {
    protected $invent;
    protected $invObj;
    protected $fields = array(
         'invtid',
         'descr',
         'classid',
         'user1',
         'user2',
         'stkitem',
    );
    protected $updateMap = array(
        "wdtype"=>"",
        "woodid"=>"user1",
        "trtid"=>"user2",
        "bf"=>"CONV",
        "sf"=>"CONV",
        "bndl"=>"CONV",
        "cuft"=>"CONV",
        "ea"=>"CONV",
        "prodcat"=>"",
        "chemcat"=>"",
        "chemcatsub"=>"",
        "drying"=>"",
        "labor"=>"",
        "handling"=>"",
        "retention"=>"",
        "packaging"=>"",
        "cat1"=>"",
        "cat2"=>"",
    );

    protected $fieldMap = array(
        "user1"=>"woodid",
        "user2"=>"trtid"
    );

    public function __construct() {
        $this->invent = new GenericPVSWTable('invntory');
        $this->invObj = (object) array(
            'invtid'=>"",
            'descr'=>"",
            'classid'=>"",
            'woodid'=>"",
            'trtid'=>"",
            'stkitem'=>"",
        );
    }

    public function findOpen() {
        throw new Exception("Can't retrieve all open on this object");
    }

    protected function getMappedFieldName($field) {
        $fieldName = "";
        if (in_array($field, $this->fields)) {
            $fieldName = $field;
            if (isset($this->fieldMap[$fieldName])) {
                $fieldName = $this->fieldMap[$fieldName];
            }
        }
        return $fieldName;
    }

    protected function getResultFieldName($field) {
        $fieldName = "";
        $fieldAr = explode("_", $field);
        switch ($fieldAr[1]) {
            case "i":
                $fieldName = $this->getMappedFieldName($fieldAr[0]);
                break;
            case "s":
            case "u":
            case "o":
                break;
            default:
                if ($fieldAr[0] !== 'invtid') {
                    $fieldName = $fieldAr[0];
                }
        }
        return $fieldName;
    }

    protected function constructDataset($stmt) {
        $ds = array();
        foreach($stmt as $row) {
            $obj = clone $this->invObj;
            if (isset($ds[$row->invtid_i])) {
                continue;
            }
            foreach($row as $field => $value) {
                $fieldName = $this->getResultFieldName($field);
                if ($fieldName != "") {
                    $obj->$fieldName = $value;
                }
            }
            $obj->wdtype = substr($obj->invtid, 0, 1);
            $ds[$obj->invtid] = $obj;
        }
        ksort($ds);
        return array_values($ds);
    }

    protected function getLinkedTables($criteria) {
        $linkArray = array();
        $tableArray = array();
        $myBase = $this->invent;
        $tblAlias = "i";
        if (isset($criteria['ordnbr'])) {
            $tblAlias  = "s";
            $myBase = new GenericPVSWTable("sodet");
            $tableArray[] = new JoinTable("i", "invntory", array_merge($this->fields));
            $linkArray[] = new JoinLink("IJ", "s.invtid", "i.invtid");
        }
        elseif (isset($criteria['ponbr'])) {
            $tblAlias = 'o';
            $myBase = new GenericPVSWTable("purdtl");
            $tableArray[] = new JoinTable("i", "invntory", array_merge($this->fields));
            $linkArray[] = new JoinLink("IJ", "o.invtid", "i.invtid");
        }
        elseif (isset($criteria['openpos'])) {
            $tblAlias  = "o";
            $criteria['openpo'] = $criteria['openpos'];
            unset($criteria['openpos']);
            $myBase = new GenericPVSWTable("purchord");
            $tableArray[] = new JoinTable("u", "purdtl");
            $tableArray[] = new JoinTable("i", "invntory", array_merge($this->fields));
            $linkArray[] = new JoinLink("IJ", "o.ponbr", "u.ponbr");
            $linkArray[] = new JoinLink("IJ", "u.invtid", "i.invtid");
        }
        elseif (isset($criteria['opensos'])) {
            $tblAlias  = "o";
            $criteria['openso'] = $criteria['opensos'];
            unset($criteria['opensos']);
            $myBase = new GenericPVSWTable("salesord");
            $tableArray[] = new JoinTable("u", "sodet");
            $tableArray[] = new JoinTable("i", "invntory", array_merge($this->fields));
            $linkArray[] = new JoinLink("IJ", "o.ordnbr", "u.ordnbr");
            $linkArray[] = new JoinLink("IJ", "o.ordtype", "u.ordtype");
            $linkArray[] = new JoinLink("IJ", "o.bocntr", "u.bocntr");
            $linkArray[] = new JoinLink("IJ", "o.ordnbr", "u.ordnbr");
            $linkArray[] = new JoinLink("IJ", "u.invtid", "i.invtid");
        }
        elseif (isset($criteria['vmiitems'])) {
            unset($criteria['vmiitems']);
            $criteria["whseloc"] = 'VM%';
            $tblAlias = 'o';
            $myBase = new GenericPVSWTable("location");
            $tableArray[] = new JoinTable("i", "invntory", array_merge($this->fields));
            $linkArray[] = new JoinLink("IJ", "o.invtid", "i.invtid");
        }
        $ret = (object) array(
            "linkArray" => $linkArray,
            "tableArray" => $tableArray,
            "myBase" => $myBase,
            "tblAlias" => $tblAlias,
            "criteria" => $criteria,
        );
        return $ret;
    }


    public function findWhere($criteria)  {
        $criteria = (array) $criteria;
        if ($criteria === null) {
            throw new Exception("You must pass criteria to this function");
        }
        $stopAtSql = true;
        if (isset($criteria['openpos'])) {
            //$stopAtSql = true;
        }
        $setupObj = $this->getLinkedTables($criteria);
        $linkArray = $setupObj->linkArray;
        $tableArray = $setupObj->tableArray;
        $myBase = $setupObj->myBase;
        $tblAlias = $setupObj->tblAlias;
        $criteria = $setupObj->criteria;


        $linkArray[] =new JoinLink("IJ", "i.invtid", "c.invtid");
        $linkArray[] = new JoinLink("IJ", "i.classid", "p.prodcat");
        $tableArray["c"] = "htinconv";
        $tableArray["p"] = "htinprod";

        $where = $myBase->buildWhere(
            array_keys($criteria),
            array_values($criteria),
            false
        );
        $stmt = $myBase->multiJoin(
            $tblAlias,
            $tableArray,
            $linkArray,
            array(
                "header"=>array(
                    "query"=>$where,
                    "alias"=>$tblAlias
                )
            ),
            $stopAtSql
        );
        if ($stopAtSql) {
            $stmt = $myBase->directQuery($stmt->sql, $stmt->values);
            //throw new Exception(var_export($stmt, true));
        }
        return $this->constructDataset($stmt);
    }

    protected function buildUpdateObjects($values) {
        $invUpd = array();
        $convUpd = array();
        foreach($this->fields as $col) {
            $field = $col;
            if (isset($this->fieldMap[$col])) {
                $field = $this->fieldMap[$col];
            }
            if (isset($values[$field])) {
                $invUpd[$col] = $values[$field];
            }
        }
        foreach($this->updateMap as $field => $column) {
            if (!isset($values[$field])) {
                continue;
            }
            if ($column == "CONV") {
                $convUpd[$field] = $values[$field];
            }
        }
        unset($invUpd['invtid']);
        if (count($invUpd) == 0) {
            $invUpd = false;
        }
        if (count($convUpd) == 0) {
            $convUpd = false;
        }
        return (object) array("convUpd"=>$convUpd, "invUpd"=>$invUpd);
    }

    public function update($values) {
        $values = (array) $values;
        if (!isset($values['invtid'])) {
            throw new Exception('you must include an invtid to be updated!');
        }
        // Build update objects
        $updObjects = $this->buildUpdateObjects($values);
        if ($updObjects->invUpd) {
            $this->invent->update(array("invtid"=>$values['invtid']), $updObjects->invUpd);
        }
        if ($updObjects->convUpd) {
            $convTable = new GenericPVSWTable("htinconv");
            $convTable->update(array("invtid"=>$values['invtid']), $updObjects->convUpd);
        }
        return $this->findWhere(array("invtid"=>$values['invtid']));
    }

    public function insert($values) {
        $values = (array) $values;
        if (!isset($values['invtid'])) {
            throw new Exception('you must include an invtid to be updated!');
        }
        // Build update objects
        $updObjects = $this->buildUpdateObjects($values);
        if ($updObjects->invUpd) {
            $this->invent->insert(array_merge(array("invtid"=>$values['invtid']), $updObjects->invUpd));
        }
        if ($updObjects->convUpd) {
            $convTable = new GenericPVSWTable("htinconv");
            $convTable->insert(array_merge(array("invtid"=>$values['invtid']), $updObjects->convUpd));
        }
        return $this->findWhere(array("invtid"=>$values['invtid']));
    }

    public function delete($values) {
        $values = (array) $values;
        if (!isset($values['invtid'])) {
            throw new Exception('you must include an invtid to be deleted!');
        }
        // Make sure there are no % in there
        if (strpos($values['invtid'], "%") !== false) {
            throw new Exception("You may not delete items using a %");
        }

        $values = array("invtid"=>$values['invtid']);
        // get the item for archival
        $res = $this->findWhere(array("invtid"=>$values['invtid']));
        if (is_array($res) && count($res) > 0) {
            // Add to deleted
            require_once "deletedinventory.obj.php";
            $delHandler = new DeletedInventory();
            $delHandler->insert((array) $res[0]);
            $this->invent->delete($values);
            $convTable = new GenericPVSWTable("htinconv");
            $convTable->delete($values);
            $tmpMySql = new GenericMySqlTable("invent");
            $tmpMySql->delete($values);
            $tmpMySql = new GenericMySqlTable("htinconv");
            $tmpMySql->delete($values);
        }
        
        return array($values);
    }

}
