<?php require RUTA_APP . "/views/inc/head.php";
date_default_timezone_set('UTC');

?>

<div class="container" id="listaRecordatorios">
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



    <div class="row">
        <div class="col-4 mt-4" v-for="(record, index) in recordatorios" :key="index">

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
                                <div class="fw-ligh">{{record.nombreproveedor}}</div>
                                <h5 class="d-blockt">{{record.nombresuscripcion}} </h5>
                                <small><b>Monto:</b> {{record.precio}} </small><br>
                                <small><b>Fecha Inicio:</b> {{ formatDate(record.inicio) }}</small><br>
                                <small><b>Ciclo de Pago:</b> {{record.ciclo}} </small><br>
                                <small><b>Proximo Pago:</b> {{calcularTiempo(record.inicio, record.ciclo )}} </small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <a @click="eliminarRecordatorio(record.IdSusContratada)" class="btn btn-danger btn-sm rounded-circle d-flex align-items-center me-2" style="height: 30px; width: 30px;"><i class="fa-regular fa-trash-can"></i> </a>
                    <a :href="'suscripciones/editar/' + record.IdSusContratada" class="btn btn-primary btn-sm rounded-circle d-flex align-items-center" style="height: 30px; width: 30px;"><i class="fa-solid fa-pen-to-square"></i> </a>
                </div>
            </div>

        </div>


    </div>

</div>


<?php require RUTA_APP . "/views/inc/footer.php"; ?>


<script src="https://unpkg.com/vue@3"></script>

<script>
    const {
        createApp
    } = Vue

    createApp({
        data() {
            return {
                recordatorios: [],
            }
        },

        methods: {
            getRecordatorios() {
                axios({
                        url: "http://localhost/sistemaweb/suscripciones/listarrecordatorios",
                        method: "POST"
                    })
                    .then(res => {
                        if (res.data.content) {
                            this.recordatorios = res.data.content
                        }
                        console.log(res.data)
                    })
                    .catch(error => {
                        console.log(error)
                    })
            },

            eliminarRecordatorio(idRecordatorio) {
                swal({
                    title: "¿Desea eliminar este recordatorio?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then( confirm => {
                    if(!confirm) { return }
                    axios({
                            url: "http://localhost/sistemaweb/suscripciones/eliminarrecordatorio/" + idRecordatorio,
                            method: "POST"
                        })
                        .then(res => {
                            console.log(res)
                            swal({
                                title: "Se eliminó correctamente!",
                                icon: "success"
                            })

                            this.getRecordatorios();
    
                            if (res.data.message) {
                                swal({
                                    title: "Ha ocurrido un error",
                                    icon: "error"
                                })
                            }
                        })
    
                        .catch(error => {
    
                        })
                })


            },

            formatDate(date){
                moment.locale('es');
                return moment(date).format('dddd DD MMMM YYYY')
            },

            calcularTiempo(date, ciclo){
                var ciclos = ""
                switch (ciclo){
                    case 'Semanal': 
                        ciclos = "weeks"
                    break;
                    case 'Mensual': 
                        ciclos = "months"
                    break;
                    case 'Anual': 
                        ciclos = "years"
                    break;
                }
                console.log(ciclos)
                return moment(date).add(1, ciclos).format('dddd DD MMMM YYYY')
            }
        },

        mounted() {
            this.getRecordatorios();
        }
    }).mount('#listaRecordatorios')
</script>