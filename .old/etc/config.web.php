<?php
  define("WEB_PATH", "../../web/");
  define("SCRIPTS_PATH", "../../scripts/");
  define("HOME_PAGE", "/~m197116/capstone/");

  require_once(WEB_PATH . "css.php");

  $NAVBAR = true;

  if($NAVBAR) {
    require_once("../test/navbar.php");
  }
?>
