<?php
require('vendor/autoload.php');

$f3 = \Base::instance();

$f3->set("site", "BTAX");

$f3->set("AUTOLOAD", "classes/");

$logger = new Log('log.log');

try {
    $f3->set(
        "DB", new DB\SQL(
            'mysql:host=localhost;port=3306;dbname=btax2022',
            'btax2022',
            'Gn0me')
    );
    new DB\SQL\Session($f3->DB,'sessions',TRUE,NULL,'CSRF');

} catch (Exception $e) {
    $logger->write($e);
    die;
}

$f3->redirect('GET|HEAD /', '/home');

$f3->route('GET /home', function($f3) {
    $f3->set('inc','ui/home.htm');
    $f3->set('menuActivePage', 'home');
    echo \Template::instance()->render('ui/layout.php');
});
$f3->route('GET /import', function($f3) {
    $f3->set('inc','ui/import.htm');
    $f3->set('menuActivePage', 'import');
    echo \Template::instance()->render('ui/layout.php');
});
$f3->route('GET /view', function($f3) {
    $arr = [];
    parse_str($f3->get("QUERY"), $arr);
    print_r ($arr);
    $f3->set('params', $arr);


    $f3->set('inc','ui/view.php');
    $f3->set('menuActivePage', 'view');
    echo \Template::instance()->render('ui/layout.php');
});
$f3->route('GET /statement', function($f3) {
    $arr = [];
    parse_str($f3->get("QUERY"), $arr);
    print_r ($arr);
    $f3->set('params', $arr);


    $f3->set('inc','ui/statement.php');
    $f3->set('menuActivePage', 'statement');
    echo \Template::instance()->render('ui/layout.php');
});


$f3->map('/api/bookings', 'Bookings');

$f3->run();