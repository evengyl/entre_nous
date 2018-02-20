<?php
session_start();
$base_dir = dirname(dirname(dirname(__FILE__)));
require ($base_dir.'/app/includes/app_min_load.php');
$base_dir = dirname(dirname(dirname(__FILE__)));

$_app->parser = $parser;
$_app->base_dir = $base_dir;



if($_POST["action"] == "get_form_for_change_trans_ajax")
{
	//transform le post var en string connu de la bsd translate
	$var_string = $_POST["var"]."_fr, ".$_POST["var"]."_en, ".$_POST["var"]."_nl";
	//on va aller chercher les 3 value du name attribut ou autre pour les 3 tranduction, retour label + input prérempli
	$req_sql = new stdClass();
	$req_sql->table = $_POST['table'];
	$req_sql->where = ['id'=>$_POST['id']];
	$req_sql->var = $var_string;
	$res_sql = $_app->sql->select($req_sql);

	ob_start();?>
		<div class="block_edit_trans">
			<div class="input-group">
				<div class="input-group-addon">FR</div>
				<input class="form-control" data-name="<?= $_POST["var"]."_fr" ?>" data-spec="fr" placeholder="<?= $res_sql[0]->{$_POST["var"]."_fr"} ?>">
			</div>

			<div class="input-group">
				<div class="input-group-addon">EN</div>
				<input class="form-control" data-name="<?= $_POST["var"]."_en" ?>" data-spec="en" placeholder="<?= $res_sql[0]->{$_POST["var"]."_en"} ?>">
			</div>

			<div class="input-group">
				<div class="input-group-addon">NL</div>
				<input class="form-control" data-name="<?= $_POST["var"]."_nl" ?>" data-spec="nl" placeholder="<?= $res_sql[0]->{$_POST["var"]."_nl"} ?>">
			</div>
			<a class="col-xs-12 btn btn-primary" style="padding-left:10px; padding-right:10px;" data-action="save_trans_modified"  data-table="<?= $_POST['table'] ?>" data-id="<?= $_POST['id'] ?>" title="Save"><span class="fas fa-save">&nbsp;Save</span></a>
			<a class="col-xs-12 btn btn-danger" style="padding-left:10px; margin-top:5px; padding-right:10px;" data-action="remove_form_trans" title="Remove Form"><span class="fas fa-window-close">&nbsp;Close</span></a>
		</div><?
	$return = ob_get_clean();
	echo $return;	

}

else if($_POST["action"] == "save_modified_trans")
{
	//verif + attribution
	$change = [];
	$var_array = [];
	

	//on modifie dans la bsd
	$req_sql = new stdClass();
	$req_sql->table = $_POST['table'];
	$req_sql->ctx = new stdClass();

	$var_array[] = $_POST['var'].'_fr';
	$var_array[] = $_POST['var'].'_en';
	$var_array[] = $_POST['var'].'_nl';

	foreach($var_array as $row_array)
	{
		if(!empty($_POST[substr($row_array, -2, 2)]))
			$req_sql->ctx->{$row_array} = $_POST[substr($row_array, -2, 2)];
	}
	$req_sql->where = "id = ".$_POST['id'];
	if(!empty(get_object_vars($req_sql->ctx)))
	{
		$_app->sql->update($req_sql);
	}
		
	//enrigstrement terminé

	//on va récup la valeur modifié pour la réafficher
	$req_sql = new stdClass();
	$req_sql->table = $_POST['table'];
	$req_sql->where = ['id'=>$_POST['id']];
	$req_sql->var_translate = $_POST['var'];
	$req_sql->var = "";
	$res_sql = $_app->sql->select($req_sql);
	echo $res_sql[0]->{$_POST['var']};
}
