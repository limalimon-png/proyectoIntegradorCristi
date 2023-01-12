window.onload= async ()=>{
let info= await getProductos()


console.log(info);
}



async function getProductos() {
    const response = await fetch('lista?tabla=productos');
    return response.json();


}