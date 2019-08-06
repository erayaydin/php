<?php

include __DIR__."/session.php";
include __DIR__."/database.php";
include __DIR__."/auth.php";

class Application {

    public static $session;
    public static $db;
    public static $auth;

    public static function run() {
        $root = __DIR__."/../";

        ob_start(); // Tamponlamayı başlatır. Yönlendirme varsa yönlendirme yapar yoksa çıktıyı gösterir.
        self::$session = new Session();
        self::$db      = new Database(Config::get("host"), Config::get("user"), Config::get("pass"), Config::get("name"));
        self::$auth    = new Auth();

        $panel = isset($_GET["panel"]) ? $_GET["panel"] : "student";
        $module = isset($_GET["module"]) ? $_GET["module"] : "home";
        $action = isset($_GET["action"]) ? $_GET["action"] : "index";

        include $root."header.php";

        if(self::$auth->check()){
            if(self::$auth->type == $panel){
                include $root.$panel."/".$module."/".$action.".php";
            } else {
                redirect("index.php");
            }
        } else {
            include $root.$panel."/login.php";
        }

        include $root."footer.php";

        ob_end_flush();
    }

}