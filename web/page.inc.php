<?php

class Page
{
  public $content;
  private $title;
  private $keywords = 'machine learning, cancer, research, computer science';
  private $xmlheader = "<!DOCTYPE html><html lang='en'>";
  private $showHeader;
  private $showFooter;

  public function __construct($title, $showHeader=False, $showFooter=True) {
    $this->__set("title", $title);
    $this->__set("showHeader", $showHeader);
    $this->__set("showFooter", $showFooter);
  }

  public function __set($key, $value) {
    $value = trim($value);
    $value = strip_tags($value);
    if (!get_magic_quotes_gpc()){
      $value = addslashes($value);
    }
    $this->$key = $value;
  }

  public function __get($key) {
    return $this->$key;
  }

  //display the page
  public function display()
  {
    echo $this->xmlheader;
    echo "<head>\n";
    $this -> displayMeta();
    $this -> displayTitle();
    $this -> loadCSS();
    $this -> loadJS();
    $this -> displayStyles();
    echo "</head>\n<body>\n<div class=container>";
    $this -> displayNavbar();
    if($this->showHeader) { $this -> displayContentHeader(); }
    echo $this->content . "</div>";
    if($this->showFooter) { $this -> displayContentFooter(); }
    echo "</body>\n</html>\n";
  }

  public function displayMeta() {
    echo "<meta charset=\"utf-8\">";
    echo "<meta http-equiv='X-UA-Compatible' content='IE=edge'>";
    echo "<meta name='viewport' content='width=device-width, initial-scale=1'>";
    echo "<meta name=\"keywords\" content=\"" . $this->keywords . "\" />";
    echo "<link rel='icon' href='" . WEB_PATH . "css/images/ml.png'>";
  }

  public function displayTitle() {
    echo '<title> '.$this->title.' </title>';
  }

  public function loadCSS() {
    ?>
    <!-- Bootstrap core CSS -->
    <link href="<?php echo WEB_PATH;?>bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Skeleton CSS -->
    <link rel="stylesheet" href="<?php echo WEB_PATH;?>skeleton/css/normalize.css">
    <link rel="stylesheet" href="<?php echo WEB_PATH;?>skeleton/css/skeleton.css">
    <link rel="stylesheet" href="<?php echo WEB_PATH;?>css/skeleton-modifications.css">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="<?php echo WEB_PATH; ?>bootstrap/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="<?php echo WEB_PATH; ?>fonts/raleway.css" rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <link href="<?php echo WEB_PATH; ?>css/mysite-default.css" rel="stylesheet">

    <!-- Font-Awesome -->
    <link rel="stylesheet" type="text/css" href="<?php echo WEB_PATH; ?>font-awesome/css/font-awesome.min.css">

    <!-- Printing -->
    <link rel="stylesheet" type="text/css" media="print" href="<?php echo WEB_PATH; ?>css/mysite-print.css" />

    <!--DataTables-->
    <link rel="stylesheet" type="text/css" href="<?php echo WEB_PATH; ?>datatables.net/datatables.min.css"/>
    <?php
  }

  public function loadJS() {?>
    <!-- Bootstrap core JavaScript -->
    <script src="<?php echo WEB_PATH;?>bootstrap/js/jquery.min.js"></script>
    <script src="<?php echo WEB_PATH;?>bootstrap/js/bootstrap.min.js"></script>

    <!-- DataTables -->
    <script type="text/javascript" src="<?php echo WEB_PATH; ?>datatables.net/datatables.min.js"></script>
    <?php
  }

  public function displayStyles() {?>
    <style>
      html, body {
        background-color: #dddddd;
      }

      code {
        display:block;
        white-space:pre-wrap;
        font-size:125%;
      }
    </style>
    <?php
  }

  public function displayContentHeader() {
    ?>
      <header></header>
    <?php
  }

  public function displayNavbar() {
    require_once(WEB_PATH . "navbar.php");
  }

  public function displayContentFooter() {
    require_once(WEB_PATH . "footer.php");
  }
}
?>
