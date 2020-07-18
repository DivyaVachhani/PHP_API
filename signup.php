<?php

include_once 'connection.php';
include_once 'user.php';

$database = new Database;
$db = $database->getConnection();

$user = new User($db);

$user->name = $_POST['name'];
$user->email = $_POST['email'];
$user->password = base64_encode($_POST['password']);


if($user->signup()){

	$user_array = array(
		"status" => true,
		"message" => "Successfully SignUp.",
		"id" => $user->id,
		"email" => $user->email
	);
}else{

	$user_array = array(
		"status" => false,
		"message" => "User already exist.",
	);
}
print_r(json_encode($user_array));
?>











