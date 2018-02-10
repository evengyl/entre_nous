<?
$base_dir = dirname(dirname(dirname(__FILE__)));
$_app = new stdClass();


require_once $base_dir."/app/core/tools.php";

require_once $base_dir."/app/modele/Config.php";
Config::set_config_base();


//Chargement de class concernée pour le sql
require_once $base_dir.'/app/core/load_class.php'; 

//start du execute time page , attention option dois être activée dans la config
start_exec_page_timer();

//mise en route de l'autoload
Autoloader::register(); 

//mise en route du systeme des query
$_app->sql = new all_query();
$_app->orm = new orm();
$_app->base_dir = $base_dir;

//setting parse
$parser = new parser($_app);

//mise en route du détecteur et assignateur de langue
$lang_select = new lang_select();
if(isset($_GET['lang']) && $_GET["lang"] != "")
	$lang_select->assign_lang($_GET["lang"], $_app);

else if(!isset($_SESSION['lang']) || empty($_SESSION["lang"]))
	$lang_select->auto_detect($_app);

//Mise en route de la navigation
require_once $base_dir."/app/includes/navigation.php";
$_app->navigation = new navigation($_app);

//Mise en route de la liste des traduction disponible pour le site 
$_app->translate = array();
$req_sql = new StdClass();
$req_sql->table = "translate";
$req_sql->var = "id, name_code";
$req_sql->var_translate = "name";
$res_fx = $_app->sql->select($req_sql);
foreach($res_fx as $row_trans)
{
	$_app->translate[$row_trans->name_code] = $row_trans;
}
	