<div class="exhibitions form">
<?php echo $form->create('Exhibition');?>
	<fieldset>
 		<legend><?php __('Add Exhibition');?></legend>
	<?php
		echo $form->input('title');
		echo $form->input('notes');
		echo $form->input('Work');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Exhibitions', true), array('action' => 'index'));?></li>
		<li><?php echo $html->link(__('List Works', true), array('controller' => 'works', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Work', true), array('controller' => 'works', 'action' => 'add')); ?> </li>
	</ul>
</div>
