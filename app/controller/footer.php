<?php 

Class footer extends base_module
{

	public function __construct(&$_app)
	{		
		$_app->module_name = __CLASS__;
		parent::__construct($_app);

		$nav_list = new stdClass();
		$nav_list->table = "ma_ft_category";
		$nav_list->var = "id, name_code, sub_categ, img, url";
		$nav_list->order = "id";
		$res_fx = $_app->sql->select($nav_list);

		$this->get_html_tpl =  $this->assign_var('nav_top', $res_fx)->use_template('footer')->render_tpl();
	}
}
