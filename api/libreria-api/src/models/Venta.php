<?php
require_once '../src/db/Database.php';

class Venta{
    private $db;
    public function __construct(){
        //Conexion a la base de datos        
        $this->db = Database::connect();
    }

    //Consulta por todas la ventas
    public function consulta(){
        $stmt = $this->db->query("SELECT * FROM VENTAS");
        return $stmt->fetchAll();
    }

    //Consulta de venta segun el identificador
    public function consulta_id($id){
        $stmt = $this->db->prepare("SELECT * FROM VENTAS WHERE IDE_VENTA = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }  

    //Creacion de una registro en la ventas de marcas
    public function create($data){
        $stmt = $this->db->prepare("INSERT INTO VENTAS (IDE_PRENDA, MON_TOTAL, FEC_REGISTRO, IDE_ESTADO) VALUES (?, ?, ?, ?)");
        $stmt->execute([$data["ide_prenda"], $data["mon_total"], $data["fec_registro"], $data["ide_estado"]]);
        return ["id" => $this->db->lastInsertId()];
    }     

    //actualización de un registro en la tabla ventas por su id    
    public function update($id, $data){
        $stmt = $this->db->prepare("UPDATE VENTAS SET IDE_PRENDA = ?, MON_TOTAL = ?, FEC_REGISTRO = ?, IDE_ESTADO = ? WHERE IDE_VENTA = ?");
        $stmt->execute([$data["ide_prenda"], $data["mon_total"], $data["fec_registro"], $data["ide_estado"], $id]);
        return ["success" => true];
    }   

    //eliminación de un registro en la tabla ventas segun su identificador
    public function delete($id){
        try {
            $stmt = $this->db->prepare("DELETE FROM VENTAS WHERE IDE_VENTA = ?");
            $stmt->execute([$id]);
            return ["success" => true];       
        } catch (Exception $e) {
            echo $e;
            return ["success" => false];     
        }

    }     
}