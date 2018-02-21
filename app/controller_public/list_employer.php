<?
Class list_employer extends base_module
{
	public function __construct(&$_app)
	{		
		$_app->module_name = __CLASS__;
		parent::__construct($_app);

		$_app->navigation->_stack_nav[] = 'Liste des employers';



$horraire_sql = "SELECT name_shop_lundi.id as id_shop_lundi,
						name_shop_mardi.id as id_shop_mardi,
						name_shop_mercredi.id as id_shop_mercredi,
						name_shop_jeudi.id as id_shop_jeudi,
						name_shop_vendredi.id as id_shop_vendredi,
						name_shop_samedi.id as id_shop_samedi,
						name_shop_lundi.couleur_horraire as couleur_shop_lundi,
						name_shop_mardi.couleur_horraire as couleur_shop_mardi,
						name_shop_mercredi.couleur_horraire as couleur_shop_mercredi,
						name_shop_jeudi.couleur_horraire as couleur_shop_jeudi,
						name_shop_vendredi.couleur_horraire as couleur_shop_vendredi,
						name_shop_samedi.couleur_horraire as couleur_shop_samedi,
						name_shop_lundi.nom as name_shop_lundi,
						name_shop_mardi.nom as name_shop_mardi, 
						name_shop_mercredi.nom as name_shop_mercredi,
						name_shop_jeudi.nom as name_shop_jeudi,
						name_shop_vendredi.nom as name_shop_vendredi,
						name_shop_samedi.nom as name_shop_samedi,
						employer.id, 
						employer.gsm, 
						employer.habite, 
						employer.nom 
				FROM horraire_id_shop 
				INNER JOIN employer ON employer.id = horraire_id_shop.id_user
				INNER JOIN shop as name_shop_lundi ON name_shop_lundi.id = horraire_id_shop.lundi
				INNER JOIN shop as name_shop_mardi ON name_shop_mardi.id = horraire_id_shop.mardi
				INNER JOIN shop as name_shop_mercredi ON name_shop_mercredi.id = horraire_id_shop.mercredi
				INNER JOIN shop as name_shop_jeudi ON name_shop_jeudi.id = horraire_id_shop.jeudi
				INNER JOIN shop as name_shop_vendredi ON name_shop_vendredi.id = horraire_id_shop.vendredi
				INNER JOIN shop as name_shop_samedi ON name_shop_samedi.id = horraire_id_shop.samedi";

			$horraires = $this->sql->other_query($horraire_sql);

			foreach($horraires as $row_horraire)
			{
				$row_horraire->horraire['lundi']['id_shop'] = $row_horraire->id_shop_lundi;
				$row_horraire->horraire['lundi']['nom_shop'] = $row_horraire->name_shop_lundi;
				$row_horraire->horraire['lundi']['couleur_shop'] = $row_horraire->couleur_shop_lundi;

				$row_horraire->horraire['mardi']['id_shop'] = $row_horraire->id_shop_mardi;
				$row_horraire->horraire['mardi']['nom_shop'] = $row_horraire->name_shop_mardi;
				$row_horraire->horraire['mardi']['couleur_shop'] = $row_horraire->couleur_shop_mardi;

				$row_horraire->horraire['mercredi']['id_shop'] = $row_horraire->id_shop_mercredi;
				$row_horraire->horraire['mercredi']['nom_shop'] = $row_horraire->name_shop_mercredi;
				$row_horraire->horraire['mercredi']['couleur_shop'] = $row_horraire->couleur_shop_mercredi;

				$row_horraire->horraire['jeudi']['id_shop'] = $row_horraire->id_shop_jeudi;
				$row_horraire->horraire['jeudi']['nom_shop'] = $row_horraire->name_shop_jeudi;
				$row_horraire->horraire['jeudi']['couleur_shop'] = $row_horraire->couleur_shop_jeudi;

				$row_horraire->horraire['vendredi']['id_shop'] = $row_horraire->id_shop_vendredi;
				$row_horraire->horraire['vendredi']['nom_shop'] = $row_horraire->name_shop_vendredi;
				$row_horraire->horraire['vendredi']['couleur_shop'] = $row_horraire->couleur_shop_vendredi;

				$row_horraire->horraire['samedi']['id_shop'] = $row_horraire->id_shop_samedi;
				$row_horraire->horraire['samedi']['nom_shop'] = $row_horraire->name_shop_samedi;
				$row_horraire->horraire['samedi']['couleur_shop'] = $row_horraire->couleur_shop_samedi;
			}

		//affiche_pre($horraires[0]);

		$req_sql = new stdClass;
		$req_sql->table = "shop";
		$req_sql->var = "*";
		$req_sql->order = "id";
		$list_shop = $this->sql->select($req_sql);


		$this->get_html_tpl = $this->assign_var("horraires", $horraires)->assign_var("list_shop", $list_shop)->render_tpl();
	}
}