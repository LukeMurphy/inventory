<?php
class StatusHelper extends FormHelper  {
	var $helpers = array('Form');

	function select($fieldname, $label, $default="  ", $attributes = array())
	{
		$list = '<div class="input">';
		$list .= $this->Form->label($label);

		$yearArray = array(
            '--' => 'None',
            'on consignment' => 'on consignment',
            'sold' => 'sold',
            'destroyed' => 'destroyed',
            'missing' => 'missing',
            'other' => 'other'
            );

            $list .= $this->Form->select($fieldname , $yearArray, $default, $attributes);
            $list .= '</div>';
            return $this->output($list);
	}
}