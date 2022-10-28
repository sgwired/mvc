<?php
namespace App;

use Core\Model;

/**
 * 
 * @author sheltong
 *
 *PHP version 7
 */
class Auth
{

    /**
     * Login the user
     * 
     * @param User $user The user Model
     * 
     * @return void
     */
    public static function login($user)
    {
        session_regenerate_id(true);
        
        $_SESSION['user_id'] = $user->id;
    }
    
    /*
     * Log out the user
     * 
     * @return void
     */
    public static function logout()
    {
        // Unset all of the session variables.
        $_SESSION = array();
        
        // If it's desired to kill the session, also delete the session cookie.
        // Note: This will destroy the session, and not just the session data!
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
                );
        }
        
        // Finally, destroy the session.
        session_destroy();
    }
    
    /**
     * Return indicator of whether a user is logged in or not
     * 
     * @return boolean
     *
     */
    public static function isLoggedIn()
    {
        return isset($_SESSION['user_id']);
    }
    
    /**
     * Remember the orginally-requested page in the session
     * 
     * @return boolean
     */
    public static function rememberRequestedPage()
    {
        $_SESSION['return_to'] = $_SERVER['REQUEST_URI'];
    }
    
    /**
     * Get the orginally-requested page to return to after requiring login, or default to the homepage
     * 
     * @return void
     */
    public static function getReturnToPage()
    {
        return $_SESSION['return_to'] ?? '/';
    }
}

