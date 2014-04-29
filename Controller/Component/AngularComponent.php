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
  }

  
}
?>