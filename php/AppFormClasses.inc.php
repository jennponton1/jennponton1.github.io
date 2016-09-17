<?php

class BaseFormObj {
	protected $form;
	public function __construct($formName = '', $method = 'post', $action = '', $target = '', $attributes = null){
		$this->form = new HTML_QuickForm($formName, $method, $action, $target, $attributes);
	}
	public function addElement($parm1 = "", $parm2 = "", $parm3 = "", $parm4 = "", $parm5 = "", $parm6 = ""){
		return $this->form->addElement($parm1, $parm2, $parm3, $parm4, $parm5, $parm6);
	}
	public function addGroup($parm1 = "", $parm2 = "", $parm3 = "", $parm4 = "", $parm5 = ""){
		return $this->form->addGroup($parm1, $parm2, $parm3, $parm4, $parm5);
	}
	public function addRule($parm1 = "", $parm2 = "", $parm3 = ""){
		return $this->form->addRule($parm1, $parm2, $parm3);
	}
	public function validate(){
		return $this->form->validate();
	}
	public function setConstants($parm1 = "", $parm2 = "", $parm3 = ""){
		return $this->form->setConstants($parm1);
	}
	public function setDefaults($parm1 = "", $parm2 = "", $parm3 = ""){
		return $this->form->setDefaults($parm1);
	}
	public function display($parm = ""){
		return $this->form->display($parm);
	}
	public function freeze($elementName){
		return $this->form->freeze($elementName);
	}
	public function setAction($action){
		return $this->form->updateAttributes(array('action'=>$action));
	}

}


class TemplFormObj extends BaseFormObj {
	protected $form;

	public function __construct($formName = '', $method = 'post', $action = '', $target = '', $attributes = null){
		$this->form = new HTML_QuickForm($formName, $method, $action, $target, $attributes);
	}
	public function setAttributes($attr)
	{
		return $this->form->setAttributes($attr);
	}

	public function display($templ = "", $tpl = null){
		//$tpl = new Smarty();
		//$tpl->template_dir = './';
		//$tpl->compile_dir  = './';

		$renderer = /* & */ new HTML_QuickForm_Renderer_ArraySmarty($tpl, true);
		$this->form->accept($renderer);

		$tpl->assign('form', $renderer->toArray());
		if (defined('DOAPPDEBUG')) {
			echo "<pre>";
			print_r($renderer->toArray());
			echo "</pre>";
		}
		$tpl->display($templ);
	}

}
