<?php
header('Content-Type: application/json');
require_once('../Shared/connexion.php');
$response = array();
$success = false;
$message = "";

if (isset($_POST["user_id"]) && !empty($_POST["user_id"])
    && isset($_POST["phone"]) && !empty($_POST["phone"])
    && isset($_POST["licence"]) && !empty($_POST["licence"])
    && isset($_POST["vehicule"]) && !empty($_POST["vehicule"]))
{
    $user_id = $_POST["user_id"];
    $licence = ($_POST["licence"] === '2') ? 0 : 1;
    $phone = $_POST["phone"];
    $vehicule = $_POST["vehicule"];
    
    $req_str = "UPDATE user SET phone = ? WHERE id = ?";
    $request = $pdo->prepare($req_str);
    $request->bindParam(1, $phone);
    $request->bindParam(2, $user_id, PDO::PARAM_INT);
    if ($request->execute())
    {
        $req_str = "UPDATE deliverer SET licence = ? , vehicule = ? WHERE id = ?";
        $request = $pdo->prepare($req_str);
        $request->bindParam(1, $licence, PDO::PARAM_INT);
        $request->bindParam(2, $vehicule, PDO::PARAM_STR);
        $request->bindParam(3, $user_id, PDO::PARAM_INT);
        if ($request->execute()) {
            $success = true;
            $message = "Request Update Account : OK";
        }
        else
            $message = "Error On 2nd Request";
    }
    else
        $message = 'BDD Request did not work';
}
else
    $message = "Parameters Error";

$response["success"] = $success;
$response["message"] = $message;


echo json_encode($response);

?>