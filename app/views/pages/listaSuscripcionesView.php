<?php require RUTA_APP . "/views/inc/head.php"; ?>

<div class="container">
    <div class="card">
        <div class="card-body p-4 d-flex align-items-center justify-content-between">
            <div>
                <h5 class="display-6">Recordatorios</h5>
                <span>Lista de recordatorios registrados</span>
            </div>

            <div>
                <a href="<?php echo RUTA_URL . 'suscripciones/registrar' ?>" class="btn text-white" style="background-color:#2ECC71;">Agregar Recordatorio</a>
                <a href="<?php echo RUTA_URL . 'calendario' ?>" class="btn text-white" style="background-color:#F39C12;">Ver Calendario</a>
            </div>

        </div>

    </div>

    <?php
    if ($datos['contratos']) :
        foreach ($datos['contratos'] as $d) :
    ?>

            <div class="row mt-4"> 
                <div class="col-4">

                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3 d-flex justify-content-center align-items-center">
                                    <div class="justify-content-center rounded-circle align-items-center d-flex" style="width: 60px; height: 60px; background-color:#8E44AD;">
                                        <i class="fa-solid fa-star fs-1 text-white"></i>
                                    </div>
                                </div>
                                <div class="col-9 ps-0">
                                    <div>
                                        <div class="fw-ligh">Movistar</div>
                                        <h5 class="d-blockt"><?php echo $d->nombresuscripcion ?></h5>
                                        <small><b>Monto:</b> <?php echo $d->precio ?></small><br>
                                        <small><b>Fecha Inicio:</b> <?php echo $d->inicio ?></small><br>
                                        <small><b>Ciclo de Pago:</b> <?php echo $d->ciclo ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            <a class="btn btn-danger btn-sm rounded-circle d-flex align-items-center me-2" style="height: 30px; width: 30px;"><i class="fa-regular fa-trash-can"></i> </a>
                            <a class="btn btn-primary btn-sm rounded-circle d-flex align-items-center" style="height: 30px; width: 30px;"><i class="fa-solid fa-pen-to-square"></i> </a>
                        </div>
                    </div>

                </div>
            </div>



    <?php
        endforeach;
    endif;
    ?>

</div>








<?php require RUTA_APP . "/views/inc/footer.php"; ?>