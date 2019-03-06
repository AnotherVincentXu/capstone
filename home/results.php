<?php
  require_once("../etc/config.inc.php");

  $page = new page("Results", $showHeader=true, $showFooter=false);

  $page->content .= "<form action=''>
  <select name=alg required>
    <option value=''></option>
    <option value='Random Forest'>Random Forest</option>
    <option value='Neural Network'>Neural Network</option>
    <option value='Naive Bayes'>Naive Bayes</option>
  </select>
  <input type=submit value='Select Algorithm'>
</form>";

  $files = array("Random Forest" => "RFGridSearch",
                 "Neural Network" => "NNGridSearch",
                 "Naive Bayes" => "NBGridSearch");

  // $page->content .= "<pre>" . print_r($_REQUEST, true) . "</pre>";

  if(isset($_REQUEST['alg'])) {
    foreach($files as $alg => $datafile) {
      if($_REQUEST['alg'] == $alg) {
        $array2d = read_csv(DATA_PATH . $datafile . ".csv", $withHeaders=True, $withLeftID=False);
        $index = search_3d_array("f1_mean", $array2d);

        $indexes = "";
        $columns = array();
        if($index > 1) {
          for($i=1; $i<$index; $i++) {
            $indexes .= $i . ",";
            $columns[] = $array2d['headers'][$i];
          }
        }

        // $array_string = print_r($array2d['headers'], true);

        $searchString = "";
        foreach($_REQUEST as $param => $value) {
          if($param == 'alg') {
            continue;
          } else {
            if($value == "") {
              $value = ".*";
            }
          }
          $searchString .= $param . "_" . $value . "_";
        }
        $searchString = substr($searchString, 0, -1);

        // $page->content .= "<pre>";
        // $page->content .= $searchString;
        // $page->content .= "</pre>";

        $page->content .= "<div class=well><pre>";
        $page->content .= "Valid parameter values:
- RF: [1, 5, 10] 
      [10, 20, None] 
      [entropy, gini] 
      [auto, sqrt]
- NN: [adam, rmsprop, sgd] 
      [glorot_normal, glorot_uniform, uniform] 
      [1] 
      [256, 1024]
- NB: N/A

To display all results, search without any parameter values.";
        $page->content .= "</pre></div>";

        $page->content .= "<form action=''>
          <input type=hidden name=alg value=\"" . $_REQUEST["alg"] ."\">
          <input type=text name=$columns[0] placeholder=$columns[0] >
          <input type=text name=$columns[1] placeholder=$columns[1] >
          <input type=text name=$columns[2] placeholder=$columns[2] >
          <input type=text name=$columns[3] placeholder=$columns[3] >
          <input type=submit value=Search>
        </form>";


        $page->content .= table($array2d, $withHeaders=True, $id=$datafile);
        $page->content .= "
      <script type=\"text/javascript\">
        $(document).ready(function() {
          $('#$datafile').DataTable( {
              /*\"lengthMenu\": [[5, 10, 25, 50, 100, 500, -1], [5, 10, 25, 50, 100, 500, \"All\"]],*/
              \"pageLength\": -1,
              \"dom\": 'Bfrtip',
              \"buttons\": [ 'pageLength'/*, 'csv', 'excel'*/],
              \"columnDefs\": [
                  {
                    \"targets\": [ 0 ],
                    \"visible\": false 
                  },
                  {
                    \"targets\": [ $indexes ],
                    \"visible\": false,
                    \"searchable\": true
                  }
              ],
              \"search\": {
                \"regex\": true,
                \"search\" : \"$searchString\"
              }
          } );
        } );
      </script>";
      }
    }
  }

  $page->display();

?>
