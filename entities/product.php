<?php
class Product{

    // Connection instance
    private $connection;

    // table name
    private $table_name = "Product";

    // table columns
    public $id;
    public $code_product;
    public $product_name;
    public $size;
    public $price;
    public $brand_id;
    public $created_at;
    public $updated_at;

    public function __construct($connection){
        $this->connection = $connection;
    }

    //C
    public function create($data){

        $query = "INSERT INTO product(code_product, product_name, size, price, brand_id) VALUES (?,?,?,?,?)";

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

    public function checkProduct($data){

        $query = "SELECT id FROM product WHERE product_name like '%?%' and size = ?"; 
        
        $stmt = $this->connection->prepare($query);

        $stmt->execute();

        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $res;
    }
}