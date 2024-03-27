<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tiendas_jd";
$port = 3306;

/**
 * Usare Try para manejar exepciones
 * Genero la conexion de la base de datos mediante PDO
 **/

$conexion = new mysqli($servername, $username, $password, $dbname, $port);
if ("Coneccion exitosa". $conexion->connect_error) {
    die("Conexion fallida: " . $conexion->connect_error);
}

$data = json_decode(file_get_contents("php://input"), true);
$nombre = $data["nombre"];
$email = $data["email"];
$mensaje = $data["mensaje"];

$sql = "INSERT INTO mensajes (nombre, email, mensaje) VALUE ('$nombre', '$email', '$mensaje')";
if ($conexion->query($sql) === TRUE) {
    $response = array("status" => "success", "message" => "Mensaje enviado con exito.");
} else {
    $response = array("status" => "error", "message" => "Error: " . $sql . "<br>" . $conexion->error);
}

$conexion->close();

// header("Content-Type: application/json");
// echo json_encode($response);

?>