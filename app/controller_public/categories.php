<?php 

Class categories extends base_module
{

	public function __construct(&$_app)
	{		
		$_app->module_name = __CLASS__;
		parent::__construct($_app);

	 	$_app->navigation->set_breadcrumb('__TRANS_categories__');

	 	//pour set le bread avec le nom de la categ courante car pas dans le GET
	 	if(isset($_GET["categ_id"]))
	 	{
 			$current_categ_id = intval($_GET["categ_id"]);

			$req_bread = new stdClass();
			$req_bread->table = "ma_ft_category";
			$req_bread->var = "id, name_code, specific_text_categ.id, specific_text_categ.img, specific_text_categ.img_2";
			$req_bread->var_translate = "specific_text_categ.text, specific_text_categ.title";
			$req_bread->join = ["specific_text_categ"];
			$req_bread->on = ["specific_text_categ.categ_id = ma_ft_category.id"];
			$req_bread->where = ["id" => $current_categ_id];	 
			$res_bread = $this->_app->sql->select($req_bread);


			$_app->navigation->set_breadcrumb($res_bread[0]->name_code, "&categ_id=".$current_categ_id);

			$req_product = new stdClass();
			$req_product->table = "ma_ft_product";
			$req_product->var = "id, categ_id, img, no_fou, no_code";
			$req_product->var_translate = "name, text";
			$req_product->where = ["categ_id" => $current_categ_id];
			$res_product = $this->_app->sql->select($req_product);

	 	}
		$this->get_html_tpl =  $this->assign_var("products", $res_product)->assign_var("general", $res_bread[0])->use_template()->render_tpl();
	}
}
