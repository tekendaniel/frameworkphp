<?php require RUTA_APP . "/views/inc/head.php"; ?>


<div class="container d-block" >
        <div class="row d-flex justify-content-center">

        <div class="col-md-8 col-sm-12 mx-auto">
            
        <a href="<?php echo RUTA_URL . "proveedores/create" ?>" class="btn btn-warning btn-sm my-3">Agregar Proveedor </a>

            <div class="card shadow-sm border-0 animate__animated animate__zoomIn">
                <div class="card-body p-4">
                    <h5><b>Proveedores</b></h5> 

                    <table class="table table-striped mt-3">
                        <thead>
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Categoria</th>
                                <th scope="col">Servicios</th>
                                <th scope="col"></th>

                            </tr>
                        </thead>

                        <tbody>
            
                            <?php foreach($datos as $el): ?>
                            <tr>
                                <td><?php echo $el->Nombre ?></td>
                                <td><?php echo $el->Categoria ?></td>
                                <td><button class="btn btn-success btn-sm" data-item="<?php echo $el->IdProveedor ?>" id="showSuscripciones" >Ver Servicios </button></td>
                                <td>
                                    <button id="iconDeleteProvee" type="button" class="btn btn-danger btn-sm rounded-pill" data-item="<?php echo $el->IdProveedor ?>"  ><i id="iconDeleteProveeChild" class="fa-regular fa-trash-can" data-item="<?php echo $el->IdProveedor ?>"></i></button>
                                    <a href="<?php echo RUTA_URL . "proveedores/edit/" . $el->IdProveedor ?>" class="btn btn-primary btn-sm rounded-pill" data-item="<?php echo $el->IdProveedor ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                </td>
                            </tr>
                            <?php endforeach; ?>   

                            <?php if(empty($datos)): ?>
                                <tr>
                                    <td colspan="4" class="text-center"> Registre un nuevo proveedor</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>



                </div>
            </div>
        </div>  

      


<!---- MODAL MOSTRAR SERVICIOS POR PROVEEDOR ------>
<div class="modal fade" id="listSuscpcionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Servicios</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <ul class="list-group" id="ListSusProvModal">
            
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php require RUTA_APP . "/views/inc/footer.php"; ?>


<script>


window.addEventListener("load", (event)=>{


    

    document.addEventListener('click',function(e){
                    

            /************************************************************************ */
        /* ELIMINAR UN PROVEEDOR Y SUS SERVICIOS */

            if(e.target && e.target.id== 'iconDeleteProvee' || e.target.id == 'iconDeleteProveeChild'){

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
                            headers: { "Content-Type": "multipart/form-data" },
                        })
                        .then(resp =>{
                            location.href ="http://localhost/sistemaweb/proveedores";
                        })
                        .catch(err => {
                            console.log(err)
                        })



                       
                    } 
                });


                        

            }



            /**************************************************************************/
               /* LISTAR SUSCRIPCIONES POR PROVEEDORES DENTRO DE MODAL */     
               

               else if(e.target && e.target.id== 'showSuscripciones'){
                        //do something

                        var idProveedor = e.target.getAttribute('data-item');

                        axios({
                                method: 'post',
                                url: 'http://localhost/sistemaweb/proveedores/mostrarSuscripciones/' + idProveedor,
                                headers: { "Content-Type": "multipart/form-data" },
                                })         
                                .then(function (response) {

                                    var result = response.data.content;
                                
                                if(result){
                                    console.log(result)
                                    var myModal = new bootstrap.Modal(document.getElementById('listSuscpcionModal'))
                                        myModal.show()

                                    ListSusProvModal.innerHTML= ""

                                    result.forEach((elem, index)=>{
                                        
                                        ListSusProvModal.innerHTML+=
                                    `
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                            <div class="d-flex align-items-center rounded-circle bg-primary p-2 text-white" style="height:30px; width: 30px;"><span class="mx-auto"> ${index+1}</span></div>
                                            <div class="ms-2 me-auto">
                                                <strong> ${elem.NombreSuscripcion} </strong>
                                                <span class="d-block text-muted">
                                                ${elem.Descripcion}
                                                </span>
                                            </div>
                                            <div>
                                                <strong> s/. ${formatoMoneda(elem.Pago)} </strong>
                                            </div>
                                        </li>
                                    `

                                    });


                                    

                                }
                                                                })
                            .catch(function (error) {
                                console.log(error.data);
                            });

                    }
                });

                

        /**************************************************************************/
        /* LISTAR PROVEEDORES */
           /*  axios({
                    method: 'post',
                    url: 'http://localhost/sistemaweb/proveedores/mostrarProveedores',
                    headers: { "Content-Type": "multipart/form-data" },
                    })         
                    .then(function (response) {
                    
                    if(response.data.content){

                        let resultado = response.data.content;

                        if(resultado.length > 0){
                            resultado.forEach( (elem, index) => {

                                tablaProveedores.innerHTML += `
                                    <tr>    
                                            <td>${index + 1}</td>
                                            <td>${elem.Nombre}</td>
                                            <td>${elem.Categoria}</td>
                                            <td><button class="btn btn-success btn-sm" data-item=${elem.IdProveedor} id="showSuscripciones" >Ver Servicios </button></td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm rounded-pill" data-item=${elem.IdProveedor} id="eliminarProv" ><i class="fa-regular fa-trash-can"></i> </button>
                                                <button type="button" class="btn btn-primary btn-sm rounded-pill" data-item=${elem.IdProveedor}><i class="fa-solid fa-pen-to-square"></i> </button>
                                            </td>

                                        </tr>
                                    `
                                });
                        }else{
                            tablaProveedores.innerHTML +=`
                                    <tr class="text-center">
                                            Agrega un nuevo proveedor
                                        </tr>
                                    `


                        }
                        

                        
                        
                    }else{
                    }
                    
                    console.log(response);
                })
                .catch(function (error) {
                    console.log(error.data);
                });



        */

    });

</script>