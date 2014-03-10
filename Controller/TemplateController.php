<?php
/**
 * GetsController
 * 
 * Se encarga de tomar los templates, que estarán alojados en las carpetas de Elements
 *
 * @package Angular.Controller
 * @version $Id$
 * @copyright __MyCompanyName__
 **/

class TemplateController extends AppController 
{
  public $name = 'Template';
  
  public $uses = array();
  
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
      
      $this->set( compact( 'path', 'plugin'));
    }
    else
    {
      throw new NotFoundException();
    }
  }
}
?>