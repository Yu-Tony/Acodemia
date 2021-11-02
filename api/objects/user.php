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
    

        $call = 'CALL userCreate(?, ?, ?, ?, ?, ?, ?)';
    
        // prepare
        $stmt = $this->conn->prepare($call);
    
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

        $stmt->bindParam(1, $this->firstname);
        $stmt->bindParam(2, $this->lastname);
        $stmt->bindParam(3, $this->email);
        $stmt->bindParam(4, $this->typeAccount);
        $stmt->bindParam(5, $this->birthday);
        $stmt->bindParam(6, $this->gender);

     
        
        // hash the password before saving to database
        $password_hash = password_hash($this->password, PASSWORD_BCRYPT);
        $stmt->bindParam(7, $password_hash);
    
        // execute, also check if was successful
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }
    
    // emailExists() 
    // check if given email exist in the database
    //PARA LOG IN
    function emailExists(){

        $call =  $this->conn->prepare('CALL userEmailExists(:email, @id, @nombre, @apellido, @contrasena, @tipo, @genero, @fechanac)');
        $call->bindParam(':email', $this->email, PDO::PARAM_STR);       

        if($call->execute())
        {
                 
            $select = $this->conn->query('SELECT @id, @nombre, @apellido, @contrasena, @tipo, @genero, @fechanac');
            $result = $select->fetch(PDO::FETCH_ASSOC);
        
            //var_dump($result);
  
            if($result['@id']!=null)
            {
                $this->id = $result['@id'];
                $this->firstname = $result['@nombre'];
                $this->lastname = $result['@apellido'];
                $this->password = $result['@contrasena'];
                $this->typeAccount = $result['@tipo'];
                $this->gender = $result['@genero'];
                $this->birthday = $result['@fechanac']; 

                return true;
            }else{return false;}

        }else{return false;}

    }

    function emailCheck(){
        
        $call =  $this->conn->prepare('CALL userEmailCheck(:email, @nombre)');
        $call->bindParam(':email', $this->email, PDO::PARAM_STR);       

        if($call->execute())
        {
                 
            $select = $this->conn->query('SELECT @nombre');
            $result = $select->fetch(PDO::FETCH_ASSOC);
        
            //var_dump($result);
  
            if($result['@nombre']!=null)
            {
                $this->firstname = $result['@nombre'];
                return true;
            }else{return false;}

        }else{return false;}
    }
 
    // update a user record
    public function update(){
      
         $call = 'CALL userUpdate(?,?,?,?,?,?,?,?)';
    
        // prepare
        $stmt = $this->conn->prepare($call);
    
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
        $stmt->bindParam(1, $this->id);
        $stmt->bindParam(2, $this->firstname);
        $stmt->bindParam(3, $this->lastname);
        $stmt->bindParam(4, $this->email);
        $stmt->bindParam(5, $this->typeAccount);
        $stmt->bindParam(6, $this->birthday);
        $stmt->bindParam(7, $this->gender);
        
        if(!empty($this->password)){
            $password_hash = password_hash($this->password, PASSWORD_BCRYPT);
            $stmt->bindParam(8, $password_hash);
        }else
        {
            $stmt->bindParam(8, $this->password);
        }

    
        // execute, also check if was successful
        if($stmt->execute()){
            return true;
        }
    
       
        return false;
    }
}