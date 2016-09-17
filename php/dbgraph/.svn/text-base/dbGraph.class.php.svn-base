<?php

require_once "appclassfiles.class.php";
define("SCRIPT_TAG", "<script src='%src%'></script>");

class TemplateGraphApp extends myAppClass {
    public function __construct() {
        parent::__construct();
        $this->addControllerElement("null", "doMain");
        $this->addControllerElement("getReportJS", "getReportJS", true);
        $this->addControllerElement("blank", "getBlank");
    }

    protected function checkGraphConfig() {
        if ($this->graphConfig === null) {
            throw new Exception("You must supply a gra;h configuration");
        }
        $checkFields = array(
            "object",
            "title",
            "graphDefinition"
        );
        foreach($checkFields as $fld) {
            if (!isset($this->graphConfig[$fld])) {
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

    public function doMain() {
        $tpl = $this->createSmarty();
        $this->checkGraphConfig();
        $tpl->assign("title", $this->graphConfig['title']);
        $tpl->assign("object", $this->graphConfig['object']);
        $tpl->assign(
            "dataDefinition",
            json_encode($this->graphConfig['fields'])
        );
        $tpl->assign(
            "graphDefinition",
            json_encode(
                $this->graphConfig['graphDefinition']
            )
        );
        $initCriteria = json_encode(null);
        if (isset($this->graphConfig['initialCriteria'])) {
            $initCriteria = json_encode($this->graphConfig['initialCriteria']);
        }
        $staticCriteria = json_encode(null);
        if (isset($this->graphConfig['staticCriteria'])) {
            $staticCriteria = json_encode($this->graphConfig['staticCriteria']);
        }
        $custJSFileStr = "";
        if (isset($this->graphConfig['customJSFiles'])) {
            foreach($this->graphConfig['customJSFiles'] as $jsFile) {
                $custJSFileStr .= str_replace("%src%", $jsFile, SCRIPT_TAG)."\n";
            }
        }
        $tpl->assign("additionalJS", $custJSFileStr);
        $tpl->assign("initialCriteria", $initCriteria);
        $tpl->assign('staticCriteria', $staticCriteria);
        $tpl->assign("ajaxURL", $this->graphConfig['ajaxURL']);
        $tpl->display(__DIR__."/views/report.tpl.html");
    }

}
