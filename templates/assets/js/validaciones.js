let expNombre=/^[a-zA-ZÀ-ÿ\s]{2,}$/;
let expApellido=/^[a-zA-ZÀ-ÿ\s]{2,}$/;
let expEmail=/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/;
let expPassword=/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
let expDinero=/^\d+(\.\d{1,4})?$/;
let expFecha=/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/;
let expDescripcion=/^[a-zA-ZÀ-ÿ0-9\s\.,;:\!\?]{10,200}$/;
let expNombreConNumero=/^[a-zA-ZÀ-ÿ0-9\s]{2,}$/;
let expNumeros=/^[0-9].$/;


// window.onload=()=>{

//     addEventoInputs();
// }
function cargarDesdeOtroArchivo(){
    addEventoInputs();
}



function validarFormulario(){
    let inputs = document.querySelectorAll('input[tipo]');
    let valido=true;
    inputs.forEach(input => {
        if(input.classList.contains('is-invalid')){
            valido=false;
            return false;
        }
    });
    return valido;

}

function addEventoInputs(){
    //coger todos los inputs que contengan el atributo tipo
    let inputs = document.querySelectorAll('input[tipo]');
    
    inputs.forEach(input => {
        input.addEventListener('blur',()=>{validarInput(input)});
    });
}

function validarInput(input){
    

try{
    switch (input.attributes['tipo'].value) {
        case 'nombre':
            if(expNombre.test(input.value)){
                input.classList.add('is-valid');
                input.classList.remove('is-invalid');
            }else{
                input.classList.add('is-invalid');
                input.classList.remove('is-valid');
            }
            
            return 
        case 'apellido':
            if(expApellido.test(input.value)){
                input.classList.add('is-valid');
                input.classList.remove('is-invalid');
            }else{
                input.classList.add('is-invalid');
                input.classList.remove('is-valid');
            }
            return
        case 'email':
            if(expEmail.test(input.value)){
                input.classList.add('is-valid');
                input.classList.remove('is-invalid');
            }else{
                input.classList.add('is-invalid');
                input.classList.remove('is-valid');
            }
            return
        case 'password':
            if(expPassword.test(input.value)){
                input.classList.add('is-valid');
                input.classList.remove('is-invalid');
            }else{
                input.classList.add('is-invalid');
                input.classList.remove('is-valid');
            }
            return
        case 'dinero':
            if(expDinero.test(input.value)){
                input.classList.add('is-valid');
                input.classList.remove('is-invalid');
            }else{
                input.classList.add('is-invalid');
                input.classList.remove('is-valid');
            }
            return
        case 'fecha':
            if(expFecha.test(input.value)){
                input.classList.add('is-valid');
                input.classList.remove('is-invalid');
            }else{
                input.classList.add('is-invalid');
                input.classList.remove('is-valid');
            }
            return
        case 'descripcion':
            if(expDescripcion.test(input.value)){
                input.classList.add('is-valid');
                input.classList.remove('is-invalid');
            }else{
                input.classList.add('is-invalid');
                input.classList.remove('is-valid');
            }
            return
        case 'nombreConNumero':
            if(expNombreConNumero.test(input.value)){
                input.classList.add('is-valid');
                input.classList.remove('is-invalid');
            }else{
                input.classList.add('is-invalid');
                input.classList.remove('is-valid');
            }
            return
        case 'numero':
            if(expNumeros.test(input.value)){
                input.classList.add('is-valid');
                input.classList.remove('is-invalid');
            }else{
                input.classList.add('is-invalid');
                input.classList.remove('is-valid');
            }
            return
        default:
            return
    }
   
}catch(err){
    //no tiene el atributo tipo
    console.log(err);
}
    

}
