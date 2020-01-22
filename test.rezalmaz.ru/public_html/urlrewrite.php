<?php
$arUrlRewrite=array (
  0 => 
  array (
    'CONDITION' => '#/faq/page_([0-9]+)/(\\?.*)?#',
    'RULE' => 'PAGEN_1=$1',
    'ID' => '',
    'PATH' => '/faq/index.php',
    'SORT' => 100,
  ),
  1 => 
  array (
    'CONDITION' => '#/faq/(.*)/(\\?.*)?#',
    'RULE' => 'CODE=$1',
    'ID' => '',
    'PATH' => '/faq/detail.php',
    'SORT' => 100,
  ),
  2 => 
  array (
    'CONDITION' => '#^/portfolio/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/portfolio/index.php',
    'SORT' => 100,
  ),
  3 => 
  array (
    'CONDITION' => '#^/regions/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/regions/index.php',
    'SORT' => 100,
  ),
);
