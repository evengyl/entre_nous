<? session_start(); ?>
<!DOCTYPE html>
<?


$base_dir = dirname(dirname(__FILE__)); // directory renvoi c:/xampp/htdocs/"dossier_du_serveur_courant"


//require de base avec les fonciton diverse et le loader, la fonction microtime est la uniquement pour le temps d'execution des requete pour optimiser
require $base_dir."/app/includes/app_min_load.php";

//va être appeler a chaque démarage de script page et va checker si le user est connecter ou pas.
new security($_app);
//mise en route de la session
if(!isset($_GET['page']))
	$_GET['page'] = 'home';

ob_start();?>
	<html lang="Fr-be">
		<head>
			__TPL_top_head__
		</head>
		<body>
			__MOD_header__
			__MOD2_breadcrumb__
			<div class="container container_general_content">
				<? new router($_GET, $_app); ?>
			</div>
			__MOD_footer__
		</body>
		__TPL2_bottom_head__
	</html><?

$page = ob_get_clean();
//appel le parseur qui rendra tout les modules et tout les vues

 //contiendra tout les modules de l'applications appelé sur la page. apres execution de celui ci, il est placé dans l'app.
$parser = new parser($_app);
$page = $parser->parser_main($page);
$page = $parser->parser_translate($page);
//affiche la page complete avec toute les données traitée
echo $page; 




if(Config::$view_time_executed_in_footer_page)
	view_time_exec_page();


//affiche_pre($_app);
//affiche les messages d'erreur du code
if(!empty($_SESSION['error']))
{
	paragraphe_style($_SESSION['error']);
	unset($_SESSION['error']);
}

Config::get_sql_list();

if(!empty($_POST))
{
	foreach($_POST as $key => $values)
	{
		unset($_POST[$key]);
	}
}
