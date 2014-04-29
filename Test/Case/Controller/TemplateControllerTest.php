<?php
App::uses('TemplateController', 'Angular.Controller');

/**
 * TemplateController Test Case
 *
 */
class TemplateControllerTest extends ControllerTestCase {


/**
 * testIndex method
 *
 * @return void
 */
	public function testIndex() 
	{
	  $this->testAction( '/angular/template?t=Entry.entries/_row:row_id=99;key=value');
	  $this->assertEqual( @$this->vars ['row_id'], 99);
    $this->assertEqual( @$this->vars ['key'], 'value');
	}

}
