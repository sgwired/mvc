<?php
namespace App;

/**
 * 
 * @author sheltong
 *
 * Flash notification messages: messages for one-time display using the session 
 * for storage between requests
 * 
 * PHP version 7
 */
class Flash
{
    /**
     * Success message type
     * @var string
     */
     const SUCCESS = 'success';
     
     /**
      * Info message type
      * @var string
      */
     const INFO = 'info';
     
     /**
      * Warning message type
      * @var string
      */
     const WARNING = 'warning';
     
     
    /**
     * Add a message
     * 
     * @param string $message The message content
     * 
     * @return void
     */
    public static function addMessage($message, $type ='success')
    {
        // Create array in the session if it doesn't alreay exists
        if (! isset($_SESSION['flash_notifications'])) {
            $_SESSION['flash_notifications'] = [];
        }
        
        // Append the message to the array
        $_SESSION['flash_notifications'][] = [
            'body' => $message,
            'type' => $type
        ];
    }
    
    /**
     * Get all the messages
     * 
     * @return mixed An array with all the messages or null if none set
     */
    public static function getMessages()
    {
        if(isset($_SESSION['flash_notifications'])) {
            $message =  $_SESSION['flash_notifications'];
            unset($_SESSION['flash_notifications']);
            return $message;
        }
    }
}

