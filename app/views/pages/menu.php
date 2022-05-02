<?php

  require_once(RUTA_APP . '/helpers/Util.php');

  $user = Session::IsExist("usuarioLogin") ? Session::getSession("usuarioLogin"): null;
  
  if($user):
?>

<nav class="navbar navbar-light bg-light mb-3">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="/sistemaweb/">
    <div class="rounded-circle border border-white bg-primary bg-gradient d-inline-block m-auto text-center text-white fw-bolder overflow-hidden" 
    style="width: 50px; height: 50px; font-size: 40px;">
      G4
    </div>
     <span class="mx-2"> Grupo 4</span>
    
    </a>

    <button type="button" class="btn bg-primary bg-gradient text-white btn-sm rounded-circle fs-3"
    data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample"
      style="height: 50px; width:50px;"> 
          <small> <?php echo $user ? Util::InitialsName($user['Nombre'], $user['Apellidos']) : ""; ?></small> 
        </button>

  </div>
</nav>
<?php endif; ?>



<div class="offcanvas offcanvas-end" data-bs-backdrop="true" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-header">
       <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
  <div class="rounded-circle border border-white bg-primary bg-gradient d-block m-auto text-center text-white fw-bolder overflow-hidden" 
  style="width: 150px; height: 150px; font-size: 120px;">
 <?php echo $user ? Util::InitialsName($user['Nombre'], $user['Apellidos']) : ""; ?>
  </div>
  <span class="fs-4 d-block text-center"><?php echo $user ? $user['Nombre'] . " " .  $user['Apellidos']: ""; ?> </h6></span>
  <div class="container">
      <ul class="list-group list-group-flush mx-4">
            <li class="list-group-item">
              <a href="#" class="text-decoration-none text-dark"> <i class="d-inline-block p-2 rounded-circle bg-primary fa-regular fa-user text-white"></i>  Mi Perfil</a>
          </li>
            <li class="list-group-item">
              <a id="CloseSesion" href="<?php echo RUTA_URL . "login/SignOff" ?>" class="text-decoration-none text-dark"> <i class="d-inline-block p-2 rounded-circle bg-primary text-white fa-solid fa-power-off"></i> Cerrar Sesión</a>
            </li>
   
    </ul>
  </div>
    
  </div>
</div>