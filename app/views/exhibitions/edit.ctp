<div class="exhibitions form">
<?php echo $form->create('Exhibition');?>
	<fieldset>
 		<legend><?php __('Edit Exhibition');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('title');
		echo $form->input('notes');
		echo $form->input('Work');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('Exhibition.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Exhibition.id'))); ?></li>
		<li><?php echo $html->link(__('List Exhibitions', true), array('action' => 'index'));?></li>
		<li><?php echo $html->link(__('List Works', true), array('controller' => 'works', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Work', true), array('controller' => 'works', 'action' => 'add')); ?> </li>
	</ul>
</div>
