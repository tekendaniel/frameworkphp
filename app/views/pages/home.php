<?php require RUTA_APP . "/views/inc/head.php"; ?>



<div class="container d-block" >
        <div class="row d-flex justify-content-center" >
        
          <div class="col-xl-7 col-md-10 col-sm-12">


            <div class="card shadow-sm border-0 animate__animated animate__zoomIn">
                <div class="card-body p-4">
                     <div class="row">
                        <div class="col-2">
                             <div class="d-flex justify-content-center align-items-center rounded-circle bg-warning" style="width: 80px; height: 80px;">
                                <i class="fa-solid fa-stopwatch fs-1 text-white"></i>
                            </div>   
                        </div>
                        <div class="col-8">
                            <div>
                                <small><b>Monto a pagar: 70 soles</b></small>
                                <h4 class="d-block fw-light">Plan Internet 50Mbps</h4>
                                <small><b>Fecha de Pago: Jueves 10 de marzo del 2022</b></small>
                            </div>
                        </div>
                        <div class="col-2 ">
                            <button type="button" class="btn btn-danger btn-sm rounded-pill"><i class="fa-regular fa-trash-can"></i> </button>
                            <button type="button" class="btn btn-primary btn-sm rounded-pill"><i class="fa-solid fa-pen-to-square"></i> </button>
                        </div>
                     </div>
                        <hr>
                     <div class="row mt-4">
                        <div class="col-2">
                             <div class="d-flex justify-content-center align-items-center rounded-circle bg-warning" style="width: 80px; height: 80px;">
                                <i class="fa-solid fa-stopwatch fs-1 text-white"></i>
                            </div>   
                        </div>
                        <div class="col-8">
                            <div>
                                <small><b>Monto a pagar: 90 soles</b></small>
                                <h4 class="d-block fw-light">Cable Premium</h4>
                                <small><b>Fecha de Pago: Viernes 11 de marzo del 2022</b></small>
                            </div>
                        </div>
                        <div class="col-2 ">
                            <button type="button" class="btn btn-danger btn-sm  rounded-pill"><i class="fa-regular fa-trash-can"></i> </button>
                            <button type="button" class="btn btn-primary btn-sm rounded-pill"><i class="fa-solid fa-pen-to-square"></i> </button>
                        </div>
                     </div>

                </div>
            </div>


            <div class="card shadow-sm border-0 mt-4 animate__animated animate__zoomIn animate__delay-1s">
                <div class="card-body p-4">
                    
                    <div class="d-flex justify-content-between">
                            <h5>Suscripciones Contratadas</h5>
                        <a href="<?php echo RUTA_URL . "proveedores" ?>" class="btn btn-primary btn-sm mx-1 rounded-pill"><i class="fa-solid fa-bars-staggered"></i> Proveedores</a>
                    
                        <a href="<?php echo RUTA_URL . "suscripciones" ?>" class="btn btn-primary btn-sm mx-1 rounded-pill"><i class="fa-solid fa-circle-plus"></i> Contratar Suscripción</a>
                     
                    </div>
                    
                    <table class="table table-striped mt-3">
                        <thead>
                            <tr>
                                <th scope="col">Descripción</th>
                                <th scope="col">Proveedor</th>
                                <th scope="col">Ciclo</th>
                                <th scope="col">Pago</th>
                                <th scope="col">Inicio</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>Plan Internet 50Mbps</td>
                                <td>Movistar</td>
                                <td>Mensual</td>
                                <td>70.00</td>
                                <td>02/02/2022</td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm rounded-pill"><i class="fa-regular fa-trash-can"></i> </button>
                                    <button type="button" class="btn btn-primary btn-sm rounded-pill"><i class="fa-solid fa-pen-to-square"></i> </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Cable premium</td>
                                <td>XCableTv</td>
                                <td>Mensual</td>
                                <td>90.00</td>
                                <td>12/12/2021</td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm rounded-pill"><i class="fa-regular fa-trash-can"></i> </button>
                                    <button type="button" class="btn btn-primary btn-sm rounded-pill"><i class="fa-solid fa-pen-to-square"></i> </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Plan Postpago</td>
                                <td>Claro</td>
                                <td>Mensual</td>
                                <td>30.00</td>
                                <td>20/08/2021</td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm rounded-pill"><i class="fa-regular fa-trash-can"></i> </button>
                                    <button type="button" class="btn btn-primary btn-sm rounded-pill"><i class="fa-solid fa-pen-to-square"></i> </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Servicio Eléctrico</td>
                                <td>Enosa</td>
                                <td>Mensual</td>
                                <td>80.00</td>
                                <td>18/03/2021</td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm rounded-pill"><i class="fa-regular fa-trash-can"></i> </button>
                                    <button type="button" class="btn btn-primary btn-sm rounded-pill"><i class="fa-solid fa-pen-to-square"></i> </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Servicio de Agua</td>
                                <td>EPS - Grau</td>
                                <td>Mensual</td>
                                <td>19.20</td>
                                <td>31/03/2022</td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm rounded-pill"><i class="fa-regular fa-trash-can"></i> </button>
                                    <button type="button" class="btn btn-primary btn-sm rounded-pill"><i class="fa-solid fa-pen-to-square"></i> </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>


          </div>
        </div>
      </div>


      <?php require RUTA_APP . "/views/inc/footer.php"; ?>

    