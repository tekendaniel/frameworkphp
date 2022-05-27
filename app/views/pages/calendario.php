<?php require RUTA_APP . "/views/inc/head.php"; ?>


<div class="container">
    <div class="row">
        <div class="col-4">

            <!--Pagos Vencidos cards-->

            <div class="card">
                <div class="card-body">
                    <h5>Atrasado</h5>
                    <div class="row">
                        <div class="col-3 d-flex justify-content-center align-items-center">
                            <div class="justify-content-center rounded-circle align-items-center d-flex" style="width: 60px; height: 60px; background-color:#DD0C0C;">
                                <i class="fa-solid fa-exclamation fs-1 text-white"></i>
                            </div>
                        </div>
                        <div class="col-9 ps-0">
                            <div>
                                <div class="fw-ligh">Movistar</div>
                                <h5 class="d-blockt">Plan Internet 50Mbps</h5>
                                <small><b>Monto:</b> 70 soles</small><br>
                                <small><b>Fecha:</b> Jueves 10 de marzo del 2022</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




            <!--End Pagos vencidos cards-->




            <div class="card mt-2">
                <div class="card-body">
                    <!--Pagos por vencer cards-->
                    <h5 class="card-title">Por vencer</h5>

                    <div class="row">
                        <div class="col-3 d-flex justify-content-center align-items-center">
                            <div class="justify-content-center rounded-circle bg-warning align-items-center d-flex" style="width: 60px; height: 60px;">
                                <i class="fa-solid fa-stopwatch fs-1 text-white"></i>
                            </div>
                        </div>
                        <div class="col-9 ps-0">
                            <div>
                                <div class="fw-ligh">Movistar</div>
                                <h5 class="d-blockt">Plan Internet 50Mbps</h5>
                                <small><b>Monto:</b> 70 soles</small><br>
                                <small><b>Fecha:</b> Jueves 10 de marzo del 2022</small>
                            </div>
                        </div>

                        <!-------------->

                        <hr class="my-4">

                        <div class="col-3 d-flex justify-content-center align-items-center">
                            <div class="justify-content-center rounded-circle bg-warning align-items-center d-flex" style="width: 60px; height: 60px;">
                                <i class="fa-solid fa-stopwatch fs-1 text-white"></i>
                            </div>
                        </div>
                        <div class="col-9 ps-0">
                            <div>
                                <div class="fw-ligh">Movistar</div>
                                <h5 class="d-blockt">Plan Internet 50Mbps</h5>
                                <small><b>Monto:</b> 70 soles</small><br>
                                <small><b>Fecha:</b> Jueves 10 de marzo del 2022</small>
                            </div>
                        </div>

                    </div>

                    <!--End Pagos por vencer cards-->

                </div>
            </div>


            <!-------------->


            <div class="card mt-2">
                <div class="card-body">
                    <h5 class="card-title">Cumplidos</h5>


                    <div class="row">
                        <div class="col-3 d-flex justify-content-center align-items-center">
                            <div class="justify-content-center rounded-circle align-items-center d-flex" style="width: 60px; height: 60px; background-color:#58D68D;">
                                <i class="fa-solid fa-clipboard-check fs-1 text-white"></i>
                            </div>
                        </div>
                        <div class="col-9 ps-0">
                            <div>
                                <div class="fw-ligh">Movistar</div>
                                <h5 class="d-blockt">Plan Internet 50Mbps</h5>
                                <small><b>Monto:</b> 70 soles</small><br>
                                <small><b>Fecha:</b> Jueves 10 de marzo del 2022</small>
                            </div>
                        </div>

                        <!-------------->

                        <hr class="my-4">

                        <div class="col-3 d-flex justify-content-center align-items-center">
                            <div class="justify-content-center rounded-circle align-items-center d-flex" style="width: 60px; height: 60px; background-color:#58D68D;">
                                <i class="fa-solid fa-clipboard-check fs-1 text-white"></i>
                            </div>
                        </div>
                        <div class="col-9 ps-0">
                            <div>
                                <div class="fw-ligh">Movistar</div>
                                <h5 class="d-blockt">Plan Internet 50Mbps</h5>
                                <small><b>Monto:</b> 70 soles</small><br>
                                <small><b>Fecha:</b> Jueves 10 de marzo del 2022</small>
                            </div>
                        </div>

                    </div>



                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php require RUTA_APP . "/views/inc/footer.php"; ?>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'es',
            themeSystem: 'bootstrap4'
        });
        calendar.render();
    });
</script>