window.addEventListener("load", (event)=>{


        let form = document.getElementById("form_login");

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



        /********************************************************************************* */


        let formRegister = document.getElementById("form_registro");

        if(formRegister){

            formRegister.addEventListener("submit", event =>{
                event.preventDefault();

                let oForm = new FormData(formRegister);     
                axios({
                    method: 'post',
                    url: 'http://localhost/sistemaweb/login/createUser',
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





})