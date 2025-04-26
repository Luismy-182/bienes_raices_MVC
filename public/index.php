<?php 
require_once __DIR__.'../../includes/app.php';

use Controller\LoginController;
use MVC\Router;
use Controller\PaginasController;
use Controller\VendedorController;
use Controller\PropiedadController;

$router = new Router();

//zona admin
$router->get('/admin', [PropiedadController::class, 'index']);
$router->get('/admin/propiedades/crear', [PropiedadController::class, 'crear']);
$router->post('/admin/propiedades/crear', [PropiedadController::class, 'crear']);
$router->get('/admin/propiedades/actualizar', [PropiedadController::class, 'actualizar']);
$router->post('/admin/propiedades/actualizar', [PropiedadController::class, 'actualizar']);
$router->post('/admin/propiedades/eliminar', [PropiedadController::class, 'eliminar']);

//vendedores
$router->get('/admin/vendedores/crear', [VendedorController::class, 'crear']);
$router->post('/admin/vendedores/crear', [VendedorController::class, 'crear']);

$router->get('/admin/vendedores/actualizar',[VendedorController::class,'actualizar']);
$router->post('/admin/vendedores/actualizar',[VendedorController::class,'actualizar']);

$router->post('/admin/vendedores/eliminar',[VendedorController::class,'eliminar']);


//zona publica

$router->get('/', [PaginasController::class, 'index']);
$router->get('/nosotros', [PaginasController::class, 'nosotros']);
$router->get('/propiedades', [PaginasController::class, 'propiedades']);
$router->get('/propiedad', [PaginasController::class, 'propiedad']);
$router->get('/blog', [PaginasController::class, 'blog']);
$router->get('/entrada', [PaginasController::class, 'entrada']);
$router->get('/contacto', [PaginasController::class, 'contacto']);
$router->post('/contacto', [PaginasController::class, 'contacto']);


//login

$router->get('/login',[LoginController::class, 'login']);
$router->post('/login',[LoginController::class, 'login']);
$router->get('/logout',[LoginController::class, 'logout']);
$router->post('/logout',[LoginController::class, 'logout']);
$router->comprobarRutas();