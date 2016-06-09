<?php

function getDateToHuman($updated){
  
  $formatted = $updated->format('M d, Y');

  return $formatted;
}

function getDaysAgo($days)
{
  $formatted = Date::parse($days)->ago();

  return $formatted;
}