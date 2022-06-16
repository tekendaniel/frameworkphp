<?php require RUTA_APP . "/views/inc/head.php"; ?>

<div class="container d-block" id="editarRecordatorio">
    <div class="">

        <div class="col-12 col-lg-6 mx-auto">
            <div class="card shadow border-0">
                <div class="card-body px-5 py-4">
                    <form enctype="multipart/form-data" action="POST" id="formContrato">
                        <h5><b>EDITAR RECORDATORIO</b></h5>
                        <div id="message-alert" v-html="alertMsg"></div>

                        <div class="row">
                            <div class="col-12 col-md-6">
                                <label for="proveedor" class="form-label">Nombre Proveedor</label>
                                <select disabled class="form-select bg-light" id="proveedoresSelect" name="idProveedor" v-model="recordatorio.IdProveedor">
                                    <option disabled selected value=""> Selecciona un proveedor</option>
                                    <option v-for="(p, index) in listproveedores" :key="index" :value="p.IdProveedor">
                                        {{ p.nombreproveedor }}
                                    </option>
                                </select>
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="proveedor" class="form-label">Servicios</label>
                                <select disabled class="form-select bg-light" id="serviciosSelect" name="idServicio" v-model="recordatorio.idServicio">
                                    <option disabled selected value=""> Selecciona un proveedor</option>
                                    <option v-for="(s, index) in servicios" :key="index" :value="s.IdSuscripcion">
                                        {{ s.nombresuscripcion }}
                                    </option>
                                </select>
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="proveedor" class="form-label">Inicio de Suscripción</label>
                                <input type="date" class="form-control bg-light" name="inicio" v-model="fechaInicio">
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="proveedor" class="form-label">Ciclo</label>
                                <select class="form-select bg-light" name="ciclo" v-model="recordatorio.ciclo">
                                    <option value="" selected disabled>Selecciona un ciclo</option>
                                    <option value="Semanal">Semanal</option>
                                    <option value="Mensual">Mensual</option>
                                    <option value="Anual">Anual</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="proveedor" class="form-label">Duración</label>
                                <input type="text" class="form-control bg-light" name="duracion" v-model="recordatorio.duracion">
                            </div>

                        </div>

                </div>
            </div>
        </div>


        <div class="col-12 col-lg-6 mx-auto mt-4">
            <div class="card shadow border-0">
                <div class="card-body px-5 py-4">
                    <h5><b>Recordatorio</b></h5>
                    <span class="d-block mb-2">Seleccione que periodo de tiempo desea recordar pagos: </span>
                    <div class="text-center">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="TiempoRecordatorio" value="1 día antes" id="flexRadioDefault1" v-model="recordatorio.TiempoRecordatorio">
                            <label class="form-check-label" for="flexRadioDefault1">
                                1 día antes
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="TiempoRecordatorio" value="1 semana antes" id="flexRadioDefault2" checked v-model="recordatorio.TiempoRecordatorio">
                            <label class="form-check-label" for="flexRadioDefault2">
                                1 semana antes
                            </label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="TiempoRecordatorio" value="1 mes antes" id="flexRadioDefault2" v-model="recordatorio.TiempoRecordatorio">
                            <label class="form-check-label" for="flexRadioDefault2">
                                1 mes antes
                            </label>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-12">
                <a href="<?php echo RUTA_URL . 'suscripciones' ?>" class="btn btn-light my-4 me-2">CANCELAR</a>
                <button type="submit" @click="updateRecordatorio" class="btn btn-primary my-4">GUARDAR RECORDATORIO</button>
            </div>

            </form>
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
                listproveedores: [],
                servicios: [],
                idRecordatorio: -1,
                recordatorio: {
                    IdProveedor: 0,
                    idServicio: 0,
                    inicio: "",
                    ciclo: "",
                    duracion: "",
                    tipomoneda: "",
                    TiempoRecordatorio: ""

                },
                alertMsg: ""
            }
        },

        methods: {
            listarPro() {
                axios({
                        method: 'post',
                        url: 'http://localhost/sistemaweb/proveedores/listarProveedoresJson',
                        headers: {
                            "Content-Type": "multipart/form-data"
                        }
                    })
                    .then(response => {
                        this.listproveedores = response.data.content
                        console.log(this.listproveedores)
                        this.listServ();
                    })
                    .catch(error => console.log(error))
            },

            listServ() {
                axios({
                        method: 'post',
                        url: 'http://localhost/sistemaweb/proveedores/listarServiciosJson/' + this.recordatorio.IdProveedor,
                        headers: {
                            "Content-Type": "multipart/form-data"
                        },
                    })
                    .then(res => {
                        console.log(res)
                        if (res.data.content) {
                            this.servicios = res.data.content
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },

            getRecordatorio() {
                var url = window.location.href;
                var arrayUrl = url.split("/")
                this.idRecordatorio = arrayUrl[arrayUrl.length - 1]
                axios({
                        method: "POST",
                        url: "http://localhost/sistemaweb/suscripciones/obtenerRecordatorio/" + this.idRecordatorio,
                        headers: {
                            "Content-Type": "multipart/form-data"
                        }
                    })
                    .then(resp => {
                        console.log(resp)
                        if (resp.data.content) {

                            this.recordatorio = Object.assign({}, resp.data.content)
                        }
                    })
                    .catch(error => console.log(error))
            },

            updateRecordatorio(){
                var data = new FormData()
                Object.keys(this.recordatorio).forEach((key) => {
                    data.append(key, this.recordatorio[key])
                })

                axios({
                    method: "POST",
                    url: "http://localhost/sistemaweb/contrato/editarRecordatorio",
                    headers: {
                            "Content-Type": "multipart/form-data"
                        },
                    data: data
                })
                .then( res =>{
                    console.log(res)
                    if(res.data.message){ this.alertMsg = res.data.message}

                    if(res.data.content){

                        swal({
                            title: "Se actualizó con exito",
                            text: "¿Desea volver a la lista de recordatorios?",
                            icon: "success",
                            buttons: true,
                            dangerMode: true,
                        })
                        .then( confirm => {
                            if(confirm) { location.href = "http://localhost/sistemaweb/suscripciones" }
                        })
                        
                        
                    }
                })
                .catch(error => {
                    console.log(error)
                })
            }


        },

        computed: {

            fechaInicio: {
                get() {
                    return moment(this.recordatorio.inicio).format('YYYY-MM-DD')
                },

                set(val) {
                    this.recordatorio.inicio = val
                }
            }
        },

        mounted() {
            this.getRecordatorio();
            this.listarPro();
            
        }

   
    }).mount('#editarRecordatorio')
</script>
<script>
    /*
    window.addEventListener('load', event => {

        var proveedoresSelect = document.getElementById("proveedoresSelect");

        var serviciosSelect = document.getElementById("serviciosSelect");
/*
        axios({
                method: 'post',
                url: 'http://localhost/sistemaweb/proveedores/listarProveedoresJson',
                headers: {
                    "Content-Type": "multipart/form-data"
                },
            })
            .then(function(response) {

                var p = response.data.content;
                if (response.data.content) {

                    proveedoresSelect.innerHTML = "<option value='' disabled selected >Selecciona un proveedor </option>";

                    p.forEach(el => {
                        proveedoresSelect.innerHTML +=
                            `
                                <option value="${el.IdProveedor }"> ${el.nombreproveedor}</option>

                                `;
                    })
                }


            })
            .catch(function(error) {
                console.log(error);
            });

*/
    /*
            proveedoresSelect.addEventListener("change", event => {
                event.preventDefault()

                var IdProveedor = event.target.value
                axios({
                        method: 'post',
                        url: 'http://localhost/sistemaweb/proveedores/listarServiciosJson/' + IdProveedor,
                        headers: {
                            "Content-Type": "multipart/form-data"
                        },
                    })
                    .then(function(response) {

                        var p = response.data.content;
                        if (response.data.content) {

                            serviciosSelect.innerHTML = "<option value='' disabled selected>Selecciona un servicio </option>";

                            p.forEach(el => {
                                serviciosSelect.innerHTML +=
                                    `
                                    <option value="${el.IdSuscripcion }"> ${el.nombresuscripcion}  -  S/. ${formatoMoneda(el.precio)}</option>

                                    `;
                            })

                        }


                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            });




            /*Registrar contrato nuevo */

    /*
            var formContrato = document.getElementById("formContrato")


            if (formContrato) {
                formContrato.addEventListener("submit", event => {
                    event.preventDefault();

                    let onDataContrato = new FormData(formContrato);

                    axios({
                            method: 'post',
                            url: 'http://localhost/sistemaweb/contrato/crearContrato',
                            data: onDataContrato,
                            headers: {
                                "Content-Type": "multipart/form-data"
                            },
                        })
                        .then(function(response) {

                            if (response.data.content) {

                                let resultado = response.data.content;

                                location.href = "http://localhost/sistemaweb/suscripciones";

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



        })*/
</script>