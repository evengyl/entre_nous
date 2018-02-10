<?
Class home extends base_module
{
	public function __construct(&$_app)
	{		
		$_app->module_name = __CLASS__;
		parent::__construct($_app);

		$_app->navigation->set_breadcrumb(array("fr" => "Qu'est-ce que Weller Filtration?", "en" => "What's Weller Filtration ?", "nl" => "Wat is Weller Filtration?"));
		
		$this->get_html_tpl =  $this->use_template("home")->render_tpl();
	}
}