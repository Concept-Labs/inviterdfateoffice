<?php
Class Controller_Authorization Extends Controller_Base 
{
    protected function _initTemplate($title, $description)
    {

      return parent::_initTemplate($title, $description);
      
  }

  public function index() 
  {

    $template = $this->_initTemplate('My Client', '');

    $template->setFile('templates/authorization.phtml');
    
    

    $this->_renderLayout($template, true);
}

public function logout() 
{

    $template = $this->_initTemplate('Logout to My Client', '');

    $template->setFile('templates/authorization/logout.phtml');

    $this->_renderLayout($template, true);
}
}