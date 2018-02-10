<?php 

Class admin_test_orm extends base_module
{

	public function __construct(&$_app)
	{		
		$_app->module_name = __CLASS__;
		parent::__construct($_app);
		$_app->navigation->set_breadcrumb('Test de l\'orm');

		//zone de test pour l'ORM
		/*
		pour decrire l'action
		orm est instanciée au début avec le min load, de la on appel une var qui n'existe pas dans orm, a la volée
		de la je lui dis ok elle existe pas va la chercher a la valée et crée moi sa classe, 
		ensuite je stock la class dans une pool pour utilisé plus tard au cas ou,
		et je retourne la class, de la j'ai acces en enchaienemnt au methode de la class et de tout les parents lié a celle ci bien sur 
		*/
		$this->orm->unit_test->select();
		//fin
	}
}
