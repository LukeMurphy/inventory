<?php
class YearListHelper extends FormHelper  {
	var $helpers = array('Form');

	function select($fieldname, $label, $default="  ", $attributes = array())
	{
		$list = '<div class="input">';
		$list .= $this->Form->label($label);

		$yearArray = array(
            '--' => 'None'
            );

            for ($i=1960; $i<2010; $i++) {
            	//array_push($yearArray , array((string)$i,$i));
            	$yearArray[$i] = $i;
            }


            $list .= $this->Form->select($fieldname , $yearArray, $default, $attributes);
            $list .= '</div>';
            return $this->output($list);
	}
}