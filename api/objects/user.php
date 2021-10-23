<?php
// 'user' object
class User{
 
    // database connection and table name
    private $conn;
    private $table_name = "usuario";
 
    // object properties
    public $id;
    public $firstname;
    public $lastname;
    public $email;
    public $password;
    public $typeAccount;
    public $gender;
    public $birthday;
    
    
 
    // constructor
    public function __construct($db){
        $this->conn = $db;
    }
 
    // create new user record
    function create(){
    
        // insert query
        $query = "INSERT INTO " . $this->table_name . "
                SET
                usuarioNombre = :firstname,
                usuarioApellido = :lastname,
                usuarioEmail = :email,
                usuarioTipo = :typeAccount,
                usuarioFechaNacimiento = :birthday,
                usuarioGenero = :gender,
                usuarioContraseña = :password";
    
        // prepare the query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        //https://www.php.net/manual/en/function.htmlspecialchars.php
        $this->firstname=htmlspecialchars(strip_tags($this->firstname));
        $this->lastname=htmlspecialchars(strip_tags($this->lastname));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->password=htmlspecialchars(strip_tags($this->password));
        $this->typeAccount=htmlspecialchars(strip_tags($this->typeAccount));
        $this->gender=htmlspecialchars(strip_tags($this->gender));
        $this->birthday=htmlspecialchars(strip_tags($this->birthday));
        
        

        // bind the values
        $stmt->bindParam(':firstname', $this->firstname);
        $stmt->bindParam(':lastname', $this->lastname);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':typeAccount', $this->typeAccount);
        $stmt->bindParam(':gender', $this->gender);
        $stmt->bindParam(':birthday', $this->birthday);
     
        
        // hash the password before saving to database
        $password_hash = password_hash($this->password, PASSWORD_BCRYPT);
        $stmt->bindParam(':password', $password_hash);
    
        // execute the query, also check if query was successful
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }
    
    // emailExists() 
    // check if given email exist in the database
    function emailExists(){
    
        // query to check if email exists
        $query = "SELECT usuarioId, usuarioNombre, usuarioApellido, usuarioContraseña, usuarioTipo, usuarioGenero, usuarioFechaNacimiento
                FROM " . $this->table_name . "
                WHERE usuarioEmail = ?
                LIMIT 0,1";
    
                           

        // prepare the query
        $stmt = $this->conn->prepare( $query );
    
        // sanitize
        $this->email=htmlspecialchars(strip_tags($this->email));
    
        // bind given email value
        $stmt->bindParam(1, $this->email);
    
        // execute the query
        $stmt->execute();
    
        // get number of rows
        $num = $stmt->rowCount();
    
        // if email exists, assign values to object properties for easy access and use for php sessions
        if($num>0){
    
            // get record details / values
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
    

            // assign values to object properties
            $this->id = $row['usuarioId'];
            $this->firstname = $row['usuarioNombre'];
            $this->lastname = $row['usuarioApellido'];
            $this->password = $row['usuarioContraseña'];
            $this->typeAccount = $row['usuarioTipo'];
            $this->gender = $row['usuarioGenero'];
            $this->birthday = $row['usuarioFechaNacimiento'];
            
    
            // return true because email exists in the database
            return true;
        }
    
        // return false if email does not exist in the database
        return false;
    }

    function emailCheck(){
    
        // query to check if email exists
        $query = "SELECT usuarioNombre
                FROM " . $this->table_name . "
                WHERE usuarioEmail = ?
                LIMIT 0,1";
    
                           

        // prepare the query
        $stmt = $this->conn->prepare( $query );
    
        // sanitize
        $this->email=htmlspecialchars(strip_tags($this->email));
    
        // bind given email value
        $stmt->bindParam(1, $this->email);
    
        // execute the query
        $stmt->execute();
    
        // get number of rows
        $num = $stmt->rowCount();
    
        // if email exists, assign values to object properties for easy access and use for php sessions
        if($num>0){
    
            // return true because email exists in the database
            return false;
        }
    
        // return false if email does not exist in the database
        return true;
    }
 
    // update a user record
    public function update(){
    
        // if password needs to be updated
        $password_set=!empty($this->password) ? ", usuarioContraseña = :password" : "";
    
        // if no posted password, do not update the password
        $query = "UPDATE " . $this->table_name . "
                SET
                usuarioNombre = :firstname,
                usuarioApellido = :lastname,
                usuarioFechaNacimiento = :birthday,
                usuarioGenero = :gender,
                usuarioEmail = :email
                    {$password_set}
                WHERE id = :id";


    
        // prepare the query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->firstname=htmlspecialchars(strip_tags($this->firstname));
        $this->lastname=htmlspecialchars(strip_tags($this->lastname));
        $this->email=htmlspecialchars(strip_tags($this->email));
    
        // bind the values from the form
        $stmt->bindParam(':firstname', $this->firstname);
        $stmt->bindParam(':lastname', $this->lastname);
        $stmt->bindParam(':birthday', $this->birthday);
        $stmt->bindParam(':gender', $this->gender);
        $stmt->bindParam(':email', $this->email);
    
        // hash the password before saving to database
        if(!empty($this->password)){
            $this->password=htmlspecialchars(strip_tags($this->password));
            $password_hash = password_hash($this->password, PASSWORD_BCRYPT);
            $stmt->bindParam(':password', $password_hash);
        }
    
        // unique ID of record to be edited
        $stmt->bindParam(':id', $this->id);
    
        // execute the query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }
}