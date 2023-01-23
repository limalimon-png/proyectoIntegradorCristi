let url;
window.onload = () => {
    url = location.href.substring(location.href.lastIndexOf("/") + 1);
    seleccionar();
}




function seleccionar() {
    
    switch (url) {
        case 'home':
            document.getElementById("home").classList.add("active")
            document.getElementById("productos").classList.remove("active")
            document.getElementById("categorias").classList.remove("active")
            document.getElementById("login").classList.remove("active")
            document.getElementById("contacto").classList.remove("active")
            break;
        case 'productos':
             document.getElementById('buscador').classList.add('ocultar')
            document.getElementById("productos").classList.add("active")
            document.getElementById("home").classList.remove("active")
            document.getElementById("categorias").classList.remove("active")
            document.getElementById("login").classList.remove("active")
            document.getElementById("contacto").classList.remove("active")
            break;
        case 'categorias':
            document.getElementById('buscador').classList.add('ocultar')
            document.getElementById("categorias").classList.add("active")
            document.getElementById("home").classList.remove("active")
            document.getElementById("productos").classList.remove("active")
            document.getElementById("login").classList.remove("active")
            document.getElementById("contacto").classList.remove("active")
            break;
        case 'login':
            document.getElementById("login").classList.add("active")
            document.getElementById("home").classList.remove("active")
            document.getElementById("productos").classList.remove("active")
            document.getElementById("categorias").classList.remove("active")
            document.getElementById("contacto").classList.remove("active")

            break;
        // case 'register':
        //     document.getElementById("coment").classList.add("active")
        //     document.getElementById("cat").classList.remove("active")
        //     document.getElementById("prod").classList.remove("active")
        //     document.getElementById("usu").classList.remove("active")
        //     document.getElementById("dash").classList.remove("active")
        //     break;
            case 'contacto':
            document.getElementById("contacto").classList.add("active")
            document.getElementById("home").classList.remove("active")
            document.getElementById("productos").classList.remove("active")
            document.getElementById("categorias").classList.remove("active")
            document.getElementById("login").classList.remove("active")

            break;


    }
}