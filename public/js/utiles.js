


function formatoMoneda(value){

   return new Intl.NumberFormat('es-PE',{style: "decimal", currency:"PEN", minimumFractionDigits:2}).format(value)
}


