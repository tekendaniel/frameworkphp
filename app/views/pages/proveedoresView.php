<?php require RUTA_APP . "/views/inc/head.php"; ?>


<div class="container d-block">

    <div class="card ">
        <div class="card-body d-flex align-items-center justify-content-between">
            <div>
                <h5 class="display-6">Proveedores</h5>
                <span class="text-muted">Lista de proveedores registrados por el usuario</span>
            </div>
            <div>
                <a href="<?php echo RUTA_URL . 'proveedores/create' ?>" class="btn text-white" style="background-color:#6C3483;">Registrar Proveedor</a>
            </div>
        </div>
    </div>
    <div class="row mt-3 " data-masonry='{"percentPosition": true }'>

        <?php foreach ($datos as $el) : ?>

            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow mb-4 mb-lg-0">
                    <div class="card-body pb-0 d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h5 class="card-title"><b><?php echo $el['nombreproveedor'] ?></b></h5>
                            <div class="badge bg-info"><?php echo $el['categoria'] ?></div>
                            <small class="card-text d-block"><?php echo $el['descripcion'] ?></small>
                        </div>
                        <div class="rounded-circle d-flex justify-content-center align-items-center" style="height: 60px; width: 60px; background-color: #00A4D5;">
                            <i class="fa-solid fa-clipboard-list fs-1 text-white"></i>
                        </div>
                    </div>
                    <div class="card-body py-0 px-2">
                        <!---->
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th><small>Servicio</small></th>
                                    <th><small>Costo</small></th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($el['servicios'] as $se) : ?>
                                    <tr>
                                        <td><?php echo $se->nombresuscripcion ?></td>
                                        <td><?php echo $se->precio ?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <button style="height: 30px; width: 30px;" id="iconDeleteProvee" type="button" class="btn btn-danger btn-sm rounded-circle me-2" data-item="<?php echo $el['IdProveedor'] ?>"><i id="iconDeleteProveeChild" class="fa-regular fa-trash-can" data-item="<?php echo $el['IdProveedor'] ?>"></i></button>
                        <a style="height: 30px; width: 30px;" href="<?php echo RUTA_URL . "proveedores/edit/" . $el['IdProveedor'] ?>" class="btn btn-primary btn-sm rounded-circle" data-item="<?php echo $el['IdProveedor'] ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>




    </div>
</div>





<?php require RUTA_APP . "/views/inc/footer.php"; ?>


<script>
    window.addEventListener("load", (event) => {




        document.addEventListener('click', function(e) {

            /************************************************************************ */
            /* ELIMINAR UN PROVEEDOR Y SUS SERVICIOS */

            if (e.target && e.target.id == 'iconDeleteProvee' || e.target.id == 'iconDeleteProveeChild') {

                e.stopPropagation();
                var idProveedor = e.target.getAttribute('data-item');


                swal({
                        title: "Desea eliminar el proveedor?",
                        text: "Se borrará todos los registros!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {


                            axios({
                                    method: 'post',
                                    url: 'http://localhost/sistemaweb/proveedores/eliminarProveedor/' + idProveedor,
                                    headers: {
                                        "Content-Type": "multipart/form-data"
                                    },
                                })
                                .then(resp => {
                                    console.log(resp)
                                    location.href = "http://localhost/sistemaweb/proveedores";
                                })
                                .catch(err => {
                                    console.log(err)
                                })




                        }
                    });


            }
        })

    });
</script>