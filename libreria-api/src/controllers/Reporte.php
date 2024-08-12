<?php

require_once '../src/models/Reporte.php';

class ReporteController{
    private $model;

    public function __construct(){
        //construccion del objeto          
        $this->model = new Reporte();
    }

    //llama al metodo que se ejecuta la vista de marcas mas vendidas
    public function marcasMasVendidas(){
        echo json_encode($this->model->marcasMasVendidas());
    }

    //llama al metodo que se ejecuta la vista de marcas en stock
    public function marcasStock(){
        echo json_encode($this->model->marcasStock());
    }    

    //llama al metodo que se ejecuta la vista de marcas  
    public function marcasVentas(){
        echo json_encode($this->model->marcasVentas());
    }       
}
?>