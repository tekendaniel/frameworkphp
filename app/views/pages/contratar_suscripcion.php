<?php require RUTA_APP . "/views/inc/head.php"; ?>

<div class="container d-block" >
        <div class="row d-flex justify-content-center">


        <div class="col-12 col-lg-6">
            <div class="card shadow border-0 animate__animated animate__slideInDown">
                <div class="card-body px-5 py-4">
                    <h5><b>Contratar Suscripción</b></h5> 
                    <form>
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
                            <select class="form-select bg-light">
                                <option value="1">Semanal</option>
                                <option value="1">Mensual</option>
                                <option value="1">Bimestral</option>
                                <option value="1">Semestral</option>
                                <option value="1">Anual</option>
   
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="proveedor" class="form-label">Duración</label>
                            <input type="email" class="form-control bg-light"  name="duracion">
                        </div>

                        <div class="col-12">
                            <label for="proveedor" class="form-label">Monto</label>
                            <input type="email" class="form-control bg-light" name="monto">
                        </div>

                        <div class="col-12">
                            <label for="proveedor" class="form-label">Tipo de moneda</label>
                            <select class="form-select bg-light">
                                <option value="1">Soles</option>
                                <option value="1">Dolares</option>
                            </select>
                        </div>

                        </div>
                    </form>
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
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                              1 día antes
                            </label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                              1 semana antes 
                            </label>
                          </div>
    
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                              1 mes antes 
                            </label>
                          </div>
                    </div>
                    
                </div>
            </div>

            <div class="col-12 d-grid gap-2">
                <button type="button" class="btn btn-primary btn-sm my-4">Guardar Proveedor</button>
            </div>

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
                                <option value="${el.IdSuscripcion }"> ${el.NombreSuscripcion}</option>

                                `;
                        })
                    }
                    
                
                })
                .catch(function (error) {
                    console.log(error);
                });
                }); 
            
           
          })
      </script>