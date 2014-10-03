<?php
/**
 * AngularComponent
 * 
 *
 * @package angular.controller.component
 **/

class AngularComponent extends Component 
{
  public $components = array();
  
/**
 * La variable donde se guardarán las variables setedas en la vista con $this->et() y $this->setScopeBlock()
 * Estas variables se guardan en una key que representa el nombre del módulo de Angular (por lo general y casi siempre "app")
 * Así pues, las variables se guardarán con este formato $ngVars ['app']['key'] = 'value';
 * @var array
 */
  public $ngVars = array();
  

  public function initialize( Controller $Controller)
  {
    $this->Controller = $Controller;
  }


  public function beforeRender( Controller $Controller) 
  {
    if( isset( $Controller->request->params ['ext']) && $Controller->request->params ['ext'] == 'json' && !empty( $Controller->request->data))
    {
      if( !array_key_exists( '_serialize', $Controller->viewVars))
      {
        $Controller->set( 'data', $Controller->request->data);
        $Controller->set( '_serialize', array_keys( $Controller->viewVars));
      }
    }

    $this->setScopeBlock();
  }

/**
 * Setea ngVars en la vista. ngVars son el conjunto de variables seteadas con $this->set()
 * Para escribir las variables es necesario utilizar el helper Angular.Seter->setNgVars( $app)
 */
  public function setScopeBlock()
  {
    if( empty( $this->ngVars))
    {
      return;
    }

    $this->Controller->set( 'ngVars', $this->ngVars);
  }

/**
 * Setea una variable en la vista, usando $this->ngVars
 * @param array $data  
 * @param string $ngApp El nombre del modulo de Angular
 */
  public function set( $data, $ngApp = 'app') 
  {
    if( !isset( $this->ngVars [$ngApp]))
    {
      $this->ngVars [$ngApp] = array();
    }

    $this->ngVars [$ngApp] = $data + $this->ngVars [$ngApp];
  }
  
}
?>