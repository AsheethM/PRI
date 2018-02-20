<?php

require_once("../Shared/connect_db.php");

$response = array();

$transaction_id = $_POST["transaction_id"];
$customer_id = $POST["client_id"];

$sql = $pdo->prepare("UPDATE transaction SET status = 7 WHERE id = ?");
$sql->bindParam(1, $transaction, PDO::PARAM_STR);

if ($sql->execute()){
	$response["success"] = true;
	$response["message"] = "Query cancel_order".$transaction_id.": OK";
}
else {
	$response["success"] = false;
	$response["message"] = "Query cancel_order".$transaction_id.": KO";
}            

?>