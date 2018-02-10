<?
Class user extends all_query
{
	
	public function __construct()
	{
		if(Config::$is_connect == 1)
		{
			parent::__construct();
            $this->get_variable_user();
		}
		else
			return 0;
	}

	public function get_variable_user()
	{
		if(!isset($this->user_infos))
			$this->user_infos = new stdClass();

		$req_sql = new stdClass;
		$req_sql->table = "login";
		$req_sql->var = "*";
		$req_sql->where = "login ='".$_SESSION['pseudo']."'";
		$res_fx = $this->select($req_sql);

		foreach($res_fx[0] as $key => $values)
		{
			$this->user_infos->$key = $values;			
		}
		unset($res_fx);
	}

	public function check_post_login($text)
	{
		$text = trim($text);
		$text = htmlentities($text);
		$nb_char = strlen($text);

		if($nb_char <= 6)
			return 0;		
		else
			return $text;
	}
}