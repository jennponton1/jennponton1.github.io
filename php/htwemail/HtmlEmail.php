<?php

require_once 'Email.php';
require_once 'Mail/Mime.php';

/**
 * Child object of the Email class that creates an html formatted email object 
 * based on the contents supplied by the user. This is a custom class that is 
 * designed to simplify the use of the Pear Mail and Mail_mime classes.
 * @name HtmlEmail
 * @author Robert Arnold
 * @copyright Hoover Treated wood products  11/15/2011
 * @category Mail
 * @version 1.0.0
 */
class HtmlEmail extends Email{

    /**
     * Constructor to instantiate an Email object
     * 
     * @param string $cont string of html source content
     * 
     * @param array $headers an associative array of headers SEE EXAMPLES
     * @example $headers = array('From' => 'whoami@notu.com','Subject' => 'Message from whoami')
     * @example $headers['From'] = 'whoami@notu.com' $headers['Subject] = Message from whoami'
     * 
     * @param mixed $rcpts an array or a string with comma separated values SEE EXAMPLES
     * @example $rcpts = array('johndoe@yahoo.com','janedoe@gmail.com')
     * @example $rcpts = array(1 => 'johndoe@yahoo.com', 2 => 'janedoe@gmail.com')
     */
    public function  __construct($cont, $headers, $rcpts) {

        parent::__construct($cont, $headers, $rcpts);

    }

    /**
     * Handles the content in html format and sends an email.
     * @return mixed Returns true on success, or a PEAR_Error
     *               containing a descriptive error message on
     *               failure.
     */
        public function sendEmail(){

            $mime = new Mail_mime($this->getCtrlf());

            $mime->setHTMLBody($this->getCont());
          
            $body = $mime->get();

            $headers = $mime->headers($this->getHeaders());

            $mail = new Mail();

            $mail->factory($this->getBackEnd());

            $result = $mail->send($this->getRcpts(), $headers, $body);
            
            return $result;
        }
    }

