<?php
  require_once("../etc/config.inc.php");

  $page = new Page("Machine Learning with Cancer Research");

  $page->content .= "
  <div class='row'>
    <div class=jumbotron style=\"border: 3px solid black\">
      <p>IC480 CS/IT Capstone
      <ul>
        <li>This website is a work in progress...</li>
      </ul>
    </div>
  </div>";

  $page->content .= "
  <div class=row>
    <img src=\"" . WEB_PATH . "css/images/Team8.jpg\"/ title=\"Group 8 hard at work\" class=\"img-responsive img-rounded\" style=\"border: 3px solid black\">
  </div>";

  $page->display();
?>
