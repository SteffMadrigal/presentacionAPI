<?php
require_once '../src/db/Database.php';

class Prenda{
    private $db;
    public function __construct(){
        //Conexion a la base de datos        
        $this->db = Database::connect();
    }

    //Consulta por todas la prendas
    public function consulta(){
        $stmt = $this->db->query("SELECT * FROM PRENDAS");
        return $stmt->fetchAll();
    }

    //Consulta por prenda segun el identificador
    public function consulta_id($id){
        $stmt = $this->db->prepare("SELECT * FROM PRENDAS WHERE IDE_PRENDA = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }  
    
   //Creacion de una registro en la tabla de prendas    
    public function create($data){
        $stmt = $this->db->prepare("INSERT INTO PRENDAS (DSC_PRENDA, MON_STOCK, IDE_MARCA, IDE_ESTADO) VALUES (?, ?, ?, ?)");
        $stmt->execute([$data["dsc_prenda"], $data["mon_stock"], $data["ide_marca"], $data["ide_estado"]]);
        return ["id" => $this->db->lastInsertId()];
    }     

    //actualización de un registro en la tabla prendas por su id
    public function update($id, $data){
        $stmt = $this->db->prepare("UPDATE PRENDAS SET DSC_PRENDA = ?, MON_STOCK = ?, IDE_MARCA = ?, IDE_ESTADO = ? WHERE IDE_PRENDA = ?");
        $stmt->execute([$data["dsc_prenda"], $data["mon_stock"], $data["ide_marca"], $data["ide_estado"], $id]);
        return ["success" => true];
    }   
    
    //eliminación de un registro en la tabla prendas segun su identificador
    public function delete($id){
        try {
            $stmt = $this->db->prepare("DELETE FROM PRENDAS WHERE IDE_PRENDA = ?");
            $stmt->execute([$id]);
            return ["success" => true];       
        } catch (Exception $e) {
            echo $e;
            return ["success" => false];     
        }        
    }     
}