<?php require RUTA_APP . "/views/inc/head.php"; ?>



<div class="container">

    <div class="row">
        <div class="col-12">
            <div class="card cabeceraBg">
                <div class="card-body py-5">
                    <div class="row">
                        <div class="col-4">

                            <div class="rounded-circle border border-white bg-primary bg-gradient d-block m-auto text-center text-white fw-bolder overflow-hidden" style="width: 150px; height: 150px; font-size: 100px;">
                                <?php echo $user ? Util::InitialsName($user['Nombre'], $user['Apellidos']) : ""; ?>
                            </div>
                            <div class="pt-2 d-block text-center ">
                                <p class="h5"><?php echo $user ? $user['Nombre'] . " " . $user['Apellidos'] : ""; ?></p>
                                <small> <?php echo $user ? $user['Email'] : ""; ?></small>
                            </div>

                        </div>

                        <div class="col-8 d-flex flex-column justify-content-center">
                            <span><b>Bienvenido</b></span>
                            <h5 class="display-6">Sistema de Recordatorios<br> de Pagos</h5>
                            <p>Organiza, y crea alertas de recordatorio de pagos</p>
                        </div>
                    </div>
                </div>
            </div>



        </div>


        <div class="col-12 mt-3">
            <div class="card shadow">
                <div class="card-body py-4">
                    <div class="d-block text-center"> 
                        <h5 class="display-6">Categorías</h5> 
                        <small>Ingresa a una sección </small>
                    </div>
                    
                    <hr>
                    <div class="categories-colors-container">
                        <div class="categories-items">
                            <div class="categories-item category-green">
                                <div class="category-bagde">
                                    <i class="fa-solid fa-calendar-plus fs-1"></i>
                                </div>
                                <div class="category-namecategory">
                                    <h2>Recordatorios</h2>
                                    <span>Agregados por el usuario</span>
                                </div>
                                <a href="<?php echo RUTA_URL . "suscripciones" ?>"></a>
                            </div>

                            <div class="categories-item category-violet">
                                <div class="category-bagde">
                                    <i class="fa-solid fa-address-book fs-1"></i>
                                </div>
                                <div class="category-namecategory">
                                    <h2>Proveedores</h2>
                                    <span>Lista completa</span>
                                </div>
                                <a href="<?php echo RUTA_URL . "proveedores" ?>"></a>
                            </div>

                            <div class="categories-item category-red">
                                <div class="category-bagde">
                                    <i class="fa-solid fa-calendar-days fs-1"></i>
                                </div>
                                <div class="category-namecategory">
                                    <h2>Calendario</h2>
                                    <span>Registro de pagos</span>
                                </div>
                                <a href="<?php echo RUTA_URL . "calendario" ?>"></a>
                            </div>
                            <!--
                            <div class="categories-item category-magenta category-center">
                                <div class="category-bagde">
                                    <i class="material-icons">touch_app</i>
                                </div>
                                <div class="category-namecategory">
                                    <h2>Postula</h2>
                                    <span>Aplica de inmediato</span>
                                </div>
                                <a href="hostlibre.ml"></a>
                            </div>
                            -->
                        </div>
                    </div>
                </div>
            </div>

           


        </div>
    </div>

</div>

<?php require RUTA_APP . "/views/inc/footer.php"; ?>

<style scoped>

    .cabeceraBg{
        background-image: url('<?php echo RUTA_URL . "public/img/backgroundcabecera.png" ?>');
        background-position: right;
        background-repeat: no-repeat;
        background-size:30%;
    }

</style>