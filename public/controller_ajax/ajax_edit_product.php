<?php
session_start();
$base_dir = dirname(dirname(dirname(__FILE__)));
require ($base_dir.'/app/includes/app_min_load.php');
$base_dir = dirname(dirname(dirname(__FILE__)));

$_app->parser = $parser;
$_app->base_dir = $base_dir;

if($_POST['action'] == 'edit')
{	
	//part upload des update
	if(isset($_POST['table']) && isset($_POST["column"]) && isset($_POST["data"]) && isset($_POST['id_product']) && isset($_POST['id_attribut']))
	{
		$req_sql = new stdClass();
		$req_sql->table = $_POST['table'];
		$req_sql->ctx = new stdClass();
		$req_sql->ctx->{$_POST["column"]} = $_POST['data'];

		if(!empty($_POST['id_attribut']))
			$req_sql->where = "id = ".$_POST['id_attribut'];
		else
			$req_sql->where = "id = ".$_POST['id_product'];
		
		$_app->sql->update($req_sql);

	}


	regen_product($_app);
}
elseif($_POST['action'] == "get_all_caract_name")
{
	$req_product = new stdClass();
	$req_product->table = "ma_ft_product_caract_name";
	$req_product->var = "id";
	$req_product->var_translate = "name";
	$name_caract = $_app->sql->select($req_product);

	ob_start();?>
		<form id="form_add_caract">
			<select class="form-control">
				<option value="0">Select Name Caract.<?
				$input_array = array();

				foreach($name_caract as $row_caract)
				{
					echo "<option value='".$row_caract->id."'>-&nbsp;".$row_caract->name;
				}?>
				<option value="other">New Name
			</select>

			<label style="display:none;">
				<input class="form-control" data-name="value_new_caract_fr" placeholder="New Name Caract. FR"></input>
				<input class="form-control" data-name="value_new_caract_en" placeholder="New Name Caract. EN"></input>
				<input class="form-control" data-name="value_new_caract_nl" placeholder="New Name Caract. NL"></input>
			</label>

			<input class="form-control" placeholder="Value Caract." data-name="value_caract" name="value_caract" type="text">
			<a class="col-xs-12 btn btn-primary" style="padding-left:10px; padding-right:10px;" id="save_caract" title="Save"><span class="fas fa-save">&nbsp;Save New feature</span></a>
		</form><?
	$return = ob_get_clean();
	echo $return;	
}

else if($_POST['action'] == "add_caract")
{
 	//Mtn que j'ai toute les vars il faut faire le controller
	// controller que on a un int pour le select si y a un name qu'est sleect
    // enregistrer le new value et le lie avec l'id de la name, puis regen page
    // si c'est un new, enregistrer le name et la value et son id

	if(isset($_POST['id_caract_name']))
	{
			//on insert la new value
			$req_sql = new stdClass();
			$req_sql->table = 'ma_ft_product_caract_value';
			$req_sql->ctx = new stdClass();
			$req_sql->ctx->value = $_POST['caract_value'];
			$_app->sql->insert_into($req_sql);
			unset($req_sql);

			//on va rechercher son id pour pour mettre dans la table des caract
			$req_sql = new stdClass();
			$req_sql->table = "ma_ft_product_caract_value";
			$req_sql->var = "id";
			$req_sql->order = "id DESC";
			$res_sql = $_app->sql->select($req_sql);
			$new_id_value = $res_sql[0]->id;
			unset($req_sql);


		if(is_numeric($_POST['id_caract_name']))
		{
			//on insert dans les caract
			$req_sql = new stdClass();
			$req_sql->table = 'ma_ft_product_caract';
			$req_sql->ctx = new stdClass();
			$req_sql->ctx->id_product = $_POST['id_product'];
			$req_sql->ctx->id_caract_name = $_POST['id_caract_name'];
			$req_sql->ctx->id_caract_value = $new_id_value;
			$_app->sql->insert_into($req_sql);
			unset($req_sql);
		}
		else
		{
			//on insert la new name
			$req_sql = new stdClass();
			$req_sql->table = 'ma_ft_product_caract_name';
			$req_sql->ctx = new stdClass();
			$req_sql->ctx->name_fr = $_POST['new_caract_name_fr'];
			$req_sql->ctx->name_en = $_POST['new_caract_name_en'];
			$req_sql->ctx->name_nl = $_POST['new_caract_name_nl'];
			$_app->sql->insert_into($req_sql);
			unset($req_sql);


			//on va rechercher son id pour pour mettre dans la table des caract
			$req_sql = new stdClass();
			$req_sql->table = "ma_ft_product_caract_name";
			$req_sql->var = "id";
			$req_sql->order = "id DESC";
			$res_sql = $_app->sql->select($req_sql);
			$new_id_name = $res_sql[0]->id;
			unset($req_sql);



			//on insert dans les caract
			$req_sql = new stdClass();
			$req_sql->table = 'ma_ft_product_caract';
			$req_sql->ctx = new stdClass();
			$req_sql->ctx->id_product = $_POST['id_product'];
			$req_sql->ctx->id_caract_name = $new_id_name;
			$req_sql->ctx->id_caract_value = $new_id_value;
			$_app->sql->insert_into($req_sql);
			unset($req_sql);
		}	


		regen_product($_app);
	}
}

else if($_POST['action'] == "add_attribut")
{
	if(isset($_POST['id_product']))
	{
			//on insert la new value
			$req_sql = new stdClass();
			$req_sql->table = 'ma_ft_product_attribut';
			$req_sql->ctx = new stdClass();
			$req_sql->ctx->attribut_fr = $_POST['new_attribut_name_fr'];
			$req_sql->ctx->attribut_en = $_POST['new_attribut_name_en'];
			$req_sql->ctx->attribut_nl = $_POST['new_attribut_name_nl'];
			$req_sql->ctx->id_product = $_POST['id_product'];
			$_app->sql->insert_into($req_sql);
			unset($req_sql);



		regen_product($_app);
	}
}

else if($_POST['action'] == "trash")
{
 	//Mtn que j'ai toute les vars il faut faire le controller
	// controller que on a un int pour le select si y a un name qu'est sleect
    // enregistrer le new value et le lie avec l'id de la name, puis regen page
    // si c'est un new, enregistrer le name et la value et son id

	if(isset($_POST['id_product']))
	{
		//ici on va avoir deux cas différent
		//si c'est title , name ou quoi on s'en fou, c'est vite delete
		//si c'est une caract, il faut la virer et de la de base value ou name ET de la table des liaison, mettre 0 pour afficher N/C
		if($_POST['table'] == 'ma_ft_product_attribut')
		{
			$req_sql = new stdClass();
			$req_sql->table = "ma_ft_product_attribut";
			$req_sql->where = "id = ".$_POST['id_attribut'];
			$_app->sql->delete($req_sql);
		}
		else if($_POST['table'] == 'ma_ft_product_caract_value')
		{
			//on delete la value uniquement et on vire la ligne de la table caract 
			$req_sql = new stdClass();
			$req_sql->table = 'ma_ft_product_caract_value';
			$req_sql->where = "id = ".$_POST['id_attribut'];
			$_app->sql->delete($req_sql);


			//on met a jour la table caract
			$req_sql = new stdClass();
			$req_sql->table = 'ma_ft_product_caract';
			$req_sql->where = "id = ".$_POST['id_line_caract'];
			$_app->sql->delete($req_sql);

		} //pas desysteme de trash pour le name, on a pas besoin des les delete

		regen_product($_app);
	}
}

else if($_POST['action'] == "add_document")
{
	if(isset($_POST['id_product']))
	{
			//on insert la new value
			$req_sql = new stdClass();
			$req_sql->table = 'ma_ft_product_document';
			$req_sql->ctx = new stdClass();
			$req_sql->ctx->name_fr = $_POST['new_name_doc_fr'];
			$req_sql->ctx->name_en = $_POST['new_name_doc_en'];
			$req_sql->ctx->name_nl = $_POST['new_name_doc_nl'];
			$req_sql->ctx->url = $_POST['new_doc_url'];
			$req_sql->ctx->img = $_POST['new_doc_img'];
			$req_sql->ctx->id_product = $_POST['id_product'];
			$_app->sql->insert_into($req_sql);
			unset($req_sql);


		regen_product($_app);
	}
}

else if($_POST["action"] == "delete_document")
{
	//on met a jour la table caract
	$req_sql = new stdClass();
	$req_sql->table = 'ma_ft_product_document';
	$req_sql->where = "id = ".$_POST['id_document'];
	$_app->sql->delete($req_sql);

	regen_product($_app);
}



function regen_product(&$_app)
{
		//on regen la page product
		$req_product = new stdClass();
		$req_product->table = "ma_ft_product";
		$req_product->var = "id, categ_id, img, no_fou, no_code";
		$req_product->var_translate = "name, text";
		$req_product->where = ["id" => $_POST['id_product']];
		$product = $_app->sql->select($req_product);
		$product = $product[0];

		$req_product_attribut = new stdClass();
		$req_product_attribut->table = "ma_ft_product_attribut";
		$req_product_attribut->var = "id";
		$req_product_attribut->var_translate = "attribut";
		$req_product_attribut->where = ["id_product" => $_POST['id_product']];
		$product->attribut = $_app->sql->select($req_product_attribut);

		$req_product_caract = new stdClass();
		$req_product_caract->table = "ma_ft_product_caract";
		$req_product_caract->var = "ma_ft_product_caract.id AS id_line_caract, ma_ft_product_caract_name.id AS id_name, ma_ft_product_caract_value.id AS id_value, ma_ft_product_caract_value.value";
		$req_product_caract->var_translate = "ma_ft_product_caract_name.name";
		$req_product_caract->join = ["ma_ft_product_caract_name", "ma_ft_product_caract_value"];
		$req_product_caract->on = ["ma_ft_product_caract_name.id = ma_ft_product_caract.id_caract_name", "ma_ft_product_caract_value.id = ma_ft_product_caract.id_caract_value"];
		$req_product_caract->where = ["id_product" => $_POST['id_product']];
		$product->caract = $_app->sql->select($req_product_caract);


		//part documentation
			$req_product_document = new stdClass();
			$req_product_document->table = "ma_ft_product_document";
			$req_product_document->var = "url, type, img, id";
			$req_product_document->var_translate = "name";
			$req_product_document->where = ["id_product" => $_POST['id_product']];
			$product->documentation = $_app->sql->select($req_product_document);



		ob_start();
			include $_app->base_dir.'/vues/vues_ajax/ajax_edit_product.php';
			$return = ob_get_clean();
			$return = $_app->parser->parser_translate($return);
		echo ($return);
}
?>
