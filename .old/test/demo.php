<?php
  $PAGE_TITLE = "Testing";

  require_once("../etc/config.web.php");
  require_once("../test/navbar.php");
?>
<div class=container>
  <form method=POST action="">
    <input type=text name=prog placeholder="Script Name" required/>
    <input type=text name=args placeholder="Arguments"/>
    <button type=submit name=submit>Submit</button>
  </form>
  <div style="overflow-y: scroll; max-height: 75vh;">
<?php
  if(isset($_POST)) {

    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";

    if(isset($_POST['prog'])) {
      $filepath = SCRIPTS_PATH . $_POST['prog'];
      $arguments = $_POST['args'];
      if($_POST['args'] != '') {
        $execpath = $filepath . ' ' . $arguments;
      } else {
        $execpath = $filepath;
      }

      if (file_exists($filepath) && is_file($filepath)) {
        // TODO: https://stackoverflow.com/questions/20107147/php-reading-shell-exec-live-output
        echo "<pre><code>";
        passthru($execpath);
        echo "</code></pre>";
      } else {
        echo "Script *" . $_POST['prog'] . "* does not exist!";
      }
    }
    unset($_POST);
  }
?>
  </div>
</div>

<?php require_once(WEB_PATH . "footer.php"); ?>
