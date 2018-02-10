<?php
session_start();
$base_dir = dirname(dirname(dirname(__FILE__)));
require ($base_dir.'/app/includes/app_min_load.php');
$base_dir = dirname(dirname(dirname(__FILE__)));

$_app->parser = $parser;
$_app->base_dir = $base_dir;

if($_POST['action'] == 'edit')
{


	$req_sql = new stdClass();
	$req_sql->table = "specific_text_categ";
	$req_sql->var = "id";
	$req_sql->where = "categ_id = ".$_POST['id_categ'];
	$res_fx = $_app->sql->select($req_sql);
	
	if(!empty($res_fx))
	{
		$req_sql = new stdClass();
		$req_sql->table = "specific_text_categ";
		$req_sql->ctx = new stdClass();
		$req_sql->ctx->{$_POST["column"]} = $_POST['data'];
		$req_sql->where = "id = ".$_POST['id_text'];
		$_app->sql->update($req_sql);
	}
	else
	{
		$req_sql = new stdClass();
		$req_sql->table = "specific_text_categ";
		$req_sql->ctx = new stdClass();
		$req_sql->ctx->{$_POST["column"]} = $_POST['data'];
		$req_sql->ctx->categ_id = $_POST['id_categ'];
		$req_sql->where = "id = ".$_POST['id_text'];
		$_app->sql->insert_into($req_sql);
	}

	

	regen_categ_page($_app);
}


else if($_POST['action'] == 'edit_img')
{
	$img_name = substr(strrchr($_POST['img'], '/'), 1);


	$req_sql = new stdClass();
	$req_sql->table = "specific_text_categ";
	$req_sql->ctx = new stdClass();
	$req_sql->ctx->{$_POST["column"]} = $img_name;
	$req_sql->where = "categ_id = ".$_POST['id_categ'];
	$_app->sql->update($req_sql);

	regen_categ_page($_app);
}

else if($_POST['action'] == 'add_product')
{
	$img_name = substr(strrchr($_POST['image'], '/'), 1);


	$req_sql = new stdClass();
	$req_sql->table = $_POST['table'];
	$req_sql->ctx = new stdClass();
	$req_sql->ctx->name_fr = $_POST['name_fr'];
	$req_sql->ctx->name_en = $_POST['name_en'];
	$req_sql->ctx->name_nl = $_POST['name_nl'];
	$req_sql->ctx->img = $img_name;
	$req_sql->ctx->no_code = $_POST['code'];
	$req_sql->ctx->categ_id = $_POST['id_categ'];
	$_app->sql->insert_into($req_sql);

	regen_product_page($_app);
}

function regen_product_page(&$_app)
{

	$req_product = new stdClass();
	$req_product->table = "ma_ft_product";
	$req_product->var = "id, categ_id, img, no_fou, no_code";
	$req_product->var_translate = "name, text";
	$req_product->where = ["categ_id" => $_POST['id_categ']];
	$products = $_app->sql->select($req_product);

	ob_start();
		include $_app->base_dir.'/vues/vues_ajax/ajax_edit_product_categ.php';
		$return = ob_get_clean();
		$return = $_app->parser->parser_translate($return);
	echo ($return);
}
function regen_categ_page(&$_app)
{


	$req_bread = new stdClass();
	$req_bread->table = "ma_ft_category";
	$req_bread->var = "id, name_code, specific_text_categ.id, specific_text_categ.img, specific_text_categ.img_2";
	$req_bread->var_translate = "specific_text_categ.text, specific_text_categ.title";
	$req_bread->join = ["specific_text_categ"];
	$req_bread->on = ["specific_text_categ.categ_id = ma_ft_category.id"];
	$req_bread->where = ["id" => $_POST['id_categ']];	 
	$res_bread = $_app->sql->select($req_bread);
	$general = $res_bread[0];

	ob_start();
		include $_app->base_dir.'/vues/vues_ajax/ajax_edit_categ_text.php';
		$return = ob_get_clean();
		$return = $_app->parser->parser_translate($return);
	echo ($return);
}
?>
