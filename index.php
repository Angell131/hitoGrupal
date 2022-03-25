
<link rel="stylesheet" href="style.css">

<?php

require_once("View/layout.php");
?>

<style>
    header{
        position: relative !important;
    }
</style>

<div class="contenido">

<?php

if (isset($_GET['web'])) {
    $id = $_GET['web'];
    $stmt = $conexion->prepare("SELECT titulo, contenido, fecha, imagen FROM entradas WHERE id = :id");
    $stmt->bindValue("id", $id);
    $stmt->execute();
    foreach($stmt->fetchAll() as $a){
        echo("<h2>".$a['titulo']."</h2>");
        echo("<p>".$a['contenido']."</p>");
        echo('<img src="'.$a['imagen'].'">');
    }
}

?>

</div>