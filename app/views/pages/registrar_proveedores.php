<?php require RUTA_APP . "/views/inc/head.php"; ?>

<div class="col-md-5 col-sm-12 mx-auto">
<a href="<?php echo RUTA_URL . "proveedores" ?>" class="btn btn-primary my-3 btn-sm">Regresar a lista </a>
            <div class="card shadow-sm border-0 animate__animated animate__slideInDown">
                <div class="card-body p-4">
                    <h5><b>Agregar Proveedor</b></h5> 

                    <div id="message-alert"></div>  

                    <form enctype="multipart/form-data" method="post" id="form_proveedor">
                        <div class="row">
                        <div class="col-6">
                            <label for="proveedor" class="form-label">Nombre Proveedor <small class="fw-bold text-danger">* </small></label>
                            <input type="text" class="form-control bg-light" id="nombreproveedor" name="nombreproveedor" placeholder="">
                        </div>

                        <div class="col-6">
                            <label for="proveedor" class="form-label">Categoria <small class="fw-bold text-danger" >* </small></label>
                            <input type="text" class="form-control bg-light" id="categoria" name="categoria" placeholder="">
                        </div>

                        <div class="col-12">
                            <label for="proveedor" class="form-label">Descripción</label>
                            <input type="text" class="form-control bg-light" id="descripcion" name="descripcion" placeholder="">
                        </div>

                        <div class="col-12">
                            <label for="proveedor" class="form-label">Teléfono</label>
                            <input type="text" class="form-control bg-light" id="telefono" name="telefono" placeholder="">
                        </div>
                        <div class="col-12 mt-2">
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#addServices"><i class="fa-regular fa-square-plus"></i> Agregar Servicio </button>
                        </div>

                        <div class="px-2 py-4">
                            <table class="table table-sm" >
                            <thead>
                                <tr>
                                <th scope="col">Servicios</th>
                                <th scope="col">Precio</th>
                                <th scope="col"></th>
                                </tr>
                            </thead>

                                <tbody id="suscripcionesAdd"></tbody>
                            </table>

                        </div>
                        


                        <div class="col-12 d-grid gap-2">
                            <input type="submit" class="btn btn-primary my-2" value="Guardar Proveedor" />
                        </div>
                        </div>
                    </form>


                    

                </div>
            </div>
        </div>

          </div>
        </div>
      </div>



<!-- Modal -->
<div class="modal fade" id="addServices" tabindex="-1" aria-labelledby="addServices" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Servicio</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form enctype="multipart/form-data" method="post" id="form_suscripcion">
      <div class="modal-body">
     
        <div class="row">
        <div class="col-6">
            <label for="proveedor" class="form-label">Nombre del servicio</label>
            <input type="text" class="form-control bg-light" id="nombresuscripcion" name="nombresuscripcion" placeholder="">
        </div>

        <div class="col-6">
            <label for="proveedor" class="form-label">Precio</label>
            <input type="text" class="form-control bg-light" id="precio" name="precio" placeholder="">
        </div>

        <div class="col-12">
            <label for="proveedor" class="form-label">Descripción</label>
            <input type="text" class="form-control bg-light" id="descripcion" name="descripcion" placeholder="">
        </div>
       
        </div>
    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <input type="submit" class="btn btn-primary" value="Guardar" />
      </div>
      </form>
    </div>
  </div>
</div>




<?php require RUTA_APP . "/views/inc/footer.php"; ?>


<script>
        /************************************************************************ */

        let formProveedor = document.getElementById("form_proveedor");

        let suscripciones = [];

       

        

        //Add Suscripcion a proveedor
        let formSusProv = document.getElementById("form_suscripcion");

        if(formSusProv){

            formSusProv.addEventListener("submit", event => {

                event.preventDefault();
                let onForm = new FormData(formSusProv);

                suscripciones.push({
                    "nombresuscripcion": onForm.get("nombresuscripcion") ,
                    "precio": onForm.get("precio"),
                    "descripcion": onForm.get("descripcion")
                });


                console.log(suscripciones)
                suscripcionesAdd.innerHTML = '';
                suscripciones.forEach( item => {
                    
                    suscripcionesAdd.innerHTML += `
                        <tr>
                            <td>${item.nombresuscripcion}</td>
                            <td>s/. ${formatoMoneda(item.precio)}</td>
                            <td>@</td>
                        </tr>
                        `;


                        

                });
                

                formSusProv.reset();

            })

        }


        if(formProveedor){
            
         formProveedor.addEventListener("submit", event =>{
                event.preventDefault();
                
                let onDataProveedor = new FormData(formProveedor);
                onDataProveedor.append("suscripciones", JSON.stringify(suscripciones) );
               
                axios({
                    method: 'post',
                    url: 'http://localhost/sistemaweb/proveedores/createProveedor',
                    data: onDataProveedor,
                    headers: { "Content-Type": "multipart/form-data" },
                    })         
                    .then(function (response) {
                    
                    if(response.data.content){

                        let resultado = response.data.content;

                        formProveedor.reset();
                        suscripciones =[];
                        suscripcionesAdd.innerHTML = "";

                        location.href ="http://localhost/sistemaweb/proveedores";

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
</script>