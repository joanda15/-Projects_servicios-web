<?php

// Conexion
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
if ($conexion->connect_error) {
    die("Conexion fallida: " . $conexion->connect_error);
}

// Datos

$id = isset($_POST['int_id']) ? $_POST['int_id'] : '';
$nombre = isset($_POST['txt_nombre']) ? $_POST['txt_nombre'] : '';
$apellido = isset($_POST['txt_apellido']) ? $_POST['txt_apellido'] : '';
$email = isset($_POST['txt_email']) ? $_POST['txt_email'] : '';
$direccion = isset($_POST['txt_direccion']) ? $_POST['txt_direccion'] : '';
$password = isset($_POST['int_password']) ? $_POST['int_password'] : '';

// Try, conexion a la DB, llamado DB con parametros, pasado Json, catch
try {

    $conexion = new PDO('mysql:host=localhost;port=3306;dbname=tiendas_jd', 'root', '');
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

    // echo json_encode('Conectado correctamente');
    $pdo = $conexion->prepare('INSERT INTO registro(id, nombre, apellido, email, direccion, password) VALUES(?,?,?,?,?,?)');
    $pdo->bindParam(1, $id);
    $pdo->bindParam(2, $nombre);
    $pdo->bindParam(3, $apellido);
    $pdo->bindParam(4, $email);
    $pdo->bindParam(5, $direccion);
    $pdo->bindParam(6, $password);
    $pdo->execute() or die(print($pdo->errorInfo()));

    echo json_encode('true');
} catch (PDOException $error) {
    echo $error->getMessage();
    die();
}