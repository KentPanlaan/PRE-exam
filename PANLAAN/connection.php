<?php
$newconnection = new Connection();


Class Connection{
    private $server = "mysql:host=localhost;dbname=pan";
    private $user ="root";
    private $pass="";
    private $options=
    array(PDO:: ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_OBJ);
    protected $con;

    public function openConnection(){
        try {
            $this->con = new PDO($this->server,$this->user,$this->pass,$this->options);
            return $this->con;
        } catch (PDOException $th) {
            echo"There is a problem in the connection". $th->getMessage();
        }
    }

public function closeConnection(){
    $this->con = null;
}

public function addStudent(){
    if(isset($_POST['addstudent'])){
 
        $Category = $_POST['Category'];
        $ProductName = $_POST['ProductName'];
        $Quantity = $_POST['Quantity'];
        $RetailPrice = $_POST['RetailPrice'];            
        $DateofPurchase = $_POST['DateofPurchase'];
        
        
        
        
        
        try{
            $connection = $this->openConnection();
            $query="INSERT INTO product(Category,`ProductName`,`Quantity`,`RetailPrice`,`DateofPurchase`) VALUES (?,?,?,?,?)";
            $stmt =$connection->prepare($query);
            $stmt->execute([$Category,$ProductName,$Quantity,$RetailPrice,$DateofPurchase]);
        }catch(PDOException $th){
        
            echo"Error:".$th->getMessage();
        }
        }
    }
//Delete
public function deleteStudent(){
    if(isset($_POST['delete_student'])){

    $ProductID = $_POST['delete_student'];
    try{
        $connection = $this->openConnection();
        $query = "DELETE FROM product WHERE ProductID = :ProductID";
        $stmt = $connection->prepare($query);
        $query_execute = $stmt->execute(["ProductID"=>$ProductID]);
        if ($query_execute ){
            echo '<script>alert("Deleted")</script>';
        }   
    }catch(PDOException $th){
        echo "Error:".$th->getMessage();
    }
    }
}

//edit
public function editStudent()
{

        if(isset($_POST['editstudent']))
        {
            $ProductID = $_POST['ProductID'];
            $Category = $_POST['Category'];
            $ProductName = $_POST['ProductName'];
            $Quantity = $_POST['Quantity'];
            $RetailPrice = $_POST['RetailPrice'];            
            $DateofPurchase = $_POST['DateofPurchase'];
        
        try 
    {
            $connection = $this->openConnection();
            $query = "UPDATE product SET Category=:Category,ProductName=:ProductName,Quantity=:Quantity,RetailPrice=:RetailPrice,DateofPurchase=:DateofPurchase WHERE ProductID = :ProductID";
            $stmt = $connection->prepare($query);
            $data = [
            ':Category' =>$Category, 
            ':ProductName' =>$ProductName,
            ':Quantity' =>$Quantity,
            ':RetailPrice' =>$RetailPrice,
            ':DateofPurchase' =>$DateofPurchase, 
            ':ProductID' =>$ProductID
            ];
            $stmt->execute($data);
        } 
        catch(PDOExeption $th)
        {
            echo "Error:".$th->getMessage();
        }

      }
    }
}



?>