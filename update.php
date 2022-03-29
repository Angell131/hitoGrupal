<?php
require_once("connection.php");
$request_body = file_get_contents('php://input');
$post = json_decode($request_body, true);
$_POST = $post;
$conexion = db::getConnect();
if (isset($_POST['contenido'])) {
    $stmt = $conexion->prepare("UPDATE entradas SET contenido = :contenido where id = :id");
    $stmt->bindParam(':contenido', $_POST['contenido']);
    $stmt->bindParam(':id', $_POST['id']);
    $stmt->execute();
    echo $_POST['contenido'];
}
if (isset($_POST['titulo'])) {
    $stmt = $conexion->prepare("UPDATE entradas SET titulo = :titulo where id = :id");
    $stmt->bindParam(':titulo', $_POST['titulo']);
    $stmt->bindParam(':id', $_POST['id']);
    $stmt->execute();
    echo $_POST['titulo'];
}

if (isset($_POST['imagen'])) {
    $stmt = $conexion->prepare("UPDATE entradas SET imagen = :imagen where id = :id");
    $stmt->bindParam(':imagen', $_POST['imagen']);
    $stmt->bindParam(':id', $_POST['id']);
    $stmt->execute();
    echo $_POST['imagen'];
}
    