
  <?php
  if (!defined('_PS_VERSION_'))
    exit;
   
  class Wim_objectlogguer extends Module
  {

    // ObjectModel

    public function __construct()
  {
    $this->name = 'wim_objectlogguer';
    $this->tab = 'front_office_features';
    $this->version = '1.0.0';
    $this->author = 'Firstname Lastname';
    $this->need_instance = 0;
    $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_); 
    $this->bootstrap = true;
 
    parent::__construct();
 
    $this->displayName = $this->l('wim_objectlogguer');
    $this->description = $this->l('Description of my module.');
 
    $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
 
    if (!Configuration::get('MYMODULE_NAME')) {      
      $this->warning = $this->l('No name provided');

    }

  }


    public function install()
    {    
       include(dirname(__FILE__).'\sql\install.php');
       return parent::install();
    }

    


  }



  




