<?php
require_once 'Mail.php';

/**
 * Base class to create an email. Intended to simplify the use of Pear Mail and 
 * Mail_mime classes. 
 * @author Robert Arnold
 * @name Email
 * @copyright Hoover Treated wood products  11/15/2011
 * @category Mail
 * @version 1.0.0 
 */
abstract class Email {

    /**
     * @var string $cont stores the content to include in email
     */
    private $cont;                                                              
    /**
     *
     * @var array $ctrlf stores the carriage return and line feed. The variable
     *  is defaulted to "\n" but can be modified upon object instantiation.
     */
    private $ctrlf;                                                             
    
    /**
     *
     * @var array $headers stores the 'From' and 'Subject' portion of the email 
     */
    private $headers;                                                            
   
    /**
     *
     * @var mixed $rcpts stores the recipients portion of the email.
     */
    private $rcpts;                                                              
    
    /**
     *
     * @var string $backEnd stores the mailer backend type portion of the email.
     * defaulted to 'mail' but can be modified to: ['mail', 'smtp', 'sendmail']
     * upon object instantiation.
     */
    private $backEnd;                                                            

    /**
     * Constructor to instantiate an Email object
     * @param string $cont string of html source content
     * 
     * @param array $headers an associative array of headers SEE EXAMPLES
     * @example $headers = array('From' => 'whoami@notu.com','Subject' => 'Message from whoami')
     * @example $headers['From'] = 'whoami@notu.com' $headers['Subject] = Message from whoami'
     * 
     * @param mixed $rcpts an array or a string with comma separated values SEE EXAMPLES
     * @example $rcpts = array('johndoe@yahoo.com','janedoe@gmail.com')
     * @example $rcpts = array(1 => 'johndoe@yahoo.com', 2 => 'janedoe@gmail.com')
     * 
     * @throws invalid data type on error
     */
    public function __construct($cont, $headers, $rcpts) {
        
        try{
            
            // test each parameter passed in for correct datatype.
            if((!is_string($cont)) || (!is_array($headers)) || (!is_array($rcpts)) ){
                
                throw new Exception('Could not create an instance of the Email class.');
                
                }       
                
                $this->cont = $cont;
                $this->headers = $headers;
                $this->rcpts = $rcpts;
                $this->ctrlf = "\n";                                             // set default to newline
                $this->backEnd = 'mail';                                         // set default backend mailer to mail
                   
        }catch(Exception $e){
            
            echo ('Error! invalid data type passed as an argument to the constructor, '.  $e->getMessage());
            echo (" Email.php line: " . $e->getLine());
            
            }
            
    }
                                                                                           
   /**
    * @method Abstract method that is used to send an email based on the content 
    * provided by the user. The method can be structured to meet the needs 
    * of any email content such as html, pdf, flash, etc... 
    * 
    */
    abstract public function sendEmail();



     /** Getters and setters **/

     public function getCont() {
         return $this->cont;
     }

     public function setCont($cont) {
         $this->cont = $cont;
     }

     public function getCtrlf() {
         return $this->ctrlf;
     }

     public function setCtrlf($ctrlf) {
         $this->ctrlf = $ctrlf;
     }

     public function getHeaders() {
         return $this->headers;
     }

     public function setHeaders($headers) {
         $this->headers = $headers;
     }

     public function getRcpts() {
         return $this->rcpts;
     }

     public function setRcpts($rcpts) {
         $this->rcpts = $rcpts;
     }

     public function getBackEnd() {
         return $this->backEnd;
     }

     public function setBackEnd($backEnd) {
         $this->backEnd = $backEnd;
     }

  }
