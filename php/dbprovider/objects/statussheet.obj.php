<?php

class StatusSheet extends dbDoctrineBase {

    public function __construct() {
        parent::__construct();
        $this->sql = "select s.ordNbr,
                             s.invtId,
                             s.status,
                             s.siteId,
                             s.pcs,
                             s.bf,
                             s.statEdit,
                             h.custId ,
                             m.slsPerId,
                             m.custOrdNbr,
                             m.ordDate,
                             m.dtRdy,
                             m.dtDueToShip,
                             m.carrier,
                             m.toTord,
                             m.shipped,
                             m.matlRcvdDt,
                             m.notes,
                             m.custName,
                             i.descr
                             from Dwh\\statdet s, Dwh\\soblhdr h , Dwh\\Statsum m, Dwh\\Invent i
                             where (s.ordNbr=h.ordNbr) and (s.ordNbr=m.ordNbr) and (s.invtId=i.invtId) /**/ ";
        $this->openSql = str_replace("/**/", "", $this->sql);
    }

    protected function commonFindWhere($critAr) {
        $whereString = "";
        foreach ($critAr as $key => $val) {
            if ($whereString != "") {
                $whereString .= " and ";
            }
            switch ($key) {
                case "slsperid":
                    $whereString .= " m.slsPerId = '$val' ";
                    break;
                case "siteid":
                    $whereString .= " s.siteId = '$val' ";
                    break;
                case "dtlstatus":
                    $whereString .= " s.status = '$val' ";
                    break;
                case "status":
                    $whereString .= " m.status = '$val' ";
                    break;
                case "custid":
                    $whereString .= " h.custId = '$val' ";
                    break;
                default:
                    throw new Exception("Not implemented -- $key");
            }
        }
        if ($whereString != "") {
            $whereString = " and $whereString ";
        }
        $sql = str_replace("/**/", $whereString, $this->sql);
        $query = $this->eMgr->createQuery($sql);
        $results = $query->getArrayResult();
        return $results;
    }

    public function findWhere($critAr = "") {
        if (!is_array($critAr)) {
            throw new Exception("You must pass an array to this function");
        }
        $new = true;
        if (isset($critAr['old'])) {
            $new = false;
            unset($critAr['old']);
        }
        $results = $this->commonFindWhere($critAr);
        $retSet = $this->constructDataset($results);
        if ($new) {
            return $retSet;
        }
        else {
            return $results;
        }
    }

    public function constructDataset($results) {
        $retSet = array();
        foreach($results as $row) {
            if (!isset($retSet[$row['ordNbr']])) {
                $retSet[$row['ordNbr']] = new stdClass();
                $retSet[$row['ordNbr']]->ordnbr = $row['ordNbr'];
                $retSet[$row['ordNbr']]->custid = $row['custId'];
                $retSet[$row['ordNbr']]->custname = $row['custName'];
                $retSet[$row['ordNbr']]->custordnbr = $row['custOrdNbr'];
                $retSet[$row['ordNbr']]->slsperid = $row['slsPerId'];
                $retSet[$row['ordNbr']]->orddate = $row['ordDate'];
                $retSet[$row['ordNbr']]->shipdate = $row['dtDueToShip'];
                $retSet[$row['ordNbr']]->dtrdy = $row['dtRdy'];
                $retSet[$row['ordNbr']]->carrier = $row['carrier'];
                $retSet[$row['ordNbr']]->totord = $row['toTord'];
                $retSet[$row['ordNbr']]->shipped = $row['shipped'];
                $retSet[$row['ordNbr']]->notes = $row['notes'];
                $retSet[$row['ordNbr']]->siteid = $row['siteId'];

                $retSet[$row['ordNbr']]->detail = array();
            }
            $dtlObj = new StdClass();
            $dtlObj->invtid = $row['invtId'];
            $dtlObj->pcs = $row['pcs'];
            $dtlObj->descr = $row['descr'];
            $dtlObj->status = $row['status'];
            $retSet[$row['ordNbr']]->detail[] = $dtlObj;
        }
        return array_values($retSet);
    }

    public function findOpen() {
        $query = $this->eMgr->createQuery($this->openSql);
        $results = $query->getArrayResult();
        $retSet = $this->constructDataset($results);
        //return $results;
        return $retSet;
    }
}
