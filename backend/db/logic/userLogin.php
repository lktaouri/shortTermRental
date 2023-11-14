<?php

include_once 'config/dbacess.php';
include_once 'models/user.php';


$database = new Database();
$db = $database->getConnection();

$items = new Users($db);
$items->email = (isset($_POST['email']) ? $_POST['email'] : '');
$items->password = (isset($_POST['password']) ? $_POST['password'] : '');

session_start();
$result = $items->getUserInfo();

if ($result->num_rows > 0) {
    while ($item = $result->fetch_assoc()) {
        extract($item);
        $itemDetails = array(

            "email" => $email,
            "password" => $password
        );
    }
}


if ($_POST['email'] == $itemDetails['email'] && $_POST['password'] == $itemDetails['password']) {
    $_SESSION['email'] = $itemDetails['email'];
    echo "success";
    var_dump($_SESSION['email']);
    var_dump($itemDetails);
    var_dump($_POST['email']);
} else {
    echo "fail";
    var_dump($itemDetails);
   header('Location: ../frontend/login.php');

}
exit();
