<?php

class ErrorController extends Zend_Controller_Action {
	
    public function errorAction() {
    	$this->view->layout()->setLayout('error');
        $error = $this->_getParam('error_handler');
        switch ($error->type) {
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ROUTE:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:
                error_log('404 because: '.$error->type);
                $this->getResponse()->setRawHeader('HTTP/1.1 404 Not Found');
                $this->render('404');
                break;
            default:
                $exception = $error->exception;
                error_log('FATAL ERROR by exception: '.$exception->getMessage());
                if ( DEBUG ) {
                	$this->view->exception = $exception;
                    $this->render('debug');
                }
        }
    }
}
