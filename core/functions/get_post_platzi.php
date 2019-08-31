<?php

function get_post_platzi ($url){
  $html_raw = file_get_contents("https://platzi.com/blog/$url");

  //obtener solo body
  $position_start =  strpos($html_raw, '<body>');
  $lenght =  (strrpos($html_raw, '</body>') - $position_start);
  $html_raw = substr($html_raw, $position_start, $lenght + 7);

  //obtener section primary
  $position_start =  strpos($html_raw, '<section');
  $lenght =  (strrpos($html_raw, '</section>') - $position_start);
  $html_raw = substr($html_raw, $position_start + 10, $lenght - 10);

  //siguente  section con etiquetas
  $position_start =  strpos($html_raw, '<section');
  $lenght =  (strrpos($html_raw, '</section>') - $position_start);
  $html_raw = substr($html_raw, $position_start , $lenght);


  //eliminar segundo seccions hermano
  $lenght =  strrpos($html_raw, '<section');
  $html_raw = substr($html_raw,0, $lenght);


  //eliminar div hermano
  $lenght =  strrpos($html_raw, '<div class="DiscusionDetail-comments"');
  $html_raw = substr($html_raw,0, $lenght);


  //obtener ultimo div
  $position_start =  strrpos($html_raw, '<div class="MainDiscussion-body"');
  $html_raw = substr($html_raw,$position_start, -10);

  //obtener solo el contenido
  $position_start =  strpos($html_raw, '<div class="Discussion-content"');
  $lenght =  (strrpos($html_raw, '</div><div class="col-md-1"') - $position_start);
  $html_raw = substr($html_raw, $position_start, $lenght);

  //quitar ultimo class
  $html_raw = str_replace('class="Discussion-content"', '', $html_raw);
  return $html_raw;
}
