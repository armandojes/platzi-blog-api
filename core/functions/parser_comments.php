<?php

function parser_comments ($comments_html){
  $comments_html = str_replace('/@','http://platzi.com/@',$comments_html);
  return $comments_html;
}
