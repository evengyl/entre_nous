<?php 

Class documentations extends base_module
{

	public function __construct(&$_app)
	{		
		$_app->module_name = __CLASS__;
		parent::__construct($_app);

		// on ne sait jamais si dans le module j'aurais envoyer un breadcrumb no
		//pas pratique il faudrait le faire directement dans le module
		if(!is_array($_app->var_module))
		{
		 	$_app->navigation->set_breadcrumb('__TRANS_documentations__');
		}
		else
		{
			if(in_array("breadcrumb", $_app->var_module))
			 {
			 		//c'est un module secondaire
			 }
		}
			
			

		$this->get_html_tpl =  $this->use_template('documentations')->render_tpl();
	}
}
