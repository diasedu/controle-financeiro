<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

# Login / Autenticação / Logout
$routes->get("/", "Login::index");
$routes->post("login/auth", "Login::auth");
$routes->get("logout", "Login::logout");

$routes->get('user/new', 'Login::newUser');
$routes->post('user/save-new-user', 'Login::saveUser');

# Tela principal
$routes->get("/arealogada/principal", "Principal::index");

# Tela de cadastro de Marcas.
$routes->get("/arealogada/marca", "Marca::index");
$routes->post("/arealogada/marca/insertUpdate", "Marca::insertUpdate");
$routes->post("/arealogada/marca/getList", "Marca::getList");
$routes->post("/arealogada/marca/getRegister", "Marca::getRegister");
$routes->post("/arealogada/marca/deleteRegister", "Marca::deleteRegister");

# Tela de cadastro de Produtos.
$routes->get("/arealogada/produto", "Produto::index");
$routes->post("/arealogada/produto/insertUpdate", "Produto::insertUpdate");
$routes->post("/arealogada/produto/getList", "Produto::getList");
$routes->post("/arealogada/produto/getRegister", "Produto::getRegister");
$routes->post("/arealogada/produto/deleteRegister", "Produto::deleteRegister");

# Tela de cadastro de Clientes.
$routes->get("/arealogada/cliente", "Cliente::index");
$routes->post("/arealogada/cliente/insertUpdate", "Cliente::insertUpdate");
$routes->post("/arealogada/cliente/getList", "Cliente::getList");
$routes->post("/arealogada/cliente/getRegister", "Cliente::getRegister");
$routes->post("/arealogada/cliente/deleteRegister", "Cliente::deleteRegister");

# Tela de vendas
$routes->get('/arealogada/venda', 'Venda::index');
$routes->post('/arealogada/venda/insertUpdate', 'Venda::insertUpdate');
$routes->post('/arealogada/venda/getList', 'Venda::getList');
$routes->post('/arealogada/venda/getRegister', 'Venda::getRegister');
$routes->post('/arealogada/venda/deleteRegister', 'Venda::deleteRegister');
