<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Credentials: true');
header('Content-type: json/application');

require 'connect.php';
require 'functions.php';

$method = $_SERVER['REQUEST_METHOD'];


$q = $_GET['q'];
$params = explode('/', $q);

$type = $params[0];
$id = $params[1];

if ($method === 'GET') {
    if ($type === 'users') {

        if (isset($id)) {
            getUser($connect, $id);
        } else {
            getUsers($connect);
        }
    }
} elseif ($method === 'POST') {
    if ($type === 'users') {
        addUser($connect, $_POST);
    }
} elseif ($method === 'DELETE') {
    if ($type === 'users') {
        if (isset($id)) {
            deleteUser($connect, $id);
        }
    }
}