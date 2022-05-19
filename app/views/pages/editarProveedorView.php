<?php require RUTA_APP . "/views/inc/head.php"; ?>

<div class="container" id="registroProveedores">

    <div class="row">

        <div class="col-md-5 mx-auto">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h5><b>Editar Proveedor</b></h5> 
                        <a href="<?php echo RUTA_URL . "proveedores"?>" class="btn me-2" style="background-color: #BFC9CA;">Volver</a>
                    </div>
                    <div id="message-alert" v-html="msgAlert"></div>

                    <div class="row">
                        <div class="col-6">
                            <label for="proveedor" class="form-label">Nombre Proveedor <small class="fw-bold text-danger">* </small></label>
                            <input type="text" class="form-control bg-light" v-model="proveedor.nombreproveedor" ref="proveedorNombre" name="nombreproveedor" placeholder="">
                        </div>

                        <div class="col-6">
                            <label for="proveedor" class="form-label">Categoria <small class="fw-bold text-danger">* </small></label>
                            <input type="text" class="form-control bg-light" v-model="proveedor.categoria" ref="proveedorCategoria" name="categoria" placeholder="">
                        </div>

                        <div class="col-8">
                            <label for="proveedor" class="form-label">Descripción</label>
                            <input type="text" class="form-control bg-light" v-model="proveedor.descripcion" name="descripcion" placeholder="">
                        </div>

                        <div class="col-4">
                            <label for="proveedor" class="form-label">Teléfono</label>
                            <input type="text" class="form-control bg-light" v-model="proveedor.telefono" name="telefono" placeholder="">
                        </div>

                    </div>


                </div>
            </div>


            <div class="card shadow-sm mx-auto my-2 border-0">
                <div class="card-body">
                    <h6 class="card-title">Agregar Servicios</h6>
                    <div class="row">
                        <div class="col-md-7">
                            <label for="nombreServicio" class="form-label">Nombre del servicio</label>
                            <input type="text" class="form-control bg-light" ref="servicioInput" id="nombreservicio" v-model="servicio.nombresuscripcion">
                            <small class="text-muted">Minimo 6 carácteres </small>
                        </div>

                        <div class="col-md-5">
                            <label for="proveedor" class="form-label">Precio</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text">S/.</span>
                                <input type="text" class="form-control" id="precioservicio" v-model="servicio.precio" ref="precioInput">
                                <span class="input-group-text">.00</span>
                            </div>

                        </div>
                        <div class="col-12 pt-2 d-flex justify-content-center">
                            <button type="button" class="btn btn-light btn-sm" @click="close()">Cancelar</button>
                            <button type="button" v-bind:disabled="!validateServicio || !validatePrecio" class="btn btn-primary btn-sm" @click="saveservicio()">Guardar</button>
                        </div>

                    </div>

                    <div class="px-2 py-0">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">Servicios</th>
                                    <th scope="col">Precio</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr v-for="(serv, index) in serviciosList" :key="serv">
                                    <td>{{ serv.nombresuscripcion }}</td>
                                    <td>{{ serv.precio }}</td>
                                    <td>
                                        <button style="height: 30px; width: 30px;" @click="deleteServicio(serv)" class="btn btn-danger btn-sm rounded-circle me-2"><i class="fa-regular fa-trash-can"></i></button>
                                        <button style="height: 30px; width: 30px;" @click="editSevicio(serv)" class="btn btn-primary btn-sm rounded-circle"><i class="fa-solid fa-pen-to-square"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <div class="card">
                <div class="card-body">
                    <div class="col-12">
                         <a href="<?php echo RUTA_URL . "proveedores"?>" class="btn btn-light me-2">Cancelar</a>
                        <button @click="editarProveedor()" class="btn btn-primary my-2">Guardar Proveedor</button>
                    </div>
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
                message: 'Hello Vue!',
                servicio: {
                    nombresuscripcion: "",
                    precio: 0
                },
                servicioDefault: {
                    nombresuscripcion: "",
                    precio: 0
                },
                proveedor: {
                    nombreproveedor: "",
                    categoria: "",
                    descripcion: "",
                    telefono: ""
                },
                proveedorDefault: {
                    nombreproveedor: "",
                    categoria: "",
                    descripcion: "",
                    telefono: ""
                },
                validateServicio: false,
                validatePrecio: false,
                serviciosList: [],

                servicesDeleted:[],

                msgAlert: "",

                idproveedor: -1,
                editItemService : -1
            }
        },

        methods: {

            editarProveedor() {

                var data = new FormData()
                Object.keys(this.proveedor).forEach((key) => {
                    data.append(key, this.proveedor[key])
                })

                data.append('serviciosList', JSON.stringify(this.serviciosList))
                data.append('servicesDeleted', JSON.stringify(this.servicesDeleted))

                axios({
                    method: "POST",
                    url: "http://localhost/sistemaweb/proveedores/editarproveedor",
                    data: data,
                    headers: { "Content-Type": "multipart/form-data" },
                })
                .then( res =>{
                    
                    this.msgAlert = res.data.message

                    console.log(res)

                    if(res.data.content){
                        window.location.href = "/sistemaweb/proveedores";
                    }
                })
                .catch( error => {
                    console.log(error)
                })

            },

            saveservicio() {
                if (this.editItemService > -1) {
                    this.serviciosList[this.editItemService] =this.servicio
                } else {
                    this.serviciosList.push(this.servicio)
                }
                this.close()
            },

            deleteServicio(servicio) {
                swal({
                        title: "¿Desea eliminar el elemento?",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true
                    })
                    .then(confirm => {
                        if (confirm) {
                            if(servicio.IdSuscripcion){
                                this.servicesDeleted.push(servicio.IdSuscripcion)
                            }

                            var indexOf = this.serviciosList.indexOf(servicio)
                            this.serviciosList.splice(indexOf, 1)
                        }
                    })

            },

            close() {
                this.servicio = Object.assign({}, this.servicioDefault)
                this.$nextTick(() => {
                    this.$refs.servicioInput.classList.remove('is-valid')
                    this.$refs.precioInput.classList.remove('is-valid')
                    this.$refs.servicioInput.classList.remove('is-invalid')
                    this.$refs.precioInput.classList.remove('is-invalid')
                    this.validateServicio = false
                    this.validatePrecio = false
                    this.editItemService = -1
                })
            },

            editSevicio(servicio) {
                this.editItemService = this.serviciosList.indexOf(servicio)
                this.servicio = Object.assign({}, servicio)
            },

            obtenerProveedor(){
                var url = window.location.href;
                var arrayUrl = url.split("/") 
                this.idproveedor = arrayUrl[arrayUrl.length - 1]
                console.log(this.idproveedor)
                axios({
                    method: "POST",
                    url: "http://localhost/sistemaweb/proveedores/obtenerproveedor/" + this.idproveedor,
                    headers: { "Content-Type": "multipart/form-data" },
                })

                .then( res =>{
                    this.proveedor = Object.assign({}, res.data.content.proveedor)
                    this.serviciosList = res.data.content.servicios

                    console.log(res)
                })
            }

        },

        watch: {
            'servicio.nombresuscripcion': function(val) {
                if (val.length > 5) {
                    this.$refs.servicioInput.classList.add('is-valid')
                    this.$refs.servicioInput.classList.remove('is-invalid')
                    this.validateServicio = true
                } else {
                    this.$refs.servicioInput.classList.remove('is-valid')
                    this.$refs.servicioInput.classList.add('is-invalid')
                    this.validateServicio = false
                }
            },
            'servicio.precio': function(val) {
                if (!isNaN(val) && val > 0) {
                    this.$refs.precioInput.classList.add('is-valid')
                    this.$refs.precioInput.classList.remove('is-invalid')
                    this.validatePrecio = true
                } else {
                    this.$refs.precioInput.classList.remove('is-valid')
                    this.$refs.precioInput.classList.add('is-invalid')
                    this.validatePrecio = false
                }
            },
            'proveedor.nombreproveedor': function(val) {
                if (val != "") {
                    this.$refs.proveedorNombre.classList.add('is-valid')
                    this.$refs.proveedorNombre.classList.remove('is-invalid')
                } else {
                    this.$refs.proveedorNombre.classList.remove('is-valid')
                    this.$refs.proveedorNombre.classList.add('is-invalid')
                }
            },
            'proveedor.categoria': function(val) {
                if (val != "") {
                    this.$refs.proveedorCategoria.classList.add('is-valid')
                    this.$refs.proveedorCategoria.classList.remove('is-invalid')
                } else {
                    this.$refs.proveedorCategoria.classList.remove('is-valid')
                    this.$refs.proveedorCategoria.classList.add('is-invalid')
                }
            }


        },

        mounted(){
            this.obtenerProveedor();
        }



    }).mount('#registroProveedores')
</script>