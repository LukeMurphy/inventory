<div class="works form">
<?php echo $form->create('Work');?>
	<fieldset>
 		<legend><?php __('Edit Work');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('inventory_id');
		echo $form->input('inventory_tag');
		echo $form->input('title');
		echo $form->input('date_year');
		echo $form->input('date_general');
		echo $form->input('height');
		echo $form->input('width');
		echo $form->input('notes');
		echo $form->input('consignment');
		echo $form->input('status');
		echo $form->input('Exhibition');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('Work.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Work.id'))); ?></li>
		<li><?php echo $html->link(__('List Works', true), array('action' => 'index'));?></li>
		<li><?php echo $html->link(__('List Images', true), array('controller' => 'images', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Image', true), array('controller' => 'images', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Locations', true), array('controller' => 'locations', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Location', true), array('controller' => 'locations', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Exhibitions', true), array('controller' => 'exhibitions', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Exhibition', true), array('controller' => 'exhibitions', 'action' => 'add')); ?> </li>
	</ul>
</div>
