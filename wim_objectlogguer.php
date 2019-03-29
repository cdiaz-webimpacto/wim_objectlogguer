
  <?php
 
 
    require_once ('classes/ObjectLogger.php');

  if (!defined('_PS_VERSION_'))
    exit;
   
  class Wim_objectlogguer extends Module
  {

    

    public function __construct()
  {
    $this->name = 'wim_objectlogguer';
    $this->tab = 'front_office_features';
    $this->version = '1.0.0';
    $this->author = 'Carlos';
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
       // return parent::install();

       
       return parent::install() &&
       $this->registerHook('actionObjectAddAfter') &&
       $this->registerHook('actionObjectDeleteAfter') &&
       $this->registerHook('actionObjectUpdateAfter');
       
    }

    

    public function hookActionObjectAddAfter($params)
    {

      $annad = new ObjectLogger();
      $annad->affected_object = $params['object']->id;
      $annad->action_type = 'add';
      $annad->object_type = get_class($params['object']);
      $annad->message = "Object ". get_class($params['object']) . " with id " . $params['object']->id . " add";
      $annad->date_add = date("Y-m-d H:i:s");

      if(get_class($params['object']) != 'ObjectLogger') {

        $annad->add();

      }

    }


    public function hookActionObjectDeleteAfter($params)
    {

      $dele = new ObjectLogger();
      $dele->affected_object = $params['object']->id;
      $dele->action_type = 'delete';
      $dele->object_type = get_class($params['object']);
      $dele->message = "Object ". get_class($params['object']) . " with id " . $params['object']->id . " delete";
      $dele->date_add = date("Y-m-d H:i:s");

      if(get_class($params['object']) != 'ObjectLogger') {

        $dele->add();

      }

    }

    public function hookActionObjectUpdateAfter($params)
    {

      $up = new ObjectLogger();
      $up->affected_object = $params['object']->id;
      $up->action_type = 'Update';
      $up->object_type = get_class($params['object']);
      $up->message = "Object ". get_class($params['object']) . " with id " . $params['object']->id . " update";
      $up->date_add = date("Y-m-d H:i:s");

      if(get_class($params['object']) != 'ObjectLogger') {

        $up->add();

      }

    }
    
  }
