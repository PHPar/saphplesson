<?php
/*#####################################################################*|
|                          SaphpLesson4.0                               |
| --------------------------------------------------------------------- |
|  This Script Is Free To Use But don't Delete copyright                |
|  Programmed By : Saleh AlMatrafe                                      |
|  Mobile : +966505545229 | Skype phone : saphps                        |
|  http://www.saphplesson.org  |  saphplesson@live.com(mail only)       |
|*#####################################################################*/
session_start();
$loginpage = 1;
require_once('./global.php');
$action = $_GET["action"];
switch ($action) {
  case "logout":
      /*setcookie('SaphpUserName' , '');
      setcookie('SaphpPassword' , '');*/
      session_unregister("SaphpUserName");
      session_unregister("SaphpPassword");
      session_destroy();
      $MSG["TITLE"]   = "בזֹֽ ַבÊֽßד";
      $MSG["OK"]      = "Êד Ê׃ּםב ־ׁזּ ָהַּֽ";
      $MSG["Referer"] = "../";
      echo $tpl->display("msgbox.tpl");
      break;
  default :
      if ($_SERVER["REQUEST_METHOD"]=="POST"){
          $username = CleanVar($_POST["cp_username"]);
          $password = md5(CleanVar($_POST["cp_password"]));
          $IsLogin    = $db->get_var("select count(*) from modretor Where
                                                  ModName='".$username."' and
                                                  ModPassword='".$password."'");
          if($IsLogin){
              /*session_register("SaphpUserName","SaphpPassword");
              setcookie('SaphpUserName' , $username);
              setcookie('SaphpPassword' , $password);*/
              $_SESSION["SaphpUserName"] = $username;
              $_SESSION["SaphpPassword"] = $password;
              $MSG["TITLE"]   = "בזֹֽ ַבÊֽßד";
              $MSG["OK"]      = "Êד Ê׃ּםב ֿ־זבß ָהַּֽ";
              $MSG["Referer"] = "./";
          }else{
              $MSG["TITLE"] = "בזֹֽ ַבÊֽßד";
              $MSG["Error"] = "בד םÊד Ê׃ּםב ֿ־זבß ¡ ַבֱַּׁ ַבÊֽÞÞ דה ַ׃ד ַבד׃Ê־ֿד זßבדֹ ַבדׁזׁ";
          }
          echo $tpl->display("msgbox.tpl");
          exit;
      }
      echo $tpl->display("login.tpl");
}

?>