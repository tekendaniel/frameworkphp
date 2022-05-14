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
                    <input type="text" class="form-control" name="nombres" id="nombresRegistro" autocomplete="off">
                    <small id="NombreRegistrofeedback"> </small>

                    </div>
                    
                    <div class="col-6 mb-3">
                    <label for="apellidos" class="form-label">Apellidos:</label>
                    <input type="text" name="apellidos" class="form-control" autocomplete="off" id="apellidoRegistro">
                    <small id="ApellidoRegistrofeedback"> </small>
                    </div>

                    <div class="col-6 mb-3">
                    <label for="dni" class="form-label">DNI:</label>
                    <input type="text" name="dni" class="form-control" id="dniRegistro" autocomplete="off">
                    <small id="DniRegistrofeedback"> </small>
                    </div>

                    <div class="col-6 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="emailRegistro"  autocomplete="off">
                    <small id="emailRegistrofeedback"></small>

                    </div>

                    <div class="col-6 mb-3">
                    <label for="contraseña_first" class="form-label">Contraseña</label>
                    <input type="password" name="contraseña_first" class="form-control" id="contraseña_first" autocomplete="off">
                    <small id="contraseñaFirstRegistrofeedback"></small>
                    </div>

                    <div class="col-6 mb-3">
                    <label for="contraseña" class="form-label">Confirmar Contraseña</label>
                    <input type="password" name="contraseña_confirm" class="form-control" id="contraseña_validateRegistro">
                    <small id="contraseñaValidateRegistrofeedback"></small>
                    </div>
                    
                    <input type="submit" id="BtnRegistrarUser" class="btn btn-primary mx-auto d-block" value="Registrar">

                </form>
                </div>
            </div>

            <div class="card animate__animated animate__slideInRight mt-2">
              <div class="card-body p-0">
              <a href="<?php echo RUTA_URL . "login" ?>" class="d-block p-2 text-center text-decoration-none">Ya tengo usuario</a>

              </div>
            </div>


          </div>



        </div>
 </div>



 <?php require RUTA_APP . "/views/inc/footer.php"; ?>


 <script>
   /********************************************************************************* */
        /* VALIDAR REGISTRO DE USUARIO */


        var validaForm = false;

        var BtnRegistrarUser = document.getElementById('BtnRegistrarUser');
        var dniRegistro = document.getElementById('dniRegistro');

        var dniAlert = document.getElementById('dniAlert')

        var emailRegistro = document.getElementById('emailRegistro')

        var emailAlert = document.getElementById('emailAlert')


        var nombresRegistro = document.getElementById('nombresRegistro')


        var apellidoRegistro = document.getElementById('apellidoRegistro')


        var contraseña_first = document.getElementById('contraseña_first')


        dniRegistro.addEventListener('keyup', event =>{


                if(dniRegistro.value.length == 8)
                {
                    dniRegistro.classList.add('is-valid')
                    dniRegistro.classList.remove('is-invalid')
                    DniRegistrofeedback.classList.add('valid-feedback')
                    DniRegistrofeedback.classList.remove('invalid-feedback')
                    DniRegistrofeedback.innerText = ""
                    validaForm = true
                }
                else{
                    dniRegistro.classList.remove('is-valid')
                    dniRegistro.classList.add('is-invalid')
                    DniRegistrofeedback.classList.add('invalid-feedback')
                    DniRegistrofeedback.innerText = "DNI 8 dígitos"
                    validaForm = false

                }

        })

        emailRegistro.addEventListener('keyup', event =>{

    
                if(validateEmail(emailRegistro.value)){
                    emailRegistro.classList.add('is-valid')
                    emailRegistro.classList.remove('is-invalid')
                    emailRegistrofeedback.classList.add('valid-feedback')
                    emailRegistrofeedback.classList.remove('invalid-feedback')
                    emailRegistrofeedback.innerHTML = ""

                    validaForm = true


                }else{
                    emailRegistro.classList.remove('is-valid')
                    emailRegistro.classList.add('is-invalid')
                    emailRegistrofeedback.classList.remove('valid-feedback')
                    emailRegistrofeedback.classList.add('invalid-feedback')
                    emailRegistrofeedback.innerHTML = "Email no valido"
                    validaForm = false
                }
            
        })


        nombresRegistro.addEventListener('keyup', event =>{

            if(nombresRegistro.value.length <= 3){
                nombresRegistro.classList.add('is-invalid')
                NombreRegistrofeedback.classList.add('invalid-feedback')
                NombreRegistrofeedback.innerText = "Min 4 caracteres"
                validaForm = false
            }else{
                validaForm = true
                nombresRegistro.classList.remove('is-invalid')
                nombresRegistro.classList.add('is-valid')
                NombreRegistrofeedback.classList.remove('invalid-feedback')
                NombreRegistrofeedback.classList.add('valid-feedback')
                NombreRegistrofeedback.innerText = ""
            }

        })

        apellidoRegistro.addEventListener('keyup', event => {

            if(apellidoRegistro.value.length <= 5){
                apellidoRegistro.classList.add('is-invalid')
                ApellidoRegistrofeedback.classList.add('invalid-feedback')
                ApellidoRegistrofeedback.innerHTML = "Min 5 caracteres!"
                validaForm = true

            }else{
                apellidoRegistro.classList.remove('is-invalid')
                apellidoRegistro.classList.add('is-valid')
                ApellidoRegistrofeedback.classList.remove('invalid-feedback')
                ApellidoRegistrofeedback.classList.add('valid-feedback')
                ApellidoRegistrofeedback.innerText = ""
                validaForm = false

            }
        })



        contraseña_first.addEventListener('keyup', event =>{

            if(contraseña_first.value.length >= 8){
                contraseña_first.classList.add('is-valid')
                contraseña_first.classList.remove('is-invalid')
                contraseñaFirstRegistrofeedback.classList.add('valid-feedback')
                contraseñaFirstRegistrofeedback.innerHTML = ""
            }else{
                contraseña_first.classList.remove('is-valid')
                contraseña_first.classList.add('is-invalid')
                contraseñaFirstRegistrofeedback.classList.remove('valid-feedback')
                contraseñaFirstRegistrofeedback.classList.add('invalid-feedback')
                contraseñaFirstRegistrofeedback.innerHTML = "Min 8 - 14 dígitos"
            }

        })


        contraseña_validateRegistro.addEventListener('keyup', event =>{


                if(contraseña_first.value == contraseña_validateRegistro.value){
                    contraseña_validateRegistro.classList.add('is-valid')
                    contraseña_validateRegistro.classList.remove('is-invalid')
                    contraseñaValidateRegistrofeedback.classList.add('valid-feedback')
                    contraseñaValidateRegistrofeedback.innerHTML = ""
                }else{
                    contraseña_validateRegistro.classList.remove('is-valid')
                    contraseña_validateRegistro.classList.add('is-invalid')
                    contraseñaValidateRegistrofeedback.classList.remove('valid-feedback')
                    contraseñaValidateRegistrofeedback.classList.add('invalid-feedback')
                    contraseñaValidateRegistrofeedback.innerHTML = "La contraseña no coincide"

                }

           
        })

        /********************************************************************************* */


        let formRegister = document.getElementById("form_registro");

        if(formRegister){

            formRegister.addEventListener("submit", event =>{
                event.preventDefault();


                if(!validaForm){ 
                    
                    swal({
                        title: "Se debe validar todos los campos",
                        icon : "error"
                    })
                    
                    return}



                let oForm = new FormData(formRegister);     
                axios({
                    method: 'post',
                    url: 'http://localhost/sistemaweb/login/createUser',
                    data: oForm,
                    headers: { "Content-Type": "multipart/form-data" },
                    })         
                    .then(function (response) {
                    
                    if(response.data.content){
                        window.location.href = "/sistemaweb/";
                    }else{
                        document.getElementById("message-alert").innerHTML = response.data.message;
                    }
                    
                    console.log(response);
                })
                .catch(function (error) {
                    console.log(error);
                });

            })

        }

 </script>