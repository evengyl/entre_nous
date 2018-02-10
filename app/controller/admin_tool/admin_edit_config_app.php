<?php 

Class admin_edit_config_app extends base_module
{

	public function __construct(&$_app)
	{		
		$_app->module_name = __CLASS__;
		parent::__construct($_app);

		//on recup le contenu sous forme d'objet du jason config
		$_get_config = Config::get_config_base();

		//operation de modification du JSON recu
		if(isset($_POST['form__config']) && $_POST['form__config'] == 71414242)
		{
			unset($_POST['form__config']);

			foreach($_POST as $key_post => $row_post)
			{
				if(empty($row_post))
					unset($_POST[$key_post]);
			}

			$_new_config = array_merge((array)$_get_config, $_POST);

			if(Config::push_config_base($_new_config))
				$_get_config = Config::get_config_base();
			else
				return $_SESSION['error'] = "Attention erreur avec le formulaire de configuration";
		}
		
		$this->get_html_tpl = $this->assign_var('_config', $_get_config)->use_template()->render_tpl();
	}

    
}
