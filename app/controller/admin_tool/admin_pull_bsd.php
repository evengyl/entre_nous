<?php 

Class admin_pull_bsd extends base_module
{

	public function __construct(&$_app)
	{		
		$_app->module_name = __CLASS__;
		parent::__construct($_app);

		$_app->navigation->_stack_nav[] = 'Pull de la base de donnée';

		if(strstr(php_uname(), 'Windows'))
		{
			$rec = '../';
			shell_exec("C:/xampp\mysql\bin\mysqldump --host=".Config::$hote." --user=".Config::$user." --password=".Config::$Mpass." ".Config::$base." > ".$rec.Config::$base.".sql");
		}
		elseif(strstr(php_uname(), "Linux"))
		{
			$rec = '/var/www/framework_evengyl/';
			shell_exec("mysqldump --host=".Config::$hote." --user=".Config::$user." --password=".Config::$Mpass." ".Config::$base." > ".$rec.Config::$base.".sql");
		}

		if(file_get_contents($rec.Config::$base.".sql"))
			$value_return = 1;
		else
			$value_return = 0;

		$this->get_html_tpl =  $this->assign_var("value",$value_return)->use_template("admin_action_ok")->render_tpl();
	}


}
