<?php

/**
 * htwApp_class  Application Object
 *
 * @package htwAppFramework
 * @subpackage App
 *
 * Application Object intended to handle output duties for the Hoover Intranet
 * Functions not included in any class:
 * - makeCrossTab
 * Classes defined
 * - htwApp_class: the Application Object Class
 * - htwAppController: A controller class for forms and request based dispatching
 *
 */
@session_name("HTWP_Intranet");
@session_start();
/*
 * Includes
 */
include_once dirname(__FILE__) . "/smarty/smarty.class.php";
include_once "HTML/QuickForm.php";
include_once "HTML/QuickForm/Renderer/ArraySmarty.php";
require_once "htwAppController.class.php";
require_once "htwAppTableObj.class.php";
require_once "AppFormClasses.inc.php";

/**
 * Function makeCrossTab - create a Pivot table from a tabletemplate style array
 *
 * This function takes an array that would be suitable to be passed to the tabletemplate
 * class in order to build a scrolling table and makes a crosstab, or pivot table, from it
 * it returns a multi-dimensional array as follows:
 * - 'data' is the new pivot table array
 * - 'hdrs' is an array of the columns in the new array
 * Parameters are:
 * - $det an associative array
 * - $colKey - the field to use as columns in the new pivot table
 * - $accKey - the field to accumulate in the body of the table
 */
function makeCrossTab($det, $colKey, $accKey) {

    // Pass 1 gets all of the distinct values for the colkey
    $newCols = array();
    foreach ($det as $row => $line) {
        if (!in_array($line [$colKey], $newCols)) {
            $newCols [] = $line [$colKey];
        }
    } // Gathering new Columns
    sort($newCols);
    $oldCols = array();
    $newDet  = array();
    $curRow  = 0;
    foreach ($det as $row => $line) {
        $lineKey = "";
        $tmpDet  = array();
        foreach ($line as $fld => $val) {
            switch ($fld) {
                case $colKey:
                    $colVal = $val;
                    break;
                case $accKey:
                    $accVal = $val;
                    break;
                default:
                    $tmpDet [$fld] = $val;
                    if (!in_array($fld, $oldCols)) {
                        $oldCols []    = $fld;
                    }
                    $lineKey .= $val;
            } // Switch
        } // Columns
        foreach ($tmpDet as $fld => $xval) {
            $newDet [$lineKey] [$fld] = $xval;
        }
        // $newDet[$lineKey] = $tmpDet;
        foreach ($newCols as $ndx => $colName) {
            if ($colName == $colVal) {
                @$newDet [$lineKey] [$colName] += $accVal;
            }
            else {
                @$newDet [$lineKey] [$colName] += "0";
            }
        }
        $curRow ++;
    } // rows
    $retCols = array();
    $retCols = $oldCols;
    foreach ($newCols as $ndx => $fld) {
        $retCols [] = $fld;
    }
    sort($newDet);
    return array(
        'data' => $newDet,
        'hdrs' => $retCols
    );
}

// Make a crossTab

/**
 * htwApp_class - the Hoover Application Object Class
 *
 * htwApp_class will be tasked with controller and view functions
 * data elements:
 * - appConfig : an array containing configuration settings
 * - tableTitle : a string that will be used as a title for tables
 * - appController: a default htwAppController object to use as a scripts controller
 *
 * methods:
 * - htwApp_class constructor. no parameters
 * - dieOnError : intended to be a uniform error message function
 * - setTitle : method to set the $tabletitle field
 * - makeTable : uses tableTemplate to build a scrolling table
 * - addControllerElement : add an element to the app controller
 */
class htwAppClass {
    /**
     * @+
     *
     * @access private
     *
     */

    /**
     * Allow access to the Pear HTML_Quick_form object wrapped by this class
     */
    public $form;

    /**
     *
     * @var array with configuuration data
     */
    protected $appConfig;

    /**
     * This is the application's controller.
     * The default action var will be do
     *
     * @var htwAppController
     */
    protected $appController;

    /**
     *
     * @var String Title used for Tables
     */
    protected $tableTitle;

    /**
     *
     * @var String Title used for Pages
     */
    protected $pageTitle;

    /**
     *
     * @var String User's Name, if logged in
     */
    public $sUserNm;
    protected $ajaxControlElements;

    /**
     *
     * @var String User's ID if logged in
     */
    public $vUser;

    /**
     *
     * @var String current site for user;
     */
    public $sSite;

    /**
     *
     * @var String User's ID if logged in
     */
    public $sEmpId;

    /**
     *
     * @var String Groups user is a member of if logged in
     */
    public $group_list;
    // handles configuration entries (like ini files) for each application
    protected $appConfigs;

    /**
     *
     * @var array of input Ids of triggering html elements for one div,
     *      Div Id to update,
     *      URL including 'do' action parameter for Ajax calls
     *      See addAjaxDiv(...)
     */
    private $updatables           = array();

    /**
     *
     * @var array of input Ids of all triggering html elements on a page.
     */
    private $consolidatedTriggers = array();
    private $usesAjax             = false;
    private $table;

    /**
     *
     * @var $clickables - array keyed by html table column headers
     *      Each column header index points to an array of two elements:
     *      1) bool indicating wether that column can be clicked to re-submit (for
     *      example to sort)
     *      2) An 'action value' to give the hidden 'do' variable (not the php
     *      function name) or null if above bool is false
     */
    private $clickables           = array();
    private $alignments           = array();

    /**
     * smartyAssignments - save up smarty assignments for display at dispatch
     */
    private $smartyAssignments = array();

    /**
     * object Constructor
     * sets Debug according to the configuration settings and
     * creates an instance of the controller
     */
    public function __construct() {
        $this->appConfig = new htwConfig();
        if ($this->appConfig->debug) {
            error_reporting(E_ALL);
        }
        else {
            error_reporting(E_NONE);
        }
        $this->appController = new htwAppController("do");
        set_exception_handler(array($this, 'handleExceptions'));
        // Do we check the session?
        $this->appConfigs    = null;
        if (!defined('NOLOGIN')) {
            // Setup and check our session
            $this->startSession();
            //$logged_in = false;
            // echo $this->appConfig->ldapServer;
            // First - are we asking to login?
            if ($this->getRequestValue('do') == 'login') {
                $this->showLoginForm();
                exit();
            }
            // TODO: Next - are we submitting a login?
            if ($this->getRequestValue('do') == 'dologin') {
                $this->doLogin();
            }
            // TODO: Last - have we logged in?
            if (!$this->checkSession()) {
                $msgString = "You are not logged in!!<br>\n
					Please try to
					<a href=" . $this->appConfig->home . ">Login</a>";
                $this->dieOnError($msgString);
            }
            // TODO: Even More Last - Letting the user logout
            if ($this->getRequestValue('do') == 'logout') {
                $this->doLogout();
                exit();
            }
            if ($this->getRequestValue('do') == 'setsite') {
                $this->setCurSite($this->getRequestValue('siteid'));
            }
        }
        session_write_close();
    }

// End of constructor method

    public function showLoginForm() {
        $this->startBasicForm();
        $this->addFormElement('text', 'user', 'User Name');
        $this->addFormElement('hidden', 'do', '');
        $this->addFormElement('password', 'pass', 'Password');
        $this->addFormElement('submit', 'sublogin', 'Login');
        $this->setFormConstants(array(
            "do" => "dologin"
        ));
        $this->showForm();
    }

    public function doLogout() {
        if (session_id() == "") {
            // Start the session
            $this->startSession();
        }
        session_destroy();
        echo "Logged out!!!.  Please go <a href=\"" . $this->appConfig->home . "\">Home</a> to login again";
    }

    /**
     * Checks for membership in the given group
     */
    public function isMemberOf($group) {
        $groupAr = split(",", $_SESSION ["groups"]);
        $group   = "'$group'";
        $ret     = in_array($group, $groupAr);
        /*
         * $ret = true; if (strstr($group,$_SESSION["groups"]) === false ) { $ret = false; }
         */
        return $ret;
    }

    public function doLogin() {
        // TODO: Add Comments
        if (session_id() == "") {
            // Start the session
            $this->startSession();
        }
        $user = @$_POST ["user"];
        if (@$user == "") {
            unset($user);
        }
        $pass = @$_POST ["pass"];
        if (@$pass == "") {
            unset($pass);
        }
        if (!isset($user) || !isset($pass)) {
            $this->dieOnError("You did not enter a required field!!");
        }
        $md5pass = $pass;
        $result  = $this->confirmUser($user, $md5pass);

        if ($result === false) {
            $this->dieOnError("Invalid Login!! Please try again.");
        }
    }

    public function confirmUser($username, $password) {
        /* Verify that user is in database */
        // must be a valid LDAP server!
        $ds = ldap_connect($this->appConfig->ldapServer) or $this->dieOnError("LDAP did not respond!<BR>");
        $dn = "uid=$username," . $this->appConfig->ldapBase . "";
        ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
        $res  = ldap_bind($ds, $dn, $password);

        if ($res) {
            $sr                    = ldap_search($ds, $this->appConfig->ldapBase, "uid=$username");
            $info                  = ldap_get_entries($ds, $sr);
            // echo $info;
            $_SESSION ['username'] = $username;
            $_SESSION ['fullname'] = $info [0] ["cn"] [0];
            $_SESSION ['siteid']   = $info [0] ["ou"] [0];
            $_SESSION ['rsite']    = $_SESSION ['siteid'];

            // Now get groups
            $group_res  = ldap_search(
                $ds,
                $this->appConfig->ldapBase,
                "member=uid=$username,
				" . $this->appConfig->ldapBase
            );
            $group_list = ldap_get_entries($ds, $group_res);
            $arGroups   = array();
            $arCount    = 0;
            for ($i = 0; $i < $group_list ["count"]; $i ++) {
                $arCount ++;
                $arGroups [$arCount - 1] = $group_list [$i] ["cn"] [0];
            }
            $this->group_list = $arGroups;
            $whereClause      = '';
            foreach ($this->group_list as $groupName) {
                if ($whereClause != "") {
                    $whereClause .= ",";
                }
                $whereClause .= "'$groupName'";
            } // Foreach

            $_SESSION ["groups"] = $whereClause;

            ldap_close($ds);
            session_write_close();
            return true;
        } else {
            ldap_close($ds);
            return false;
        }
    }

// end of confirmUser

    public function startSession() {
        // global $_SESSION;
        @session_name("HTWP_Intranet");
        @session_start();
    }

    public function checkSession() {
        // Assumes that the session has already been started
        if (session_id() == "") {
            // Start the session
            $this->startSession();
        }
        $this->sUserNm = @$_SESSION ["fullname"];
        $this->vUser   = @$_SESSION ["username"];
        $this->sSite   = @$_SESSION ["rsite"];
        $this->sEmpId  = @$_SESSION ["emplyid"];
        if (isset($this->sUserNm) && isset($this->vUser) && isset($this->sSite)) {
            return true;
        }
        else {
            return false;
        }
        ;
    }

    public function createSmarty() {
        $tpl               = new Smarty();
        $tpl->template_dir = $this->appConfig->smartyTemplDir;
        $tpl->compile_dir  = $this->appConfig->smartyCompileDir;
        return $tpl;
    }

    public function handleExceptions($exception) {
    	$msg = "";
    	if (get_class($exception) == "HTException") {
    		$msg = $exception->toHtmlDiv(true, 'color:red');
    	}
    	$displayedMessage = "Caught an exception: <br>".
    			$msg.
    			$exception->getMessage().
    			"<br>StackTrace:<br><pre>".
    			$exception->getTraceAsString().
    			"</pre>";
    	$this->dieOnError($displayedMessage);
    }



    /**
     * parameter:
     * - $message - message to display on death
     */
    public function dieOnError($message) {
        $tpl = $this->createSmarty();
        $tpl->assign('message', $message);
        $tpl->display('errorTpl.html');
        die('');
    }

    public function getRequestValue($var) {
        if (isset($_REQUEST [$var])) {
            return $_REQUEST [$var];
        }
        else {
            return null;
        }
    }

    public function getCurSite() {
        return $this->sSite;
    }

    public function setCurSite($site) {
        $this->sSite        = $site;
        $_SESSION ['rsite'] = $site;
    }

    /**
     * parameter
     * - $str String to set as title
     */
    public function setTitle($str) {
        $this->tableTitle = $str;
    }

    public function setPageTitle($str) {
        $this->pageTitle = $str;
    }

    public function addDiv($id = "", $content = "") {
        if ($id != "") {
            $id = "id=$id";
        }
        echo "<div $id>$content</div>";
    }

    /**
     * htwApp::addAjaxDiv(...)
     * parameters:
     * 1) The Id of the <div> to be updated by the AJAX call
     * 2) The htwApp Controller Element name.
     * The function associated by addControllerElement(...) will be called
     * via AJAX
     * 3) Id(s) of inputs that will trigger the AJAX call when their contents change
     */
    public function addAjaxDiv($divId, $ctlrAction, $triggerElements) {
        $this->usesAjax = true;
        if (is_array($triggerElements)) {
            foreach ($triggerElements as $ele) {
                if (array_search($ele, $this->consolidatedTriggers) === false) {
                    $this->consolidatedTriggers [] = $ele;
                }
            }
            $this->updatables []           = array(
                "$divId",
                $ctlrAction,
                $_SERVER ['PHP_SELF'],
                $triggerElements
            );
        } else {
            if (array_search($triggerElements, $this->consolidatedTriggers) === false) {
                $this->consolidatedTriggers [] = $triggerElements;
            }
            $this->updatables []           = array(
                "$divId",
                $ctlrAction,
                $_SERVER ['PHP_SELF'],
                array(
                    $triggerElements
                )
            );
        }
    }

    public function addControllerElement($actionVal, $functionName, $isAjax = false) {
        if ($isAjax) {
            $this->ajaxControlElements [$actionVal] = true;
        }
        $this->appController->dispatchArray [$actionVal] = $functionName;
    }

    public function addControllerElements($anArray) {
        if (is_array($anArray)) {
            $this->appController->dispatchArray = $anArray;
        }
        else {
            $this->dieOnError('You must pass an array to this function');
        }
    }

    public function assign($name, $val) {
        $this->smartyAssignments [$name] = $val;
    }

    public function normalDispatch() {
        $isCli = (strtolower(php_sapi_name()) == "cli");
        if ($isCli) {
            $this->appController->action = "cli";
            // die("CANT HANDLE THIS!!!");
        }
        ob_start();
        $this->appController->dispatch();
        $content = ob_get_contents();
        ob_end_clean();
        if ($isCli) {
            // echo $content;
            return;
        }
        $doVal = $this->getRequestValue("do");
        if ($doVal == "") {
            $doVal = "null";
        }
        if (@$this->ajaxControlElements [$doVal]) {
            echo $content;
            return;
        }
        $headContent = '';
        if ($this->usesAjax) {
            $jsTpl                  = $this->createSmarty();
            $jsTpl->left_delimiter  = '<!--{';
            $jsTpl->right_delimiter = '}-->';
            $jsTpl->assign('updatables', $this->updatables);
            $jsTpl->assign('consolidatedTriggers', $this->consolidatedTriggers);
            $headContent            = $jsTpl->fetch('standard.js.html');
        }
        $tpl       = $this->createSmarty();
        if (isset($this->pageTitle)) {
            $tpl->assign('title', $this->pageTitle);
        }
        else {
            $tpl->assign('title', '');
        }
        $tpl->assign('headContent', $headContent);
        $tpl->assign('content', $content);
        $closeLink = "<a href=\"javascript:window.close()\">
	  		<span style=\"color:yellow; font-weight: bold;\" >Close</span>
	  		</a>";
        $tpl->assign('closelink', $closeLink);
        if (isset($this->sUserNm)) {
            $tpl->assign('username', "Hello, " . $this->sUserNm);
        }
        else {
            $tpl->assign('username', '');
        }
        $tpl->display('standard.html');
    }

    public function dispatch() {
        $this->normalDispatch();
    }

    public function dashboardDispatch() {
        $isCli = (strtolower(php_sapi_name()) == "cli");
        if ($isCli) {
            $this->dieOnError("DashBoard applications cannot be CLI based!!!");
            // die("CANT HANDLE THIS!!!");
        }
        ob_start();
        $this->appController->dispatch();
        $content = ob_get_contents();
        ob_end_clean();
        if ($isCli) {
            // echo $content;
            return;
        }
        $tpl       = $this->createSmarty();
        if (isset($this->pageTitle)) {
            $tpl->assign('title', $this->pageTitle);
        }
        else {
            $tpl->assign('title', '');
        }
        $tpl->assign('content', $content);
        $closeLink = "<a href=\"?do=dologout\"><span style=\"color:yellow; font-weight: bold;\" >Logout</span></a>";
        $tpl->assign('closelink', $closeLink);
        if (isset($this->sUserNm)) {
            $tpl->assign('username', "Hello, " . $this->sUserNm);
        }
        else {
            $tpl->assign('username', '');
        }
        $tpl->display('standard.html');
    }

    public function startTable() {
        $this->table = new TableObj();
    }

    public function addTableColumn($hdrName, $colWidth, $alignment = "", $clickable = false, $clickAction = '') {
        $this->clickables [] = array(
            $clickable,
            $clickAction
        );
        $this->alignments [] = $alignment;
        $this->table->addColumn($hdrName, $colWidth, $alignment);
    }

    public function addTableDetail($det) {
        $this->table->addDetail($det);
    }

    public function setTableHeight($in_height) {
        $this->table->setHeight($in_height);
    }

    public function setTableTitle($title) {
        $this->tableTitle = $title;
    }

    public function showTable($in_height = null) {
        $this->makeTable(
            $this->table->getHdrs(),
            $this->table->getWidths(),
            (($in_height === null) ? $this->table->getHeight() : $in_height),
            $this->table->getDetail()
        );
    }

    /**
     * TableTemplate Class getTable
     *
     * This function uses a new version of the tabletemplate class that will accept
     * an associative array
     *
     * parameters:
     * - $headers : array of table headers
     * - $widths : array of table column widths
     * - $height : integer setting height of table in pixels
     * - $detail : the data to be output
     */
    public function makeTable($headers, $widths, $height, $detail, $echo = true) {
        require_once ("libraries/newtabletemplate.class.php");
        // require_once("libraries/tabletemplate.class");
        $table = new TableTemplate();
        echo "<h3>" . $this->tableTitle . "</h3>";
        foreach ($this->alignments as $ndx => $col) {
            switch ($col) {
                case 'right':
                    $table->setColumnAttribute($ndx + 1, 'align', 'right');
                    break;
                case 'left':
                    $table->setColumnAttribute($ndx + 1, 'align', 'left');
                    break;
                case 'center':
                    $table->setColumnAttribute($ndx + 1, 'align', 'center');
                    break;
                default:
            }
        }
        foreach ($this->clickables as $ndx => $col) {
            $colIsClickable = $col [0];
            $clickDo        = $col [1];
            if ($colIsClickable === true) {
                $table->setHeaderAttribute(
                    $ndx + 1,
                    'onclick',
                    "javascript:onClickHeader(\"" . $headers [$ndx] . "\", \"" . $clickDo . "\");"
                );
                $table->setHeaderAttribute(
                    $ndx + 1,
                    'style',
                    'text-decoration:underline; cursor: pointer;'
                );
            }
        }
        if ($echo) {
            echo $table->getTable($widths, $height, $headers, $detail);
        }
        else {
            return $table->getTable($widths, $height, $headers, $detail);
        }
    }

    public function startTemplForm($formName = '', $method = 'post', $action = '', $target = '', $attributes = null) {
        $this->form = new TemplFormObj($formName, $method, $action, $target, $attributes);
        $this->addFormElement('hidden', 'headerClicked', '', array(
            'id' => 'headerClicked'
        ));
        return $this->form;
    }

    public function startBasicForm($formName = '', $method = 'post', $action = '', $target = '', $attributes = null) {
        $this->form = new BaseFormObj($formName, $method, $action, $target, $attributes);
        $this->addFormElement('hidden', 'headerClicked', '', array(
            'id' => 'headerClicked'
        ));
        return $this->form;
    }

    /**
     * Addes an <INPUT> element to the form
     *
     * parm1 - input type: button, checkbox, hidden, text
     * parm2 - name or id of the element
     * parm3 - value
     * parm4 - depends on parm1
     * if parm1 = text, parm4 can be set to readonly
     * if parm1 = select
     */
    // function addFormElement($parm1="",$parm2="",$parm3="",$parm4="",$parm5=""){
    // if($parm1=='htTable') {
    // $tbl = $this->makeTable($this->table->getHdrs(),
    // $this->table->getWidths(),
    // $this->table->getHeight(),
    // $this->table->getDetail(), false);
    // $ret = $this->form->addElement('static', 'htTable', $tbl.'<br>');
    // }
    // else
    // $ret = $this->form->addElement($parm1,$parm2,$parm3,$parm4,$parm5);
    // return $ret;
    // }
    public function addFormElement($parm1 = "", $parm2 = "", $parm3 = "", $parm4 = "", $parm5 = "", $parm6 = "") {
        switch ($parm1) {
            case 'htTable':
                $tbl              = $this->makeTable(
                    $this->table->getHdrs(),
                    $this->table->getWidths(),
                    $this->table->getHeight(),
                    $this->table->getDetail(),
                    false
                );
                $ret              = $this->form->addElement('static', 'htTable', $tbl . '<br>');
                break;
            case 'htTable2':
                $this->tableTitle = "";
                $tbl              = $this->makeTable(
                    $this->table->getHdrs(),
                    $this->table->getWidths(),
                    $this->table->getHeight(),
                    $this->table->getDetail(),
                    false
                );
                $ret              = $this->form->addElement('static', 'htTable2', $tbl . '<br>');
                break;
            case 'htTable3':
                $this->tableTitle = "";
                $tbl              = $this->makeTable(
                    $this->table->getHdrs(),
                    $this->table->getWidths(),
                    $this->table->getHeight(),
                    $this->table->getDetail(),
                    false
                );
                $ret              = $this->form->addElement('static', 'htTable3', $tbl . '<br>');
                break;
            case 'htTable4':
                $this->tableTitle = "";
                $tbl              = $this->makeTable(
                    $this->table->getHdrs(),
                    $this->table->getWidths(),
                    $this->table->getHeight(),
                    $this->table->getDetail(),
                    false
                );
                $ret              = $this->form->addElement('static', 'htTable4', $tbl . '<br>');
                break;
            default:
                $ret              = $this->form->addElement($parm1, $parm2, $parm3, $parm4, $parm5, $parm6);
                break;
        }
        return $ret;
    }

    public function addFormControllerAction($action = 'null') {
        $ret = & $this->form->addElement("hidden", "do", "asdf", array(
                'id' => 'do'
            ));
        $this->setFormConstants(array(
            "do" => $action
        ));
        return $ret;
    }

    public function showForm($templ = "") {
        if (get_class($this->form) == "TemplFormObj") {
            $tpl = $this->createSmarty();
            foreach ($this->smartyAssignments as $name => $val) {
                $tpl->assign($name, $val);
            }
            return $this->form->display($templ, $tpl);
        }
        else {
            return $this->form->display();
        }
    }

    public function showStartOver() {
        $this->startBasicForm();
        $this->addFormElement('link', "", "", $_SERVER ["PHP_SELF"], "Start Over");
        return $this->showForm();
    }

    public function freezeFormElement($elementName) {
        return $this->form->freeze($elementName);
    }

    /**
     * Sets the values to the elements on the form.
     *
     * parm1 - array of elements with values set to value of element.
     * array('siteid'=>$siteid, 'invtid'=>$invtid);
     *
     * parm2 - not looked into
     * parm3 - not looked into
     */
    public function setFormConstants($parm1 = "", $parm2 = "", $parm3 = "") {
        $this->form->setConstants($parm1, $parm2, $parm3);
    }

    public function setFormDefaults($parm1 = "", $parm2 = "", $parm3 = "") {
        $this->form->setDefaults($parm1, $parm2, $parm3);
    }

    public function getConfig($appKey = "", $configKey = "") {
        require_once ("appconfigsmodels.php");
        if ($this->appConfigs === null) {
            $this->appConfigs = new AppConfigClassModel();
        }
        return $this->appConfigs->getConfig($appKey, $configKey);
    }

    public function setConfig($appKey = "", $configKey = "", $values = null) {
        require_once ("appconfigsmodels.php");
        if ($this->appConfigs === null) {
            $this->appConfigs = new AppConfigClassModel();
        }
        return $this->appConfigs->setConfig($appKey, $configKey, $values);
    }

    public function registerApp($appKey = "", $path = "", $date = "", $user = "") {
        require_once ("appconfigsmodels.php");
        if ($this->appConfigs === null) {
            $this->appConfigs = new AppConfigClassModel();
        }
        return $this->appConfigs->registerApp($appKey, $path, $date, $user);
    }

}

/**
 * include the configuration settings
 */
include_once ("appconfig.inc.php");
/**
 * automatically create an instance of the application for use in the including script
 */
if (!defined("APP_CLASS_DESCENDANT")) {
    $htwApp = new htwAppClass();
}

// Start outputting header pages
if (!isset($_page_title)) {
    $_page_title = "Undefined Page by Hoover Treated Wood Products";
}
