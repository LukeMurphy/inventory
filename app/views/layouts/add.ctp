<div class="locations form">
<?php echo $form->create('Location');?>
	<fieldset>
 		<legend><?php __('Add Location');?></legend>
	<?php
		echo $form->input('work_id');
		echo $form->input('date');
		echo $form->input('location');
		echo $form->input('notes');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Locations', true), array('action' => 'index'));?></li>
	</ul>
</div>
