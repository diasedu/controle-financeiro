<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

# Login / Autenticação / Logout
$routes->get("/", "Login::index");
$routes->post("login/auth", "Login::auth");
$routes->get("logout", "Login::logout");

# Tela principal
$routes->get("/arealogada/principal", "arealogada\Principal::index");

# Tela de contas.
$routes->get("/arealogada/conta", "arealogada\Conta::index");
$routes->post("/arealogada/conta/insertUpdate", "arealogada\Conta::insertUpdate");
$routes->post("/arealogada/conta/getList", "arealogada\Conta::getList");
$routes->post("/arealogada/conta/getRegister", "arealogada\Conta::getRegister");
$routes->post("/arealogada/conta/deleteRegister", "arealogada\Conta::deleteRegister");