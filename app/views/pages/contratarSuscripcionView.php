<?php require RUTA_APP . "/views/inc/head.php"; ?>

<div class="container d-block" >
        <div class="row d-flex justify-content-center">


        <div class="col-12 col-lg-6">
            <div class="card shadow border-0 animate__animated animate__slideInDown">
                <div class="card-body px-5 py-4">
                <form enctype="multipart/form-data" action="POST" id="formContrato">
                    <h5><b>Contratar Suscripción</b></h5> 
                    <div id="message-alert"></div>  
                   
                        <div class="row">
                        <div class="col-12">
                            <label for="proveedor" class="form-label">Nombre Proveedor</label>
                            <select class="form-select bg-light" id="proveedoresSelect" name="idProveedor">

                            </select>
                        </div>

                        <div class="col-12">
                            <label for="proveedor" class="form-label">Servicios</label>
                            <select class="form-select bg-light" id="serviciosSelect" name="idServicio">

                            </select>
                        </div>

                        <div class="col-12">
                            <label for="proveedor" class="form-label">Inicio de Suscripción</label>
                            <input type="date" class="form-control bg-light" name="inicio">
                        </div>
                        <div class="col-12">
                            <label for="proveedor" class="form-label">Ciclo</label>
                            <select class="form-select bg-light" name="ciclo">
                                <option value="Semanal">Semanal</option>
                                <option value="Mensual">Mensual</option>
                                <option value="Bimestral">Bimestral</option>
                                <option value="Semestral">Semestral</option>
                                <option value="Anual">Anual</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="proveedor" class="form-label">Duración</label>
                            <input type="text" class="form-control bg-light"  name="duracion">
                        </div>

                        <div class="col-12">
                            <label for="proveedor" class="form-label">Tipo de moneda</label>
                            <select class="form-select bg-light">
                                <option value="1">Soles</option>
                                <option value="1">Dolares</option>
                            </select>
                        </div>
                        </div>
                    
                </div>
            </div>
        </div>
        

        <div class="col-12 col-lg-6">
            <div class="card shadow border-0 animate__animated animate__slideInUp">
                <div class="card-body">
                    <h5><b>Recordatorio</b></h5> 
                    <span class="d-block mb-2">Seleccione que periodo de tiempo desea recordar pagos: </span>
                    <div class="text-center">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="tiempoRecordatorio" value="1 día antes" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                              1 día antes
                            </label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="tiempoRecordatorio" value="1 semana antes" id="flexRadioDefault2" checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                              1 semana antes 
                            </label>
                          </div>
    
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="tiempoRecordatorio" value="1 mes antes" id="flexRadioDefault2" checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                              1 mes antes 
                            </label>
                          </div>
                    </div>
                    
                </div>
            </div>

            <div class="col-12 d-grid gap-2">
                <button type="submit" class="btn btn-primary btn-sm my-4">Contratar Suscripcion</button>
            </div>

            </form>
        </div>
        </div>
      </div>


      <?php require RUTA_APP . "/views/inc/footer.php"; ?>


      <script>
          window.addEventListener('load', event => {

            var proveedoresSelect = document.getElementById("proveedoresSelect");

            var serviciosSelect = document.getElementById("serviciosSelect");

            axios({
                    method: 'post',
                    url: 'http://localhost/sistemaweb/proveedores/listarProveedoresJson',
                    headers: { "Content-Type": "multipart/form-data" },
                    })         
                    .then(function (response) {
                    
                        var p = response.data.content;
                    if(response.data.content){

                        proveedoresSelect.innerHTML = "<option value='' disabled selected >Selecciona un proveedor </option>";

                        p.forEach( el => {
                            proveedoresSelect.innerHTML += 
                                `
                                <option value="${el.IdProveedor }"> ${el.Nombre}</option>

                                `;
                        })
                    }
                    
                
                })
                .catch(function (error) {
                    console.log(error);
                });


                proveedoresSelect.addEventListener("change", event =>{
                    event.preventDefault()

                    var IdProveedor = event.target.value
                    axios({
                    method: 'post',
                    url: 'http://localhost/sistemaweb/proveedores/listarServiciosJson/' + IdProveedor,
                    headers: { "Content-Type": "multipart/form-data" },
                    })         
                    .then(function (response) {
                    
                        var p = response.data.content;
                    if(response.data.content){

                        serviciosSelect.innerHTML = "<option value='' disabled selected>Selecciona un servicio </option>";

                        p.forEach( el => {
                            serviciosSelect.innerHTML += 
                                `
                                <option value="${el.IdSuscripcion }"> ${el.NombreSuscripcion}  -  S/. ${formatoMoneda(el.Pago)}</option>

                                `;
                        })

                    }
                    
                
                })
                .catch(function (error) {
                    console.log(error);
                });
                }); 




        /*Registrar contrato nuevo */


        var formContrato = document.getElementById("formContrato")


        if(formContrato){
            formContrato.addEventListener("submit", event =>{
                   event.preventDefault();
                   
                   let onDataContrato = new FormData(formContrato);
                  
                   axios({
                       method: 'post',
                       url: 'http://localhost/sistemaweb/contrato/crearContrato',
                       data: onDataContrato,
                       headers: { "Content-Type": "multipart/form-data" },
                       })         
                       .then(function (response) {
                       
                       if(response.data.content){
   
                           let resultado = response.data.content;
   
                           location.href ="http://localhost/sistemaweb";
   
                       }else{
                           document.getElementById("message-alert").innerHTML = response.data.message;
                       }
                       
                       console.log(response);
                   })
                   .catch(function (error) {
                       console.log(error.data);
                   });
   
               });
           
            }
        
            
           
          })
      </script>