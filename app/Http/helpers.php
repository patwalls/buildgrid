<?php

function getDateToHuman($updated){
  
  $formatted = $updated->format('M d, Y');

  return $formatted;
}