<?php
Abstract Class Controller_Base 
{
  protected $_registry;
  protected $_baseTemplate = null;
  protected $_session = null;

  function __construct($registry) 
  {
    if(!$this->_session){
      $this->_session = session_start();
    }
    $this->_registry = $registry;
    $this->_baseTemplate = $this->_registry->get('template');
  }


  abstract function index();

  protected function _initTemplate($title, $description)
  {
    $this->_baseTemplate->addCss('styles/header.css');
    $this->_baseTemplate->addJs('script/jquery-3.3.1.min.js');
    switch (parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH)) {
      case '/search_users':
      break;
    }

    $parentTemplate = $this->_baseTemplate;
    $parentTemplate->set('title', $title);
    $parentTemplate->set('description', $description);
    return clone $this->_registry->get('template');
  }

  protected function _renderLayout($template, $usePhp = false)
  {
    $parentTemplate = $this->_baseTemplate;

    $headerTemplate = clone $parentTemplate;
    $headerTemplate->setFile('templates/header.phtml'); 
    $headerMenu = new Block_Menu($this->_registry);
    $headerMenu->setFile('templates/header/menu.phtml');  
    $_htmlHeaderMenu = $headerMenu->toHtmlWithPhp();
    $headerTemplate->set('headerMenu', $_htmlHeaderMenu);
    $_htmlheader = $headerTemplate->toHtmlWithPhp();
    $parentTemplate->set('header', $_htmlheader);

    $leftblockTemplate = clone $parentTemplate;
    $leftblockTemplate->setFile('templates/leftblock.phtml');
    $_htmlleftblock = $leftblockTemplate->toHtmlWithPhp();
    $parentTemplate->set('leftblock', $_htmlleftblock);


    if($usePhp){
      $html = $template->toHtmlWithPhp();
    } else {
      $html = $template->toHtml();
    }
    $parentTemplate->set('content', $template->toHtmlWithPhp());

    $footerTemplate = clone $parentTemplate;
    $footerTemplate->setFile('templates/footer.phtml');
    $_htmlfooter = $footerTemplate->toHtmlWithPhp();
    $parentTemplate->set('footer', $_htmlfooter);

  }
}