<?php
  $PAGE_TITLE = "About Us";

  require_once("../etc/config.web.php");
  require_once("../test/navbar.php");

  $alphas = array("190810" => "Matt Bute",
    "191158" => "Matt Corbett", 
    "192658" => "John Heropoulos", 
    "193834" => "Lauren Lipkin", 
    "197116" => "Vincent Xu");
?>

<div class="container">
  <div class="row">
<?php
  foreach ($alphas as $alpha => $name) {
    echo "    <div class='col' style='width:20%; float: left; margin-bottom: 1%'><img src='https://usna.blackboard.com/bbcswebdav/orgs/DEPTCSERV/Midn%20Photos/2019/M$alpha.jpg' alt='Image not found' class='img-thumbnail' onmouseover='about(\"$name\")' onerror='this.onerror=null;this.src=\"".WEB_PATH."css/images/person.png\"'/></div>\n";
  }
?>
  </div>
  <div class=row>
    <div class=jumbotron id=content>
      <h3>IC480 CS/IT Capstone</h3>
      Group 8
    </div>
  </div>
</div>

<script>
  function about(info) {
    var content = document.getElementById("content");
    content.innerHTML = info;
  }
</script>

<?php require_once(WEB_PATH . "footer.php");?>
