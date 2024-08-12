<?php

require_once '../src/models/Prenda.php';

class PrendaController{
    private $model;

    public function __construct(){
        //construccion del objeto        
        $this->model = new Prenda();
    }

    public function get($id){
        //si vienen datos en id, es porque es una consulta por identificador, en caso contrario muestra todos los datos de la tabla prenda        
        if($id){
            //consulta con filtro
            echo json_encode($this->model->consulta_id($id));
        }else{
            //consulta sin filtro
            echo json_encode($this->model->consulta());
        }
    }

    //llama al metodo que se encarga de agregar datos 
    public function post(){
        $data = json_decode(file_get_contents('php://input'), true);
        echo json_encode($this->model->create($data));
    }

    //llama al metodo que se encarga de actualizar los datos
    public function update($id){
        $data = json_decode(file_get_contents('php://input'), true);
        echo json_encode($this->model->update($id, $data));
    }    

    //llama al metodo que se encarga de eliminar los datos
    public function delete($id){
        echo json_encode($this->model->delete($id));
    } 
}
?>