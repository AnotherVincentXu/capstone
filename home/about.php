<?php
  require_once("../etc/config.inc.php");

  $page = new Page("About Us");

  $alphas = array("190810"=>"Matt Bute", "191158"=>"Matt Corbett", "192658"=>"John Heropoulos", "193834"=>"Lauren Lipkin", "197116"=>"Vincent Xu");
  $page->content .= "<div class='row'>";
  foreach ($alphas as $alpha => $name) {
    $page->content .= "<div class='col' style='width:20%; float: left; margin-bottom: 1%'><img src='https://usna.blackboard.com/bbcswebdav/orgs/DEPTCSERV/Midn%20Photos/2019/M$alpha.jpg' id=\"$name\" alt='Image not found' class='img-thumbnail' onmouseover='about(\"$name\")' onerror='this.onerror=null;this.src=\"".WEB_PATH."css/images/user.png\"'/></div>\n";
  }

  $page->content .= "</div>
  <div class=row>
    <div class=jumbotron id=display style='border:3px solid black'>
      <h3>IC480 CS/IT Capstone</h3>
      <p>Group 8
    </div>
  </div>

  <script>
    function about(id) {
      var content = document.getElementById('display');
      content.innerHTML = \"<h3>\" + id + \"</h3><p>Coming soon...\";

      var image = document.getElementById(id);
      console.clear();
      console.log(image);
    }
  </script>";

  $page->display();
?>
