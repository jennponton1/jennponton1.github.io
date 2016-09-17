<?php

require_once "quote.obj.php";
require_once "basetable.class.php";

class TemplateQuote extends Quote {

    /*
     *  create table qtemplname ( quotenbr int(6), templatename char(200) );
     *
     */

    public function __construct() {
        parent::__construct();
        $this->fieldList .= " ,n.templatename ";
        $fieldList = $this->fieldList;
        $this->hdrFields[] = "templatename";
        $this->baseSql = "select $fieldList
            from Quotes\\Quotehdr h left join Quotes\\Quotedtl d
            with ( h.quotenbr=d.quotenbr and h.revnbr=d.revnbr ) left join Quotes\\QTemplName n with (h.quotenbr=n.quotenbr)";

        //throw new Exception($this->baseSql);
    }

    public function findWhere($parms) {
        $parmsAr = (array) $parms;
        $parmsAr['revnbr'] = '-1';
        return parent::findWhere($parmsAr);
    }

    protected function construcDataSet($ds, $isTemplate = false) {
        return parent::construcDataSet($ds, true);
    }

    public function update($values) {
        $values = (array) $values;
        $quoteNbr = $values['quotenbr'];
        $revNbr = $values['revnbr'];
        if ($quoteNbr == '' || $revNbr == '') {
            throw new Exception("You must include a quote and revision number to update!!!");
        }
        // Get the Header Object
        $hdrTable = $this->eMgr->getRepository("Quotes\Quotehdr");
        $entity = $hdrTable->findBy(array("quotenbr"=>$quoteNbr, "revnbr"=>$revNbr));
        if (!is_array($entity) || count($entity)==0) {
            throw new Exception("Quote $quoteNbr Revision $revNbr NOT FOUND!!!");
        }
        $hdr = $entity[0];
        foreach($values as $field => $value) {
            if ($field == "detail") {
                continue;
            }
            if ($field == 'templatename') {
                // Grab template quote & Nbr to update separately
                $templateName = $value;
                continue;
            }
            $hdr->$field = $value;
        }
        $this->eMgr->flush();
        // handle the details now
        // first delete any existing details for this template
        $delSql =  "delete from Quotes\Quotedtl d where d.quotenbr='".$quoteNbr."' and d.revnbr='-1' ";
        $query = $this->eMgr->createQuery($delSql);
        $query->execute();
        $this->insertDetail($values);
        $tmplTbl = new GenericMySqlTable("qtemplname", "quotes");
        $tmplTbl->update(
            array("quotenbr"=>"$quoteNbr"),
            array("templatename"=>$templateName)
        );
        return $this->findWhere(array("quotenbr"=>$quoteNbr, "revnbr"=>$revNbr));
    }

    public function insert($parms) {
        // remove the template name from the parms
        $parms = (array) $parms;
        $tmpParms = (array) $parms;
        $templateName = $tmpParms['templatename'];
        $quoteNbr = $tmpParms['quotenbr'];
        unset($parms['templatename']);
        $tmpRet = parent::insert($parms);
        $tmplTbl = new GenericMySqlTable("qtemplname", "quotes");
        $tmplTbl->insert(
            array("quotenbr"=>"$quoteNbr",
            "templatename"=>$templateName)
        );
        return $this->findWhere(array("quotenbr"=>$quoteNbr));
    }
}
