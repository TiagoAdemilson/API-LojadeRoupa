<?php
class Customer {

    // Connection instance
    private $connection;

    // table name
    private $table_name = "Customer";

    // table columns
    public $id;
    public $client_name;
    public $cpf;
    public $created_at;
    public $updated_at;

    public function __construct($connection){
        $this->connection = $connection;
    }

    //C
    public function create($data){

        $query = "INSERT INTO customer(client_name, cpf) VALUES (?,?)";

        $stmt = $this->connection->prepare($query);

        $stmt->execute($data);

        $rs = $this->connection->lastInsertId() or die(print_r($stmt->errorInfo(), true));
        
        return $rs;
        

    }
    //R
    public function listaOrderByMinValue(){
        
        $query = "SELECT c.client_name,p.amount FROM customer c 
        LEFT JOIN ped p ON p.customer_id = c.id
        ORDER BY p.amount ASC";

        $stmt = $this->connection->prepare($query);

        $stmt->execute();

        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $res;
    }
    
    public function MaiorCompraUnica2019(){
        
        $query = "SELECT c.client_name,p.amount FROM customer c 
        LEFT JOIN ped p ON p.customer_id = c.id
        ORDER BY p.amount ASC";

        $stmt = $this->connection->prepare($query);

        $stmt->execute();

        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $res;
    }
    
    public function MaisRealizaramCompras2018(){
        
        $query = "SELECT c.client_name,p.amount FROM customer c 
        LEFT JOIN ped p ON p.customer_id = c.id
        ORDER BY p.amount ASC";

        $stmt = $this->connection->prepare($query);

        $stmt->execute();

        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $res;
    }

    public function checkCPF($data){

        $query = "SELECT id FROM customer WHERE cpf like '%".$data."%'"; 
        
        $stmt = $this->connection->query($query);

        $stmt->execute();

        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $res;
    }

}