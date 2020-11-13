<?php
class Ped{

    // Connection instance
    private $connection;

    // table name
    private $table_name = "Ped";

    // table columns
    public $id;
    public $code;
    public $customer_id;
    public $product_id;
    public $amount;
    public $date_purchase;
    public $created_at;
    public $updated_at;

    public function __construct($connection){
        $this->connection = $connection;
    }

    //C
    public function create($data){

        $query = "INSERT INTO ped(code, customer_id, product_id, amount, date_purchase) VALUES (?,?,?,?,?)";

        $stmt = $this->connection->prepare($query);

        $stmt->execute($data);

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

}