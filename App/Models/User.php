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
    public function __construct($data = [])
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
        
        if (static::emailExists($this->email)) {
            $this->errors[] = "Email is already used";
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
    public static function emailExists($email)
    {
        
       return static::findByEmail($email) !== false;
    }
    
    /**
     * Find a user by email address
     * 
     * @param string $email email address to search for
     * 
     * $return mixed User object if found, false if otherwise
     */
    public static function findByEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(":email", $email, PDO::PARAM_STR);
        
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        
        $stmt->execute();
        
        return $stmt->fetch();
    }
    
    /**
     * Authenticate a user by email and password
     * 
     * @param string $email email address
     * @param string $password password
     * 
     * @return mixed The user object or false if authentication fails
     */
    public static function authenticate($email, $password)
    {
        $user = static::findByEmail($email);
        
        if($user && password_verify($password, $user->password_hash)) {
                return $user;
        }
        
        return false;
    }
}

