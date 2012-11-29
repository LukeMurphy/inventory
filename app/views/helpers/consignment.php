<?php
class ConsignmentHelper extends FormHelper  {
	var $helpers = array('Form');

	function select($fieldname, $label, $default="  ", $attributes = array())
	{
		$list = '<div class="input">';
		$list .= $this->Form->label($label);

		$yearArray = array(
            '--' => 'None',
            'Olga-Korper' => 'Olga-Korper',
            'Page-Strange' => 'Page-Strange',
            'Wynick-Tuck' => 'Wynick-Tuck',
            'CANADA' => 'CANADA',
            'Other' => 'Other',
            'RESERVED' => 'RESERVED',
            'In storage' => 'In storage',
            'NFS-Estate' => 'NFS-Estate'
            );

            $list .= $this->Form->select($fieldname , $yearArray, $default, $attributes);
            $list .= '</div>';
            return $this->output($list);
	}
}