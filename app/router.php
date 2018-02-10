<?
Class router
{
	public $route;

	public function __construct($route, &$_app)
	{
		$this->route = $_app->route = $route;

		if(isset($this->route['page']))
		{
			switch($this->route['page'])
			{
				case 'home':
					$this->assign_mod('home');
					break;

				case 'sign_up':	
					$this->assign_mod('sign_up');
					break;

				case 'admin':
						$this->is_connect()->assign_mod('admin');
					break;
			
				case 'login':
						$this->assign_mod('security');
		 			break;

				case 'logout':
					if(!Config::$need_sys_connection)
							$this->assign_mod('logout');
					else
	 					logout($_app->base_dir);
		 			break;

				case 'test':
					$this->assign_mod('test');
					break;

				case 'contact':
					$this->assign_mod('contact');
					break;

				case 'my_account':
						$this->is_connect()->assign_mod('my_account');
					break;

				case 'password_change':
						$this->is_connect()->assign_mod('password_change');
					break;

				case 'todo':
						$this->is_connect()->assign_mod('todo');
					break;

				case 'list_employer':
						$this->is_connect()->assign_mod('list_employer');
					break;

				case 'documentations':
					$this->assign_mod('documentations');
					break;


				case 'find_us':
					$this->assign_mod('find_us');
					break;
				
				case 'categ':
					if(isset($this->route['categ_id']))
						$this->assign_mod('categories');
					break;

				case 'product':
					if(isset($this->route['product_id']))
						$this->assign_mod('product');
					break;

				default:
					$this->assign_mod('error', '', '404');
					unset($this->route['page']);
			}	
		}
	}

	
	protected function is_connect()
	{
		if(Config::$need_sys_connection)
		{
			if(Config::$is_connect == 1)
				return $this;
			else
			{
				//permet de retourner sur la page login quand une page non permise est demandée
				$this->route['page'] = 'security';
				return $this;
			}	
		}
		else{
			return $this;
		}
		
	}



	protected function assign_mod($specific_module = false, $module_secondaire = false, $var_module = false, $tpl = false)
	{
		if(Config::$need_sys_connection == 'false')
		{
			//si pas de sys de connection alors les appel des page en direct commet avec assign mod, doivent renvoyée comme is_connect, vers home
			if($specific_module == "security" || $specific_module == "admin")
			{
				$specific_module = "404";
			}
				
		}

		if($tpl)
			$pre_echo_mod = "__TPL";
		else if($specific_module)
			$pre_echo_mod = "__MOD";

		if($module_secondaire)
			$pre_echo_mod .= "2_";
		else
			$pre_echo_mod .= "_";


		if($specific_module)
			$pre_echo_mod .= $specific_module;
		else if($tpl)
			$pre_echo_mod .= $tpl;	


			

		if($var_module)
			$pre_echo_mod .= "(".$var_module.")";


		$pre_echo_mod .= "__";
		echo $pre_echo_mod;
	}
}
