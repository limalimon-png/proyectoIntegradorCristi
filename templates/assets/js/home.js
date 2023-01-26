
let pagina = 0;
let json = [];
let primera = 0;
let columnas;
let tabla;



window.onload =  () => {
  

    getProductos(0);
  

    document.getElementById("sliders").click();
}



async function getProductos(pag) {
    pagina += pag;
    let info;
    if (json[pagina]) {
        info = json[pagina]

    } else {
      localStorage.setItem('myCat', 'Tom');
      const cat = localStorage.getItem('myCat');
      localStorage.removeItem('myCat');
      localStorage.clear();

      try{

        const response = await fetch('destacados?id=0');

        info = await response.json();
      }catch(err){

      }
        



        json[pagina] = info;
    }
    let sliders = document.getElementById('sliders');


    // console.log(info);


let num=1;

    info.forEach(element => {
        if(element['foto1']==undefined){
            
        }else{

         

        sliders.innerHTML += "<div class='swiper-slide ' data-hash='slide"+num+"'>" +
            "<div class='container '>" +
            " <div class='row  '>" +
            " <div class='col-md-6 text-center'>" +
            "          <img alt='imagen' class='img-fluid'src='"+"../vistas/galeria/objetos/"+element['id']+"/img1/"+element['foto1']+"'/>" +
            "</div>" +
            "<div class='col-md-6 d-md-flex align-items-md-center'>" +
            "<div style='max-width: 350px'>" +
            "  <h2 class='text-uppercase fw-bold'>" +
                "<br />"+element['nombre']+ 
            "  </h2>" +
            "  <p class=''>" +
            "  "+element['descripcion']+
            "  </p>" +
            "  <a class='btn btn-primary btn-lg me-2' role='button' href='#'>Button</a>" +
            "  <a class='btn btn-outline-primary btn-lg' role='button' href='#'>Button</a>" +
            "</div>" +
            "      </div>" +
            "    </div>" +
            "  </div>" +
            "</div>";




            num++;
        }
    });

    $(document).ready(() => {
        var swiper = new Swiper('.swiper-container', {
          hashNavigation: {
            watchState: true,
          },
          pagination: {
            el: '.swiper-pagination',
          },
          navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
          },
        });
      });
  

}