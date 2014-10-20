<?php
/**
 * SeterHelper
 * 
 * [Short Description]
 *
 * @package angular.view.helper
 **/

class SeterHelper extends AppHelper 
{ 
  public $helpers = array( 'Html', 'Form');
/**
 * Setea variables en $rootScope del modulo indicado de AngularJS
 *
 * Es necesario que estén seteados $this->settings ['vars'] y $this->settings ['module']
 *
 * @return void
 */
  public function beforeLayout($layoutFile)
  {
    // Comprueba que no estén vacios estas dos variables
    if( empty( $this->settings ['vars']) || empty( $this->settings ['module']))
    {
      return;
    }
    
    // Variable donde se guardarán las lineas de código
    $sets = array();
    
    // Recorre las variables pedidas desde la configuración del Helper
    foreach( $this->settings ['vars'] as $name)
    {
      // Comprueba que la variable esté seteada en la vista
      if( array_key_exists( $name, $this->_View->viewVars))
      {
        $sets [] = '$rootScope.'. $name .' = '. json_encode( $this->_View->viewVars [$name]) .';';
      }
      
    }
    
    // Setea las variables en el módulo de AngularJS
    $script = $this->settings ['module'] .'.run( function( $rootScope){
      '. implode( ' ', $sets) .'
    });';
    
    $this->Html->scriptBlock( $script, array(
        'inline' => false,
    	  'block' => 'scriptBottom'
    ));
  }
	
  public function setNgVars( $app)
  {
    if( isset( $this->_View->viewVars ['ngVars'][$app]))
    {
      // Variable donde se guardarán las lineas de código
      $sets = array();

      foreach( $this->_View->viewVars ['ngVars'][$app] as $name => $value)
      {
        // Comprueba que la variable esté seteada en la vista
        $sets [] = '$rootScope.'. $name .' = '. json_encode( $value) .';';
      }

      $script = 'angular.module( "'. $app .'").run( function( $rootScope){
        '. implode( ' ', $sets) .'
      });';

      return $this->Html->scriptBlock( $script);
    }
    
  }

  public function val( $value, $key)
  {
    if( isset( $value))
    {
      return $value;
    }
    
    if( strpos( $key, '[') !== false)
    {
      return $key;
    }
    
    return "{{". $key ."}}";
  }
}