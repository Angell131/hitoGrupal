<?php
    require_once("View/layout.php");
?>

<h2 style="position:absolute; margin-top: 100px">Entradas</h2>
<table class="table table-strip" style="position:absolute; margin-top: 150px">
    <thead>
        <tr>
            <th>ID</th>
            <th>Titulo</th>
            <th>Contenido</th>
            <th>Iagen</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
            $stmt = $conexion->prepare("SELECT * FROM entradas");
            $stmt->execute();
            $row = $stmt->fetchAll();
            foreach($row as $a){
                echo "<tr>";
                echo "<td>".$a['id']."</td>";
                echo "<td>".$a['titulo']."</td>";
                echo "<td>".$a['contenido']."</td>";
                echo '<td><img src="'.$a['imagen'].'" style="width: 200px"></td>';  
                echo '<td><button class="btn btn-danger" onclick="eliminar('.$a['id'].')">Eliminar</button></td>';
            }
        ?>
    </tbody>
    
</table>

<script>
    function eliminar(v) {
        axios({
            method: 'post',
            url: 'delete.php',
            data: {
                id: v
             }
                    }).then(function (response) {
                        let data = response.data;
                        window.location.reload();
             });
    }
</script>

<?php
    require_once("connection.php");
    $request_body = file_get_contents('php://input');
    $post = json_decode($request_body, true);
    $_POST = $post;
    $conexion = db::getConnect();
    if (isset($_POST['id'])) {
        $stmt = $conexion->prepare("DELETE from entradas where id = :id");
        $stmt->bindParam(':id', $_POST['id']);
        $stmt->execute();
    }

?>

