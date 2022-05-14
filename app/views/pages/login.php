<?php require RUTA_APP . "/views/inc/head.php"; ?>

<div class="container d-block">
  <div class="row d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="col-xl-3 col-md-7 col-sm-10">
      <div class="card shadow border-0 animate__animated animate__bounceIn">
        <div class="card-body p-4">
          <div class=" text-nowrap rounded-circle border border-white bg-primary bg-gradient d-block m-auto text-center text-white fw-bolder overflow-hidden" style="width: 150px; height: 150px; font-size: 120px;">
            G4
          </div>
          <h5 class="d-block text-center">Iniciar Sesión</h5>
          <div id="message-alert"></div>

          <form enctype="multipart/form-data" method="post" id="form_login">
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Email</label>
              <input type="text" name="email" class="form-control" id="campoEmail" aria-describedby="emailHelp" 
              required autocomplete="off">
              <div id="campoEmailFeedback" class="">
              </div>
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Contraseña</label>
              <input type="password" name="password" class="form-control" id="campoContraseña" required>
            </div>

            <input type="submit" class="btn btn-danger mx-auto d-block" id="btnLogin" disabled value="Iniciar Sesión">

          </form>
        </div>
      </div>

      <div class="card animate__animated animate__slideInRight mt-2">
        <div class="card-body p-0">
          <a href="<?php echo RUTA_URL . "login/registrarse" ?>" class="d-block p-2 text-center text-decoration-none">Registrar nuevo usuario</a>

        </div>
      </div>

    </div>
  </div>
</div>

<?php require RUTA_APP . "/views/inc/footer.php"; ?>