<?php
session_start();
require_once '../conexao.php';
$id = $_GET["id"];
$email = $_GET["email"];
$query = "DELETE FROM users WHERE id='$id'";
$result = mysqli_query($conn, $query);
 // Definir Alerta - Operações (EDITAR) 
 if ($conn->affected_rows > 0) {
    $_SESSION["message"] = array(
        "content" => "The Admin with the email <b>" .  $email . "</b> was successfully deleted!",
        "type" => "success",
    );
} else {
    $_SESSION["message"] = array(
        "content" => "There was an error deleting the email <b>" . $email . "</b>!",
        "type" => "danger",
    );
}
header("location: listAdmin.php");
?>