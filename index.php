
<link rel="stylesheet" href="style.css">

<?php
require_once("View/layout.php");
?>

<style>
    header{
        position: relative !important;
    }
    #contenido{
        width: 100%;
    }
    #imagen{
        width: 25%;
        display: inline-block;
    }
    #imagen img{
        width: 100% !important;
    }
</style>

<div class="contenido">

<?php
if (isset($_SESSION['usuario'])) {
    if (isset($_GET['web'])) {
        $id = $_GET['web'];
        try {
            $stmt = $conexion->prepare("SELECT titulo, contenido, fecha, imagen FROM entradas WHERE id = :id");
            $stmt->bindValue("id", $id);
            $stmt->execute();
            foreach($stmt->fetchAll() as $a){
                echo('<div id="titulo"><h2>'.$a['titulo'].' <button type="button" onclick="editar(0)" class="btn btn-secondary">Editar</button></h2></div>');
                echo('<div id="contenido"><p>'.$a['contenido'].' <button type="button" onclick="editar(1)" class="btn btn-secondary">Editar</button></p></div>');
                echo('<div id="imagen"><img src="'.$a['imagen'].'" > <br><button type="button" onclick="editar(2)" class="btn btn-secondary"">Editar</button></div>');
            }
        } catch (Exception $e) {
            $stmt = $conexion->prepare("SELECT titulo, contenido, fecha, imagen FROM entradas WHERE id = 1");
            $stmt->execute();
            foreach($stmt->fetchAll() as $a){
                echo('<div id="titulo"><h2>'.$a['titulo'].' <button type="button" onclick="editar(0)" class="btn btn-secondary">Editar</button></h2></div>');
                echo('<div id="contenido"><p>'.$a['contenido'].' <button type="button" onclick="editar(1)" class="btn btn-secondary">Editar</button></p></div>');
                echo('<div id="imagen"><img src="'.$a['imagen'].'" > <br><button type="button" onclick="editar(2)" class="btn btn-secondary"">Editar</button></div>');
            }
        }
        
    }else{
        $stmt = $conexion->prepare("SELECT titulo, contenido, fecha, imagen FROM entradas WHERE id = 1");
        $stmt->execute();
        foreach($stmt->fetchAll() as $a){
            echo('<div id="titulo"><h2>'.$a['titulo'].' <button type="button" onclick="editar(0)" class="btn btn-secondary">Editar</button></h2></div>');
            echo('<div id="contenido"><p>'.$a['contenido'].' <button type="button" onclick="editar(1)" class="btn btn-secondary">Editar</button></p></div>');
            echo('<div id="imagen"><img src="'.$a['imagen'].'"> <br><button type="button" onclick="editar(2)" class="btn btn-secondary"">Editar</button></div>');
        }
        $_GET['web'] = 1;
    }
}else{
    if (isset($_GET['web'])) {
        $id = $_GET['web'];
        try {
            $stmt = $conexion->prepare("SELECT titulo, contenido, fecha, imagen FROM entradas WHERE id = :id");
            $stmt->bindValue("id", $id);
            $stmt->execute();
            foreach($stmt->fetchAll() as $a){
                echo("<h2>".$a['titulo']."</h2>");
                echo("<p>".$a['contenido']."</p>");
                echo('<img src="'.$a['imagen'].'">');
            }
        } catch (Exception $e) {
            $stmt = $conexion->prepare("SELECT titulo, contenido, fecha, imagen FROM entradas WHERE id = 1");
            $stmt->execute();
            foreach($stmt->fetchAll() as $a){
                echo("<h2>".$a['titulo']."</h2>");
                echo("<p>".$a['contenido']."</p>");
                echo('<img src="'.$a['imagen'].'">');
            }
        }
        
    }else{
        $stmt = $conexion->prepare("SELECT titulo, contenido, fecha, imagen FROM entradas WHERE id = 1");
        $stmt->execute();
        foreach($stmt->fetchAll() as $a){
            echo("<h2>".$a['titulo']."</h2>");
            echo("<p>".$a['contenido']."</p>");
            echo('<img src="'.$a['imagen'].'">');
        }
    }
}
// MODO ADMIN 

?>

</div>

<script>
    function editar(v) {
        if (v == 0) { 
            let h2 = document.getElementById('titulo').getElementsByTagName("h2")[0].childNodes[0].nodeValue;
            document.getElementById('titulo').innerHTML = `<input type="text" id="titulo-f" name="titulo" value="`+h2+`" class="form-control"><input type="submit" value="Guardar" class="btn btn-success" style="margin: 12px" onclick="guardar('titulo', <?php echo $_GET['web']; ?>)">`;
        }
        if (v == 1) { 
            let p = document.getElementById('contenido').getElementsByTagName("p")[0].childNodes[0].nodeValue;
            document.getElementById('contenido').innerHTML = `
                <textarea class="form-control" id="floatingTextarea2" style="height: 100%; width: 100%;">`+p+`</textarea><input type="submit" value="Guardar" class="btn btn-success" style="margin: 12px" onclick="guardar('contenido', <?php echo $_GET['web']; ?>)">
            `
        }
        if (v == 2) { 
            let img = document.getElementById('imagen').getElementsByTagName("img")[0].src;
            document.getElementById('imagen').innerHTML = `<input type="text" id="imagen-f" name="imagen" value="`+img+`" class="form-control"><input type="submit" value="Guardar" class="btn btn-success" style="margin: 12px" onclick="guardar('imagen', <?php echo $_GET['web']; ?>)">`;
            
        }
    }

    function guardar(v, i) {
        if (v == 'titulo') {
            v = document.getElementById('titulo-f').value;
            axios({
                    method: 'post',
                    url: 'update.php',
                    data: {
                      titulo: v,
                      id: i
                    }
                    }).then(function (response) {
                        let data = response.data;
                        document.getElementById('titulo').innerHTML = '<h2>' + data +' <button type="button" onclick="editar(0)" class="btn btn-secondary">Editar</button></h2>'
             });
        }
        if (v == 'contenido') {
            v = document.getElementById('floatingTextarea2').value;
            axios({
                    method: 'post',
                    url: 'update.php',
                    data: {
                      contenido: v,
                      id: i
                    }
                    }).then(function (response) {
                        let data = response.data;
                        document.getElementById('contenido').innerHTML = '<p>' + data +' <button type="button" onclick="editar(1)" class="btn btn-secondary">Editar</button></p>'
             });
        }
        if (v == 'imagen') {
            v = document.getElementById('imagen-f').value;
            axios({
                    method: 'post',
                    url: 'update.php',
                    data: {
                      imagen: v,
                      id: i
                    }
                    }).then(function (response) {
                        let data = response.data;
                        document.getElementById('imagen').innerHTML = '<img src="' + data +' "> <button type="button" onclick="editar(1)" class="btn btn-secondary">Editar</button></img>'
             });
        }
        
    }
</script>

