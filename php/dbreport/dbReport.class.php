<?php

require_once "appclassfiles.class.php";
require_once "dbprovider/dbprovider.inc.php";

define("SCRIPT_TAG","<script src='%src%'></script>");

class TemplateReportApp extends myAppClass {
    public $reportConfig;
    public function __construct() {
        parent::__construct();
        $this->reportConfig = null;
        $this->addControllerElement("null", "doMain");
        $this->addControllerElement("getReportJS", "getReportJS", true);
        $this->addControllerElement("blank", "getBlank");

    }

    protected function checkReportConfig() {
        if ($this->reportConfig === null) {
            throw new Exception("You must supply a report configuration");
        }
        $checkFields = array(
            "object",
            "title",
            "tableDefinition"
        );
        foreach($checkFields as $fld) {
            if (!isset($this->reportConfig[$fld])) {
                throw new Exception("You must define the $fld!");
            }
        }
    }

    public function getReportJS() {
        $jsFile = file_get_contents(__DIR__."/js/report.js");
        if (headers_sent()) {
            throw new Exception("Headers already sent!");
        }
        header("Content-Type: application/javascript");
        echo $jsFile;
    }

    protected function updateTableDefinition($repDef) {
        foreach($repDef['tableDefinition'] as $field => $def) {
            $def['field'] = $field;
            $repDef['tableDefinition'][$field] = $def;
        }
        return $repDef['tableDefinition'];
    }

    public function doMain() {
        $tpl = $this->createSmarty();
        $this->checkReportConfig();
        $tpl->assign("title", $this->reportConfig['title']);
        $tpl->assign("object", $this->reportConfig['object']);
        $tpl->assign(
            "tableDefinition",
            json_encode(
                $this->updateTableDefinition($this->reportConfig)
            )
        );
        $initCriteria = json_encode(null);
        if (isset($this->reportConfig['initialCriteria'])) {
            $initCriteria = json_encode($this->reportConfig['initialCriteria']);
        }
        $staticCriteria = json_encode(null);
        if (isset($this->reportConfig['staticCriteria'])) {
            $staticCriteria = json_encode($this->reportConfig['staticCriteria']);
        }
        $custJSFileStr = "";
        if (isset($this->reportConfig['customJSFiles'])) {
            foreach($this->reportConfig['customJSFiles'] as $jsFile) {
                $custJSFileStr .= str_replace("%src%",$jsFile,SCRIPT_TAG)."\n";
            }
        }
        $tpl->assign("additionalJS", $custJSFileStr);
        $tpl->assign("initialCriteria", $initCriteria);
        $tpl->assign('staticCriteria', $staticCriteria);
        $tpl->assign("ajaxURL", $this->reportConfig['ajaxURL']);
        $tpl->display(__DIR__."/views/report.tpl.html");
    }

    public function getBlank() {
        echo "<h3></h3>
         <script src='/globals/js/jquery/jquery.js'></script>".
        '<script>
            function buildTable(tblAr) {
                var tbl = document.createElement("table");
                tbl.setAttribute("id","newTbl");
                document.body.appendChild(tbl);
                $("#newTbl").html(tblAr);
                var tmpHdr = $(window.opener.document.getElementsByTagName("h3")[0]).html();
                $($("h3")[0]).html(tmpHdr);

            }

            $(document).ready(function() {
                window.opener.reportApp.printTableContents(window);
            });

           </script>';
    }
}
