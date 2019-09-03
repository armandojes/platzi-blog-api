<?php


function get_coments ($url) {
  $html_raw = file_get_contents("https://platzi.com/blog/$url");
  if ($html_raw === false) return false;


  //primer filtro
  $start_pos = strpos($html_raw, '<section class="CommentList"');
  $end_pos = strrpos($html_raw, '</section></div></div></div><section class="RelatedPosts');
  $length = ($end_pos - $start_pos);
  $html_raw = substr($html_raw,$start_pos, ($length - 32));
  return $html_raw;
}
