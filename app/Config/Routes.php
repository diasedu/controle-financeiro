<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

# Login / Autenticação
$routes->get("/", "Login::index");
$routes->post("login/auth", "Login::auth");
