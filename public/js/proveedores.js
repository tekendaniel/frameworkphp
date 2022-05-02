import { connect } from './connect.js';

let oForm = new FormData(form);   

function listarProveedores(){
    connect({
        method: 'post',
        url: 'http://localhost/sistemaweb/login/logearse',
        data: oForm,
    }, 
    (response) =>{ 
        console.log(response)
    },
    (error) =>{
        console.log(error)
    }
    )
}


document.addEventListener('DOMContentLoaded', event =>{
    listarProveedores()
})

