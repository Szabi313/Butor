<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class NoLoggingException extends Exception{
	
	function __construct($message=NULL, $code=NULL, $previous=NULL){
		parent::__construct($message=NULL, $code=NULL, $previous=NULL);
	}
}
