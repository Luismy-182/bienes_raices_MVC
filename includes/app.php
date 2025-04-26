<?php 
require __DIR__.'/funciones/funciones.php';
require  'config/database.php';
require __DIR__ .'/../vendor/autoload.php';

//global para carpeta de imagenes
define('CARPETA_IMAGENES', __DIR__ . '/../public/imagenes/');

use Model\ActiveRecord;

$db=conectarDB();
ActiveRecord::setDB($db);
