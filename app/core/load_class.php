<?
class Autoloader
{
    static function register()
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    static function autoload($class)
    {
       $base_dir = dirname(dirname(dirname(__FILE__))); // directory renvoi c:/xampp/htdocs/"dossier_du_serveur_courant"
       switch($class)
       {
            case "_db_connect":
                require($base_dir."/app/modele/".$class.".class.php");
                break;

            case "all_query":
            case "select":
            case "where":
            case "var_processing":
            case "parse_sql":
            case "orm":
            case "modele_sql":
                require($base_dir."/app/core/sql_core/".$class.".php");
                break;

            case strpos($class, "model_") !== false:
                if(file_exists($base_dir."/app/core/sql_core/modele_object/".$class.".php"))
                    require($base_dir."/app/core/sql_core/modele_object/".$class.".php");
                break;

            case "router":
                require($base_dir."/app/".$class.".php");
                break;

            case "parser":
            case "lang_select":
                require($base_dir."/app/includes/".$class.".php");
                break;

            case strpos($class, "admin_") !== false:
                if(file_exists($base_dir."/app/controller/admin_tool/".$class.".php"))
                    require($base_dir."/app/controller/admin_tool/".$class.".php");
                break;

            default:
                require($base_dir."/app/controller/".$class.'.php');
       }
    }
}?>