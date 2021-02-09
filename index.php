<?php
/** Create a food order form */

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Start a session
session_start();

//Require files
require_once('vendor/autoload.php');
require_once('model/data-layer.php');
require_once('model/validate.php');

//Instantiate Fat-Free
$f3 = Base::instance();

//Turn on Fat-Free error reporting
$f3->set('DEBUG', 3);

//Define a default route
$f3->route('GET /', function() {

    //Display a view
    $view = new Template();
    echo $view->render('views/home.html');
});

//Define an order route
$f3->route('GET|POST /order', function($f3) {

    //Add data from form1 to Session array
    //var_dump($_POST);

    //If the form has been submitted
    if ($_SERVER['REQUEST_METHOD']=='POST') {
        if(validFood($_POST['food'])) {
            $_SESSION['food'] = $_POST['food'];
        }
        else {
            $f3->set('errors["food"]', "Food cannot be blank");
        }
        if(isset($_POST['meal'])) {
            $_SESSION['meal'] = $_POST['meal'];
        }

        //If there are no errors, redirect to /order2
        if(empty($f3->get('errors'))) {
            $f3->reroute('/order2');
        }
    }

    //var_dump($_POST);
    $f3->set('meals', getMeals());

    //Display a view
    $view = new Template();
    echo $view->render('views/form1.html');
});

//Define an order2 route
$f3->route('GET|POST /order2', function($f3) {

    $f3->set('condiments', getCondiments());



    //Display a view
    $view = new Template();
    echo $view->render('views/form2.html');
});

//Define a summary route
$f3->route('POST /summary', function() {

    //echo "<p>POST:</p>";
    //var_dump($_POST);

    //echo "<p>SESSION:</p>";
    //var_dump($_SESSION);

    //Add data from form2 to Session array
    if(isset($_POST['conds'])) {
        $_SESSION['conds'] = implode(", ", $_POST['conds']);
    }

    //Display a view
    $view = new Template();
    echo $view->render('views/summary.html');
});

//Run Fat-Free
$f3->run();