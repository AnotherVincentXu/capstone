<?php

  // Generic Table Template
  // - takes a 2-D associative array and returns it in table form
  // - $withHeaders indicates whether the array contains a headers array
  function table($table, $withHeaders=false, $id="table") {
    $tableString = "<table class=\"table table-hover\" id=$id><thead><tr>";

    if(!$withHeaders) {
      foreach ($table[array_keys($table)[0]] as $key => $value) {
        $tableString .= "<th>$key</th>";
      }
    } else {
      foreach ($table['headers'] as $key => $value) {
        $tableString .= "<th>$value</th>";
      }
      $headers = array_shift($table);
    }

    $tableString .= "</tr></thead><tbody>";
    foreach($table as $row => $row_data) {
      $tableString .= "<tr>";
      foreach($row_data as $key => $value) {
        $tableString .= "<td>$value</td>";
      }
      $tableString .= "</tr>";
    }
    $tableString .= "</tbody></table>";

    if(isset($headers)) {
      array_unshift($table, $headers);
    }
    return $tableString;
  }
 ?>
