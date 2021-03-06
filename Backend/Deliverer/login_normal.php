<?php
header('Content-Type: application/json');
require_once('../Shared/connexion.php');
$response = array();
$success = false;
$message = "";


if (isset($_POST['password']) && isset($_POST['email']))
{
    $password_md5 = md5($_POST["password"]);
    $email = $_POST['email'];

    $request = $pdo->prepare("select u.id as user_id from user u join deliverer d on u.id = d.id where u.email = ? AND u.password = ?");
    $request->bindParam(1, $email, PDO::PARAM_STR);
    $request->bindParam(2, $password_md5, PDO::PARAM_STR);

    if ($request->execute() && $request->rowCount() > 0)
    {
        $success = true;
        $message = "Connection OK";
        $response['results'] = $request->fetchAll();
    }
    else
    {
        $message = "COnnection KO";
    }
}
else
    $message = "Parameters Error";

$response['success'] = $success;
$response['message'] = $message;
echo json_encode($response);

?>