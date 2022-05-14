window.addEventListener("load", (event)=>{

        let form = document.getElementById("form_login");
        let campoEmail = document.getElementById("campoEmail");
        let btnLogin = document.getElementById('btnLogin')
      if(campoEmail){
        campoEmail.addEventListener('keypress', event =>{

            if(campoEmail.value.length > 0){
                if(!validateEmail(campoEmail.value)){
                    btnLogin.disabled  = true
                    campoEmail.classList.add('is-invalid')
                    campoEmailFeedback.classList.add('invalid-feedback')
                    campoEmailFeedback.innerText = "Email Incorrecto"
                }else{
                    campoEmail.classList.remove('is-invalid')
                    campoEmail.classList.add('is-valid')

                    campoEmailFeedback.classList.remove('invalid-feedback')
                    campoEmailFeedback.classList.add('valid-feedback')
                    campoEmailFeedback.innerText = ""

                    btnLogin.disabled  = false
                }
            }
            
        })
      } 


        if(form){

            form.addEventListener("submit", event=>{
                event.preventDefault();

                let oForm = new FormData(form);     
                axios({
                    method: 'post',
                    url: 'http://localhost/sistemaweb/login/logearse',
                    data: oForm,
                    headers: { "Content-Type": "multipart/form-data" },
                    })         
                    .then(function (response) {
                    
                    if(response.data.content){
                        window.location.href = "/sistemaweb/";
                    }else{
                        document.getElementById("message-alert").innerHTML = response.data.message;
                    }
                    
                    console.log(response);
                })
                .catch(function (error) {
                    console.log(error);
                });

            })
        }

        

/* detectar las teclas mayusculas */
/*
document.addEventListener( 'keydown', function( event ) {
    var mayus = event.getModifierState && event.getModifierState( 'CapsLock' );
    console.log( mayus ); //que será verdadero cuando presiones Bloq Mayus
    if(mayus)
         alert('Bloq Mayus está activado.');
  });
*/

  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
  })

})