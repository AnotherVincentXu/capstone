<?php
  header("Refresh:1; url=../index.php");

  require_once("../etc/config.inc.php");

  $page = new Page("404 Not Found");

  $page->content .= "
<div class=row>
  <center>
    <img src=\"" . WEB_PATH . "css/images/huh.png\" hint=\"https://www.clipartmax.com/download/m2i8i8m2b1A0A0d3_png-file-error-icono/\" class=\"img-responsive\" style=\"height:50%; width:50%\"/>
    <h1><b><font color=red>404 PAGE NOT FOUND</font></b></h1>
  </center>
</div>";
  $page->display();
?>
