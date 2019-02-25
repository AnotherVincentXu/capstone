<?php 
  require_once("../etc/config.inc.php");
  $page = new Page("Example");

  $page->content .= "<div class=jumbotron>";
  $page->content .= "<h1>Example header</h1>";
  $page->content .= "<div class=well>";
  $page->content .= "<p>Example body</p>";

  $page->content .= "<div class=\"container\" style=\"border:5px solid black; overflow-y:scroll; height: 70vh\">";
  $page->content .= "<pre>" . shell_exec("cat ../scripts/module.py") . "</pre>";
  $page->content .= "</div>";

  $page->content .= "</div>";
  $page->content .= "</div>";

  $page->display();
?>

