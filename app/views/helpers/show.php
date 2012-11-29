<?php
class ShowHelper extends FormHelper  {
	var $helpers = array('Form');

	function select($fieldname, $label, $default="  ", $attributes = array())
	{
		$list = '<div class="input">';
		$list .= $this->Form->label($label);

		$showArray = array(
            '--' => 'None',
            '1' => 'CANADA',
            '2' => 'HOLD'
            );

            $list .= $this->Form->select($fieldname , $showArray, $default, $attributes);
            $list .= '</div>';
            return $this->output($list);
	}
}