<?php
  require_once("../etc/config.web.php");
?>

<nav class="navbar navbar-default navbar-fixed-top navbar-inverse" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <!-- <a class="navbar-brand" href="<?php echo HOME_PAGE;?>"><img alt="" src="<?php echo WEB_PATH;?>css/images/web-icon.png" width="24"></a> -->
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li><a href="<?php echo HOME_PAGE;?>">Machine Learning with Cancer Research</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a class="dropdown-toggle" href=# title=More data-toggle=dropdown role=button aria-haspopup=true aria-expanded=false>More<span class="caret" aria-hidden=true></span></a>
          <ul class="dropdown-menu scrollable-menu">
            <li><a href="<?php echo HOME_PAGE;?>old/home/about.php">About Us</a></li>
            <li><a href="<?php echo HOME_PAGE;?>old/test/demo.php">Program Exec Test</a></li>
            <li><a href=https://www.kaggle.com/learn/machine-learning>ML Tutorial</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
