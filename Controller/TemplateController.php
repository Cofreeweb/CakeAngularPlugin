<?php

App::uses('EntryAppController', 'Entry.Controller');

/**
 * TemplateController
 * 
 * Se encarga de tomar los templates, que estarán situados en las vistas
 *
 * @package Angular.Controller
 **/

class TemplateController extends AngularAppController 
{
  public $name = 'Template';
  
  public $uses = array();
  
  // public $helpers = array( 'Entry.Entry');
  
  public function beforeFilter()
  {
    parent::beforeFilter();
    
    if( isset( $this->Auth))
    {
      $this->Auth->allow();
    }
  }

/**
 * Recoge un template de Angular 
 * Los ficheros tienen que estar en los directorios convencionales de View y tener la extensión .ns
 *
 * @example /angular/template?t=Section.sections/index
 * @return void
 */
  public function index()
  {
    $this->set( 'pathName', $this->pathName);
    
    if( isset( $this->request->query ['t']))
    {
      // Construye la ruta del fichero
      list( $plugin, $path) = pluginSplit( $this->request->query ['t']);
      
      $paths = explode( '/', $path);
      $controller = $paths [0];
      $controller = Inflector::camelize( $controller);
      unset( $paths [0]);
      $path = '../'. $controller .'/' . implode( '/', $paths);
      
      if( strpos( $path, ':') !== false)
      {
        $vars_query = substr( $path, strpos( $path, ':') + 1);
        
        $vars = explode( ';', $vars_query);
        
        foreach( $vars as $var)
        {
          list( $key, $value) = explode( '=', $var);
          $this->set( $key, $value);
        }
        
        $path = substr( $path, 0, strpos( $path, ':'));
      }
      $this->set( compact( 'path', 'plugin'));
    }
    else
    {
      throw new NotFoundException();
    }
  }
}
?>