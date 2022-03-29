<?php
    require_once("View/layout.php");
?>

<script src="https://kit.fontawesome.com/d70d441cb5.js" crossorigin="anonymous"></script>
<section class="vh-100" style="position: absolute; z-index: -15 !important; width:100%">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100" style=" margin-left: 4px !important ;width: 100% !important;margin-right: 0px !important ;margin-top: -5% !important">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Crear entrada  !</p>

                <form class="mx-1 mx-md-4" method="post" action="add.php">

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="titulo">
                    <label for="floatingInput">Titulo</label>
                    </div>
                  <div class="form-floating" style="margin-bottom: 15px;">
                            <textarea name="contenido" class="form-control" cols="30" rows="10" placeholder="Leave a comment here" id="floatingTextarea" name="contenido"></textarea>
                            <label for="floatingTextarea">Contenido</label>
                        </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="url" required>
                    <label for="floatingInput">URL de la imagen</label>
                    </div>
                 <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button type="submit" class="btn btn-primary btn-lg" name="registrar" value="1">Añadir entrada</button>
                  </div> 
                </form>
                
</section>
<div style="width: 90%; z-index: 200; display:block; position: absolute; top:100px;  left: 25px">
<?php

if (isset($_POST['titulo'])) {
  try {
    foreach ($_POST as $a){
          if ($a == " ") {
            throw new Exception();
          }
        }
    $conexion = db::getConnect();

    $stmt = $conexion->prepare("INSERT INTO entradas (titulo, contenido, imagen, fecha) VALUES (:titulo, :contenido, :url, fechaHoy())");
    $stmt->bindParam(':contenido', $_POST['contenido']);
    $stmt->bindParam(':titulo', $_POST['titulo']);
    $stmt->bindParam(':url', $_POST['url']);
    $stmt->execute();

    echo '<p style="color: green;">La entrada ha sido añadida con exito!</p>';
  }catch(Exception $e){
    echo '<p style="color: red;">Compruebe los datos y vuelve a intentarlo'.$e.'</p>';
    
  }
    
  
}


?>
</div>