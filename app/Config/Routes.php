<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('');
$routes->setDefaultMethod('');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/masuk', 'Home::masuk');

$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'login']);
$routes->get('/kepala-keluarga', 'kepalaKeluarga::index', ['filter' => 'role:superadmin']);
$routes->get('/kepala-keluarga-admin', 'kepalaKeluarga::tabeladmin', ['filter' => 'role:admin']);
$routes->get('/anggota', 'Anggota::index', ['filter' => 'role:superadmin']);
$routes->get('/anggota-admin', 'Anggota::tabeladmin', ['filter' => 'role:admin']);
$routes->get('/kriteria-rumah', 'Rumah::index', ['filter' => 'role:superadmin']);
$routes->get('/kriteria-rumah-admin', 'Rumah::tabeladmin', ['filter' => 'role:admin']);
$routes->get('/sumber-air-admin', 'Air::tabeladmin', ['filter' => 'role:admin']);
$routes->get('/sumber-air', 'Air::index', ['filter' => 'role:superadmin']);
$routes->get('/makanan-pokok', 'Makanan::index', ['filter' => 'role:superadmin']);
$routes->get('/makanan-pokok-admin', 'Makanan::tabeladmin', ['filter' => 'role:admin']);
$routes->get('/desa-kelurahan', 'Desa::index', ['filter' => 'login']);
$routes->get('/kegiatan-admin', 'Kegiatan::tabeladmin', ['filter' => 'role:admin']);
$routes->get('/kegiatan', 'Kegiatan::index', ['filter' => 'role:superadmin']);
$routes->get('/pengguna', 'Pengguna::index', ['filter' => 'login']);
$routes->get('/tambah', 'Dashboard::tambah', ['filter' => 'login']);
$routes->get('/profile', 'Home::profile', ['filter' => 'login']);
$routes->get('/laporan', 'Home::laporan', ['filter' => 'login']);
$routes->get('/laporan/export', 'Home::export', ['filter' => 'role:superadmin']);
$routes->get('/laporan/export2', 'Home::export2', ['filter' => 'role:admin']);











/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
