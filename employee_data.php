<?php

include 'htwapp.class.php';
require_once 'htframework.inc.php';

function main() {
    global $htwApp;
    $tpl = $htwApp->createSmarty();
    $empfname = 'Jennifer';
    $tpl->assign('empfname', $empfname);
    $tpl->display(dirname(__FILE__) . "employee_data.html");
}

$htwApp->addControllerElement('null', 'main');
$htwApp->dispatch();



