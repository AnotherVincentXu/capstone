<?php
  require_once("../etc/config.inc.php");

  $page = new Page("Demo Program Execution");

  $page->content .= "
  <form method=POST action=\"\">
    <input type=text name=prog placeholder=\"Script Name\" value=\"module.py\" required/>
    <input type=text name=args placeholder=\"Arguments\" value=\"40\"/>
    <button type=submit name=submit>Execute</button>
  </form>";

  if(isset($_POST)) {
    // $page->content .= "<pre>";
    // print_r($_POST);
    // $page->content .= "</pre>";

    if(isset($_POST['prog'])) {

      // FIXME: scripts path
      $filename = $_POST['prog'];
      $arguments = $_POST['args'];
      $filepath = SCRIPTS_PATH . $filename; // FIXME

      if($_POST['args'] != '') {
        $execpath = $filepath . ' ' . $arguments;
      } else {
        $execpath = $filepath;
      }

      if (file_exists($filepath) && is_file($filepath)) {
        // https://stackoverflow.com/questions/20107147/php-reading-shell-exec-live-output
        $page->content .= "<div id=output style=\"overflow-y: scroll; max-height: 75vh; border: 3px solid black\">";
        $page->content .= "<code style=''>";
        $page->content .= shell_exec($execpath);
        $page->content .= "</code></div>";
        $page->content .= "<script>var element = document.getElementById(\"output\"); element.scrollTop = element.scrollHeight;</script>";
      } else {
        $page->content .= "Script *" . $_POST['prog'] . "* does not exist!";
      }
    }
    unset($_POST);
  }

  $page->content .= "</div>";

  $page->display();
?>
