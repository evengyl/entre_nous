<?php 

Class find_us extends base_module
{

	public function __construct(&$_app)
	{		
		$_app->module_name = __CLASS__;
		parent::__construct($_app);

	 	$_app->navigation->set_breadcrumb('__TRANS_ou_nous_trouver__');

		$this->get_html_tpl =  $this->use_template('find_us')->render_tpl();
	}
}
