<?php

class DocumentStore {
    protected $url = "http://devappsvcs.htwp.com/documentstore/api/";//"http://10.0.0.164:5000/docstore/api/";

    public function findOpen() {
        return $this->findWhere(array());
    }

    public function findWhere($params) {
        $paramAr = (array) $params;
        if (!isset($paramAr['documenttype'])) {
            throw new Exception("You must pass a document type!!");
        }
        $docType = $paramAr['documenttype'];
        unset($paramAr['documenttype']);
        if (count($paramAr) > 0) {
            // This means that there are tags
            $urlStr = $this->url."query/".$docType."?";
            $count = 0;
            foreach($paramAr as $key => $val) {
                if ($count > 0) {
                    $urlStr .= "&";
                }
                $urlStr .= $key."=".$val;
                $count++;
            }
        }
        else {
            $urlStr = $this->url."list/".$docType;
        }
        $retSet = file_get_contents($urlStr);
        $retObj = json_decode($retSet);
        return $retObj;
    }

}
