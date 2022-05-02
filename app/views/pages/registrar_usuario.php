<?php require RUTA_APP . "/views/inc/head.php"; ?>

<div class="container d-block" >
        <div class="row d-flex justify-content-center align-items-center" style="height: 100vh;">
          <div class="col-xl-4 col-md-7 col-sm-10">
            <div class="card shadow border-0 animate__animated animate__bounceIn">
                <div class="card-body p-4">
                <div class=" text-nowrap rounded-circle border border-white bg-primary bg-gradient d-block m-auto text-center text-white fw-bolder overflow-hidden" 
                style="width: 150px; height: 150px; font-size: 120px;">
                  G4
                </div>
                <h5 class="d-block text-center">Registrar Usuario</h5>
                <div id="message-alert"></div>
                <form class="row" enctype="multipart/form-data" method="post" id="form_registro">
                  
                    <div class="col-6 mb-3">
                    <label for="nombres" class="form-label">Nombres:</label>
                    <input type="text" class="form-control" name="nombres" id="nombres" aria-describedby="emailHelp">
                    </div>
                    
                    <div class="col-6 mb-3">
                    <label for="apellidos" class="form-label">Apellidos:</label>
                    <input type="text" name="apellidos" class="form-control" id="apellidos">
                    </div>

                    <div class="col-6 mb-3">
                    <label for="dni" class="form-label">DNI:</label>
                    <input type="text" name="dni" class="form-control" id="dni">
                    </div>

                    <div class="col-6 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
                    </div>

                    <div class="col-6 mb-3">
                    <label for="contraseña_first" class="form-label">Contraseña</label>
                    <input type="password" name="contraseña_first" class="form-control" id="contraseña_first">
                    </div>
                    <div class="col-6 mb-3">
                    <label for="contraseña" class="form-label">Confirmar Contraseña</label>
                    <input type="password" name="contraseña_confirm" class="form-control" id="contraseña">
                    </div>
                    
                    <input type="submit" class="btn btn-primary mx-auto d-block" value="Registrar">

                </form>
                </div>
            </div>
          </div>
        </div>
 </div>



 <?php require RUTA_APP . "/views/inc/footer.php"; ?>