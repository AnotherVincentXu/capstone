<?php

  // configuration
  define("LIB_PATH", "../lib/");
  define("WEB_PATH", "../web/");
  define("DATA_PATH", "../data/");
  define("SCRIPTS_PATH", "../scripts/");
  define("HOME_PAGE", "/~m197116/capstone/");

  // include page class for HTML generation
  require_once(WEB_PATH . "page.inc.php");

  // include useful library functions
  require_once(LIB_PATH . "lib_read_csv.php");
  require_once(LIB_PATH . "lib_tables.php");
  require_once(LIB_PATH . "lib_functions.php");

?>
