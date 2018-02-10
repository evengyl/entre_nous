<?php 

Class product extends base_module
{

	public function __construct(&$_app)
	{		
		$_app->module_name = __CLASS__;
		parent::__construct($_app);

	 	

	 	//pour set le bread avec le nom de la categ courante car pas dans le GET
	 	if(isset($_GET["product_id"]))
	 	{
			$product_id = htmlspecialchars(intval($_GET['product_id']));

			$req_product = new stdClass();
			$req_product->table = "ma_ft_product";
			$req_product->var = "id, categ_id, img, no_fou, no_code";
			$req_product->var_translate = "name, text";
			$req_product->where = ["id" => $product_id];
			$res_product = $this->_app->sql->select($req_product);
			$res_product = $res_product[0];

			$req_product_attribut = new stdClass();
			$req_product_attribut->table = "ma_ft_product_attribut";
			$req_product_attribut->var = "id";
			$req_product_attribut->var_translate = "attribut";
			$req_product_attribut->where = ["id_product" => $product_id];
			$res_product_attribut = $this->_app->sql->select($req_product_attribut);

			//la partie attribut doit être modifiée pour les nouvelles table
			

			$req_product_caract = new stdClass();
			$req_product_caract->table = "ma_ft_product_caract";
			$req_product_caract->var = "ma_ft_product_caract.id AS id_line_caract, ma_ft_product_caract_name.id AS id_name, ma_ft_product_caract_value.id AS id_value, ma_ft_product_caract_value.value";
			$req_product_caract->var_translate = "ma_ft_product_caract_name.name";
			$req_product_caract->join = ["ma_ft_product_caract_name", "ma_ft_product_caract_value"];
			$req_product_caract->on = ["ma_ft_product_caract_name.id = ma_ft_product_caract.id_caract_name", "ma_ft_product_caract_value.id = ma_ft_product_caract.id_caract_value"];
			$req_product_caract->where = ["id_product" => $product_id];
			$res_product_caract = $this->_app->sql->select($req_product_caract);


			//part documentation
			$req_product_document = new stdClass();
			$req_product_document->table = "ma_ft_product_document";
			$req_product_document->var = "url, type, img, id";
			$req_product_document->var_translate = "name";
			$req_product_document->where = ["id_product" => $product_id];
			$res_product_document = $this->_app->sql->select($req_product_document);

			$res_product->documentation = $res_product_document;
			$res_product->attribut = $res_product_attribut;
			$res_product->caract = $res_product_caract;


			//for Nav
			$req_bread = new stdClass();
			$req_bread->table = "ma_ft_category";
			$req_bread->var = "id, name_code";
			$req_bread->where = ["id" => $res_product->categ_id];
			$res_bread = $this->_app->sql->select($req_bread);

			$_app->navigation->set_breadcrumb($res_bread[0]->name_code, "?page=categ&categ_id=".$res_bread[0]->id);

			$_app->navigation->set_breadcrumb($res_product->name, "?page=product&product_id=".$res_product->id);
	 	}

		$this->get_html_tpl =  $this->assign_var("product", $res_product)->use_template()->render_tpl();
	}
}
