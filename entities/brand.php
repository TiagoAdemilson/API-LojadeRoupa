<?php
class Brand{

    // Connection instance
    private $connection;

    // table name
    private $table_name = "Brand";

    // table columns
    public $id;
    public $brand_name;
    public $created_at;
    public $updated_at;

    public function __construct($connection){
        $this->connection = $connection;
    }

    //C
    public function create($data){

        $query = "INSERT INTO brand(brand_name) VALUES ('".$data."')";

        $stmt = $this->connection->prepare($query);

        $stmt->execute();

        $rs = $this->connection->lastInsertId() or die(print_r($stmt->errorInfo(), true));

        return $rs;
    }
    //R
    public function read(){
        $query = "SELECT c.name as family_name, 
        p.id, 
        p.sku, 
        p.barcode, 
        p.name, 
        p.price, 
        p.unit, 
        p.quantity, 
        p.minquantity, 
        p.createdAt, 
        p.updatedAt 
        FROM" . $this->table_name . " p 
        LEFT JOIN Family c ON p.family_id = c.id 
        ORDER BY p.createdAt DESC";

        $stmt = $this->connection->prepare($query);

        $stmt->execute();

        return $stmt;
    }
    //U
    public function update(){}
    //D
    public function delete(){}

    public function checkBrand($data){

        $query = "SELECT id FROM brand WHERE brand_name like '%".$data."%'"; 
        
        $stmt = $this->connection->query($query);

        $stmt->execute();

        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $res;
    }
}