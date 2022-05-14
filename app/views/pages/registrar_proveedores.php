<?php require RUTA_APP . "/views/inc/head.php"; ?>

<div class="container">

    <div class="row">

        <div class="col-md-5 mx-auto">
            <form enctype="multipart/form-data" method="post" id="form_proveedor">
                <div class="card shadow-sm border-0 animate__animated animate__slideInDown">
                    <div class="card-body">
                        <h5><b>Agregar Proveedor</b></h5>
                        <div id="message-alert"></div>

                        <div class="row">
                            <div class="col-6">
                                <label for="proveedor" class="form-label">Nombre Proveedor <small class="fw-bold text-danger">* </small></label>
                                <input type="text" class="form-control bg-light" id="nombreproveedor" name="nombreproveedor" placeholder="">
                            </div>

                            <div class="col-6">
                                <label for="proveedor" class="form-label">Categoria <small class="fw-bold text-danger">* </small></label>
                                <input type="text" class="form-control bg-light" id="categoria" name="categoria" placeholder="">
                            </div>

                            <div class="col-8">
                                <label for="proveedor" class="form-label">Descripción</label>
                                <input type="text" class="form-control bg-light" id="descripcion" name="descripcion" placeholder="">
                            </div>

                            <div class="col-4">
                                <label for="proveedor" class="form-label">Teléfono</label>
                                <input type="text" class="form-control bg-light" id="telefono" name="telefono" placeholder="">
                            </div>

                        </div>


                    </div>
                </div>


                <div class="card shadow-sm mx-auto my-2 border-0">
                    <div class="card-body">
                        <h6 class="card-title">Agregar Servicios</h6>
                        <form enctype="multipart/form-data" method="post" id="form_suscripcion">
                            <div class="row">
                                <div class="col-md-7">
                                    <label for="nombreServicio" class="form-label">Nombre del servicio</label>
                                    <input type="text" class="form-control bg-light is-invalid" id="nombreservicio" name="nombreservicio" required>
                                </div>

                                <div class="col-md-5">
                                    <label for="proveedor" class="form-label">Precio</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">S/.</span>
                                        <input type="text" class="form-control" id="precioservicio" name="precioservicio">
                                        <span class="input-group-text">.00</span>
                                    </div>
                                
                                </div>
                                <div class="col-12 pt-2 d-flex justify-content-center">
                                    <input type="submit" class="btn btn-primary btn-sm" value="Guardar" />
                                </div>

                            </div>

                        </form>
                        <div class="px-2 py-0">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th scope="col">Servicios</th>
                                        <th scope="col">Precio</th>
                                    </tr>
                                </thead>

                                <tbody id="suscripcionesAdd"></tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <div class="card">
                    <div class="card-body">
                        <div class="col-12 d-grid gap-2">
                            <input type="submit" class="btn btn-primary my-2" value="Guardar Proveedor" />
                        </div>
                    </div>
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

    if (formSusProv) {

        formSusProv.addEventListener("submit", event => {

            event.preventDefault();
            let onForm = new FormData(formSusProv);

            suscripciones.push({
                "nombresuscripcion": onForm.get("nombreservicio"),
                "precio": onForm.get("precioservicio"),
                "descripcion": onForm.get("descripcion")
            });


            console.log(suscripciones)
            suscripcionesAdd.innerHTML = '';
            suscripciones.forEach(item => {

                suscripcionesAdd.innerHTML += `
                        <tr>
                            <td>${item.nombresuscripcion}</td>
                            <td>s/. ${formatoMoneda(item.precio)}</td>
                        </tr>
                        `;




            });


            formSusProv.reset();

        })

    }


    if (formProveedor) {

        formProveedor.addEventListener("submit", event => {
            event.preventDefault();

            let onDataProveedor = new FormData(formProveedor);
            onDataProveedor.append("suscripciones", JSON.stringify(suscripciones));

            axios({
                    method: 'post',
                    url: 'http://localhost/sistemaweb/proveedores/createProveedor',
                    data: onDataProveedor,
                    headers: {
                        "Content-Type": "multipart/form-data"
                    },
                })
                .then(function(response) {

                    if (response.data.content) {

                        let resultado = response.data.content;

                        formProveedor.reset();
                        suscripciones = [];
                        suscripcionesAdd.innerHTML = "";

                        location.href = "http://localhost/sistemaweb/proveedores";

                    } else {
                        document.getElementById("message-alert").innerHTML = response.data.message;
                    }

                    console.log(response);
                })
                .catch(function(error) {
                    console.log(error.data);
                });

        });
    }
</script>