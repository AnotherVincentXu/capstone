<?php

  function search_3d_array($target, $array_3d) {
    foreach($array_3d as $array_2d) {
      foreach($array_2d as $array => $value) {
        if($value == $target) {
          return $array;
        }
      }
      return false;
    }
  }

?>
