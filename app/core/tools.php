<?
##########################################
#	Createur : Evengyl
#	Date de creation : 23-03-2017
##########################################

$timestamp = date("U");

function info_php()
{
    echo phpinfo();
}

function paragraphe_style($txt)
{
    echo '<div class="col-lg-12" style="margin-top:10px; margin-bottom:10px;"><p style="font-size:17px; padding:10px; text-align:center;" class="bg-success">'.$txt.'</p></div>';
}   




function view_time_exec_page()
{
    $time_stop = $this->tools->microtime_float();
    $this->tools->paragraphe_style("Execution de la page en : ".($time_stop - Config::$time_start_exec)." Seconde(s)"); 
}

function logout($base_dir)
{
    require($base_dir.'/public/logout.php');
}


function affiche_pre($var_a_print)
{
    ?><div class='col-xs-12' style='margin-bottom:50px;'><pre><?
        print_r($var_a_print);
    ?></pre></div><?
}

function start_exec_page_timer()
{
    if(isset(Config::$view_time_executed_in_footer_page) && Config::$view_time_executed_in_footer_page)
        Config::$time_start_exec = microtime_float();
}

function microtime_float()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec);
}


