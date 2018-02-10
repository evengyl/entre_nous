<?php

Class breadcrumb extends base_module
{

	public function __construct(&$_app)
	{	
		$this->_app = &$_app;
		$breadcrumb = [];

		if(isset($this->_app->navigation->_stack_nav))
		{
			$nav = $this->_app->navigation->_stack_nav;
			foreach($nav as $key_navigation => $row_navigation)
			{
				
				if(!empty($row_navigation[1]))
				{
					if(strstr($row_navigation[1], '?')) // ça veux dire que dans le controller quand on a set le url du breadcrumb on a mis un truc précis style ?page=tata&balba=tata
						$breadcrumb[$row_navigation[0]] = $row_navigation[1];
					else
						$breadcrumb[$row_navigation[0]] = "?page=".$_GET['page'].$row_navigation[1];
				}
				else	
					$breadcrumb[$row_navigation[0]] = "?page=".$_GET['page'];	
				
			}
		}
		else
		{
			if(isset($_GET['page']))
				$breadcrumb = array($_GET['page'] => "?page=".$_GET['page']);
			else
				$breadcrumb = array("Autre(s)" => "?page=home");
		}

		
		$breadcrumb = array_merge(array("__TRANS_accueil__" => "?page=home"), $breadcrumb);
		
		
		$i = count($breadcrumb);

		$title_page ="<div class='container-fluid breadcrumb_top col-without-padding'>
						<h1>
							<div class='home_button_bread'>
								<a href='?page=home'>
									<span class='glyphicon glyphicon-home'></span>
								</a>
							</div>";
		foreach($breadcrumb as $title => $link)
		{
			$i--;
			$title_page .= "<div class='level_bread'><a href='".$link."'>";

			if($i==0) $title_page .= $title.'</a>';
			else $title_page .= $title.'</a><span>&nbsp;&nbsp;>&nbsp;&nbsp;</span>';

			$title_page .= "</div>";
		}
		$title_page .= "</h1></div>";


		$this->get_html_tpl = $this->use_template("breadcrumb")->assign_var("breadcrumb", $title_page)->render_tpl();
	}

}
