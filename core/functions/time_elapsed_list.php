<?php

function time_elapsed_list($array_of_items){

  if (gettype($array_of_items) != 'array')

  return $array_of_items;

  $array_of_items_parsed = [];

  foreach ($array_of_items as $item) {
    $item['created_at'] = time_elapsed($item['created_at']);
    array_push($array_of_items_parsed,$item);
  }

  return $array_of_items_parsed;
}
