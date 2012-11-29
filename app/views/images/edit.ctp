<div class="images form">
<?php echo $form->create('Image');?>
	<fieldset>
 		<legend><?php __('Edit Image');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('title');
		echo $form->input('work_id');
		echo $form->input('path');
	?>
	<img src="/<?php echo $image['Image']['path'];?>_med.jpg">
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('Image.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Image.id'))); ?></li>
		<li><?php echo $html->link(__('List Images', true), array('action' => 'index'));?></li>
		<li><?php echo $html->link(__('List Works', true), array('controller' => 'works', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Work', true), array('controller' => 'works', 'action' => 'add')); ?> </li>
	</ul>
</div>
