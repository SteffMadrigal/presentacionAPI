<?php
require_once '../src/db/Database.php';

class Reporte{
    private $db;
    public function __construct(){
        $this->db = Database::connect();
    }

    //consulta de reporte, las marcas mas vendidas
    public function marcasMasVendidas(){
        $stmt = $this->db->query("SELECT * FROM MARCAS_MAS_VENDIDAS");
        return $stmt->fetchAll();
    }

    //consulta de reporte, marcas vendidas    
    public function marcasVentas(){
        $stmt = $this->db->query("SELECT * FROM MARCAS_VENTAS");
        return $stmt->fetchAll();
    }    

    //consulta de reporte, mascas en stock 
    public function marcasStock(){
        $stmt = $this->db->query("SELECT * FROM VENTAS_STOCK");
        return $stmt->fetchAll();
    }    
}