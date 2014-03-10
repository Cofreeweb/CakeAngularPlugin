<?php
/**
 * SeterHelper
 * 
 * [Short Description]
 *
 * @package default
 * @author Alfonso Etxeberria
 * @version $Id$
 * @copyright __MyCompanyName__
 **/

class SeterHelper extends AppHelper 
{ 
  public $helpers = array('Html', 'Form');

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