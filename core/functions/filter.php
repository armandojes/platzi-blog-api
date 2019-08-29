<?php

function filter ($str){
  $str = str_replace('data-cfsrc', 'src',$str);
  $str = str_replace('style="display:none;visibility:hidden;"', '',$str);
  return $str;
}
