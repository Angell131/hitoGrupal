<?php
    require_once("View/layout.php");
    if (isset($_SESSION['usuario'])){
        header('Location: index.php');
    }
?>


<section class="vh-100" style="position: absolute; z-index: -15 !important; width:100%">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100" style=" margin-left: 4px !important ;width: 100% !important;margin-right: 0px !important ;margin-top: -5% !important">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4"> ¿Quién eres? </p>

                <form class="mx-1 mx-md-4" method="post" action="login.php">

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="usuario" required>
                    <label for="floatingInput">Nombre de usuario</label>
                    </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="floatingInput" placeholder="name@example.com" name="password" required>
                    <label for="floatingInput">Contraseña</label>
                    </div>
                 <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button type="submit" class="btn btn-primary btn-lg" name="registrar" value="1">Iniciar Sesion</button>
                  </div>   
                </form>
                
</section>

<?php
    if (isset($_POST["usuario"]) && isset($_POST["password"])&& $_POST["usuario"] != " " && $_POST["password"] != " ") {
        $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE username = :usuario AND password = :password");
        $stmt->bindValue('usuario', $_POST["usuario"]);
        $stmt->bindValue('password', $_POST["password"]);
        $stmt->execute();
        $row = $stmt->fetch();
        if ($row != False) {
          $_SESSION['usuario'] = $row['username'];
          header("Location: index.php");
        }else{
          echo '<p style="color: red;">Compruebe los datos y vuelve a intentarlo</p>';
        }
        

    }
?>