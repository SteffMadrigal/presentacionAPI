<?php

//inclusión de los controladores
require_once '../src/controllers/Marca.php';
require_once '../src/controllers/Prenda.php';
require_once '../src/controllers/Venta.php';
require_once '../src/controllers/Reporte.php';


$method = $_SERVER['REQUEST_METHOD'];

// remueve / del inicio

$path = trim($_SERVER['PATH_INFO'], '/');
// PATH_INFO



// Split the path into segments
// con EXPLODE: Separamos en secciones el URL(string) por medio del / y conviertiendo en un arreglo
// autores/1 -> autores/1
$segmentosDeUrl = explode('/', $path);

/*
var_dump($_SERVER['PATH_INFO']);
var_dump($path);
var_dump($segments);*/


// Obtiene el primer elemento del arreglo
$rutaControlador = array_shift($segmentosDeUrl);
// Obtiene el ultimo
$id = end($segmentosDeUrl);

//CRUD PARA LA TABLA MARCA
if($rutaControlador == "marca") {

    $objetosMarca = new MarcaController();
    switch ($method) {
        //CONSULTA, PUEDE SER POR IDENTIFICADOR O GENERAL
        case 'GET':
            $objetosMarca->get($id);
            break;
        //INSERTAR DATOS EN LA TABLA MARCA
        case 'POST':
            $objetosMarca->post($id);
        //ACTUALIZAR DATOS EN LA TABLA MARCA            
        case 'PUT':
            $objetosMarca->update($id);               
            break;
        //BORRAR DATOS EN LA TABLA MARCA            
        case 'DELETE':
            $objetosMarca->delete($id);
            break;            
        default:
            Response::json(['error' => 'Metodo no permitido'], 405);
    }
}
//CRUD PARA LA TABLA PRENDA
elseif($rutaControlador == "prenda") {

    $objetosPrenda = new PrendaController();
    switch ($method) {
        //CONSULTA, PUEDE SER POR IDENTIFICADOR O GENERAL        
        case 'GET':
            $objetosPrenda->get($id);
            break; 
        //INSERTAR DATOS EN LA TABLA PRENDA            
        case 'POST':
            $objetosPrenda->post($id);
            break;   
        //ACTUALIZAR DATOS EN LA TABLA PRENDA                  
        case 'PUT':
            $objetosPrenda->update($id);      
            break; 
        //BORRAR DATOS EN LA TABLA PRENDA               
        case 'DELETE':
            $objetosPrenda->delete($id);
            break;                       
        default:
            Response::json(['error' => 'Metodo no permitido'], 405);
    }
}
//CRUD PARA LA TABLA VENTA
elseif($rutaControlador == "venta") {

    $objetosVenta = new VentaController();
    switch ($method) {
        //CONSULTA, PUEDE SER POR IDENTIFICADOR O GENERAL        
        case 'GET':
            $objetosVenta->get($id);
            break;
        //INSERTAR DATOS EN LA TABLA VENTA            
        case 'POST':
            $objetosVenta->post($id);
            break; 
        //ACTUALIZAR DATOS EN LA TABLA VENTA               
        case 'PUT':
            $objetosVenta->update($id); 
            break;   
        //BORRAR DATOS EN LA TABLA VENTA                                   
        case 'DELETE':
            $objetosVenta->delete($id);
            break;              
        default:
            Response::json(['error' => 'Metodo no permitido'], 405);
    }
}

//CONSULTA A LA MARCAS MAS VENDIDAS 
elseif($rutaControlador == "marcasMasVendidas") {

    $objetoreporte = new ReporteController();
    switch ($method) {
        case 'GET':
            $objetoreporte->marcasMasVendidas();
            break;             
        default:
            Response::json(['error' => 'Metodo no permitido'], 405);
    }
}

//CONSULTA A LA MARCAS VENTAS
elseif($rutaControlador == "marcasVentas") {

    $objetoreporte = new ReporteController();
    switch ($method) {
        case 'GET':
            $objetoreporte->marcasVentas();
            break;             
        default:
            Response::json(['error' => 'Metodo no permitido'], 405);
    }
}

//CONSULTA A LA VENTAS STOCK
elseif($rutaControlador == "marcasStock") {

    $objetoreporte = new ReporteController();
    switch ($method) {
        case 'GET':
            $objetoreporte->marcasStock();
            break;             
        default:
            Response::json(['error' => 'Metodo no permitido'], 405);
    }
}

else{
    include "error/response.html";
}



?>
