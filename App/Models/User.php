<?php
namespace App\Models;

use PDO;

/*
 * Example user model
 * 
 * PHP 7
 */
 
class User extends  \Core\Model
{
    /*
     * Error messages
     * 
     * @var array
     */
    public $errors = [];
    
    /**
     * Class constructor
     * 
     * @param array $data Initial property values
     * 
     * @return void
     */
    public function __construct($data)
    {
      
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
        
        
    }
    
    /**
     * Save the user model with the current property values
     *
     * @return void
     */
    public function save()
    {
        $this->validate();
        
        if (empty($this->errors)) {
            $password_hash = password_hash($this->password, PASSWORD_DEFAULT);
            
            $sql = "INSERT INTO users (name, email, password_hash)
                VALUES (:name, :email, :password_hash)";
            
            $db = static::getDB();
            $stmt = $db->prepare($sql);
            
            $stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
            $stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
            $stmt->bindValue(':password_hash', $password_hash, PDO::PARAM_STR);
            
            return $stmt->execute();
        }
   
        return false;
       
    }
    
    /*
     * Validate current property values, add validation error message to errors array property
     * 
     * @return void
     */
    public function validate()
    {
        if ($this->name == '') {
            $this->errors[] = 'Name is required';
        }
        
        if (filter_var($this->email, FILTER_VALIDATE_EMAIL) == false ) {
            $this->errors[] = 'Invalid email';
        }
        
        if ($this->emailExists($this->email)) {
            $this->errors[] = "Email is already used";
        }
        
        if ($this->password != $this->password_confirmation) {
            $this->errors[] = 'Password must match confirmation';
        }
        
        if (strlen($this->password) < 6) {
            $this->errors[] = "Please enter at least 6 characters for the password";
        }
        
        if (preg_match('/.*[a-z]+.*/i',$this->password) == 0){
            $this->errors[] = "Password needs at least one letter";
        }
        
        if (preg_match('/.*\d+.*/i',$this->password) == 0){
            $this->errors[] = "Password needs at least one number";
        }
        
    }
    
    /*
     * See if a user record already exists with the specified email
     * 
     * @param string $email email address to search for
     * 
     * @return boolean True if a record already exists
     */
    public function emailExists($email)
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        
        $stmt->execute();
        
       return $stmt->fetch() !== false;
    }
}

