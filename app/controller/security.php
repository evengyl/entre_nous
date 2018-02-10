<?php 

Class security extends base_module
{
	public $sql = "";
	public function __construct(&$_app)
	{
		if(Config::$need_sys_connection == "false") return;
		
		if(!isset($_app->sql))		
			$_app->sql = new all_query();
		
		$_app->module_name = __CLASS__;
		parent::__construct($_app);

		//va checker a chaque page si on est bien logger
		if(isset($_POST['return_form_complet']) || isset($_POST['return_form_complet_lost_login'])) 
			Config::$is_connect =  $this->check_session($_POST);

		else if(isset($_SESSION['pseudo']))
            Config::$is_connect =  1;
		else
            Config::$is_connect =  0;


        if(Config::$is_connect)
			$_app->user = singleton::get_singleton();
		else
			$_app->user = "";

		if(isset($_GET['page']) && $_GET['page'] == "login")
			$_app->navigation->set_breadcrumb('__TRANS_login__'); 

		
		$this->get_html_tpl = $this->use_template('login')->render_tpl();

	}

	public function check_session($post)
	{
		if(isset($post['return_form_complet']) && $post['return_form_complet'] == "55157141")
		{
		    if(isset($post["pseudo"]) && isset($post["password"]))
		    {
		    	$pseudo = $this->check_post_login($post['pseudo'], $is_pseudo = 1);
		    	$password = $this->check_post_login($post['password']);

		    	if(!$pseudo || !$password)
		    	{
		    		$_SESSION['error'] = "!! Attention votre login ou votre mot de passe est trop court !!";
		    		return 0;
		    	}
		    	else
		    	{	
		           	$req_sql = new StdClass();
		           	$req_sql->table = "login";
		           	$req_sql->var = "login, password, level, last_connect";
		           	$req_sql->where = ["login" => $pseudo];
					$res_fx = $this->sql->select($req_sql);

		            if(empty($res_fx))
		            {
		                $_SESSION['error'] = 'Login incorrect ou inexistant !';
		                return 0;
		            }
		            else if(isset($res_fx[0]->login))
		            {
		            	$res_fx = $res_fx[0];
		            	if(password_verify($password, $res_fx->password))
		            	{
			            	unset($_SESSION['error']);
			            	unset($post);
			                $_SESSION['pseudo'] = $res_fx->login;
			                $_SESSION['level'] = $res_fx->level;
			                $_SESSION['last_connect'] = $res_fx->last_connect;
			                $_SESSION['is_connect'] = 1;
			                return 1;
		            	}
		            	else
		            	{
		            		$_SESSION['error'] = 'Mot de passe incorrect !';
		            		return 0;
		            	}

		            }
		            else
		            {
		            	$_SESSION['error'] = 'Mot de passe incorrect !';
		            	return 0;
		            }
		    	}
		    }
		    else
		    {
		        $_SESSION['error'] = 'Formulaire mal rempli';
		        return 0;
		    }
		}
		else if(isset($post['return_form_complet_lost_login']) && $post['return_form_complet_lost_login'] == "71407141")
		{
		    if(isset($post["pseudo"]))
		    {
		    	$pseudo = $this->user->check_post_login($post['pseudo'], $is_pseudo = 1);

		    	if(!$pseudo)
		    	{
		    		$_SESSION['error'] = "!! Attention votre login est trop court !!";
		    		return 0;
		    	}
		    	else
		    	{	
		           	$req_sql = new StdClass();
		           	$req_sql->table = "login";
		           	$req_sql->var = "login, password, password_no_hash, email";
		           	$req_sql->where = ["login" => $pseudo];
					$res_fx = $this->sql->select($req_sql);

		           	

		            if(empty($res_fx))
		            {
		                $_SESSION['error'] = 'Login incorrect !';
		                return 0;
		            }
		            else
		            {
		            	$res_fx = $res_fx[0];
		            	unset($_SESSION['error']);
		            	unset($post);
		            	$subject = "Voici votre mot de passe : ".$res_fx->password_no_hash;
						mail($res_fx->email, "Recupération de mot de passe.", $subject);
		                return 0;
		            }
		    	}
		    }
		    else
		    {
		        $_SESSION['error'] = 'Formulaire mal rempli';
		        return 0;
		    }
		}
		else
		{
			$_SESSION['error'] = "Attention, Le clients à tenter quelque chose avec le formulaire";
			return 0;
		}
	}


}