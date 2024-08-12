<?php
//Inclusión del archivo de base de datos
require_once '../src/db/Database.php';

class Marca{
    private $db;
    public function __construct(){
        //Conexion a la base de datos
        $this->db = Database::connect();
    }

    //Consulta por todas la marcas
    public function consulta(){
        $stmt = $this->db->query("SELECT * FROM MARCAS");
        return $stmt->fetchAll();
    }

    //Consulta por marca segun el identificador
    public function consulta_id($id){
        $stmt = $this->db->prepare("SELECT * FROM MARCAS WHERE IDE_MARCA = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }  
    
    //Creacion de una registro en la tabla de marcas
    public function create($data){
        $stmt = $this->db->prepare("INSERT INTO MARCAS (DSC_MARCA, IDE_ESTADO) VALUES (?, ?)");
        $stmt->execute([$data["dsc_marca"], $data["ide_estado"]]);
        return ["id" => $this->db->lastInsertId()];
    }     

    //actualización de un registro en la tabla marcas por su id
    public function update($id, $data){
        $stmt = $this->db->prepare("UPDATE MARCAS SET DSC_MARCA = ?, IDE_ESTADO = ? WHERE IDE_MARCA = ?");
        $stmt->execute([$data["dsc_marca"], $data["ide_estado"], $id]);
        return ["success" => true];
    }   
    
    //eliminación de un registro en la tabla marcas segun su identificador
    public function delete($id){
        try {
            $stmt = $this->db->prepare("DELETE FROM MARCAS WHERE IDE_MARCA = ?");
            $stmt->execute([$id]);
            return ["success" => true];       
        } catch (Exception $e) {
            echo $e;
            return ["success" => false];     
        }         
    }      
}