<div class="works form"><?php echo $form->create('Work', array('method'=>'post','enctype'=>'multipart/form-data'));?>
	<fieldset class="related">
 		<legend><?php __('Edit Work');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('inventory_id', array('size'=>'5','type'=>'text','label'=>'Inventory ID (suggested)'));
		echo $form->input('inventory_tag', array('size'=>'5','label'=>'Inventory Tag (eg. studio #)'));
		echo "<br clear=all>";
		echo $form->input('title');
		//echo $form->input('date_year', array('label'=>'Date','type'=>'text','size'=>'5'));
		e( $yearList->select('date_year', 'YEAR', $work['Work']['date_year']));
		echo $form->input('date_general', array('size'=>'5','label'=>'Month or Day (optional)'));
		echo "<br clear=all>";
		echo $form->input('height', array('size'=>'5'));
		echo $form->input('width', array('size'=>'5'));
		echo "<br clear=all>Upload new or additonal images:<br>" . $form->file('Image/filedata1');
		echo "<br>" . $form->file('Image/filedata2');
		echo "<br>" . $form->file('Image/filedata3');
		echo "<br clear=all>";
		echo "<br clear=all>";
		echo "<hr>";
		echo "<strong>consignment or Location changes:</strong>";
		echo "<br clear=all>";
		echo "<br clear=all>";
		echo $form->input('location',array('label'=>'Add a new location if it has changed'));
		echo $form->input('location/date',array('label'=>'Date of new location'));
		//echo $form->input('consignment',array('label'=>'Current consignment'));
		e( $consignment->select('consignment', 'consignment', $work['Work']['consignment']));
		e( $status->select('status', 'status', $work['Work']['status']));
		echo $form->input('Exhibition');
		//echo $form->input('status', array('size'=>'20'));
		echo "<br clear=all>";
		echo "<hr>";
		echo $form->input('notes');
		echo "<br>" . $form->end('SAVE');
	?>
	<br clear='all' />
	<div class="actions">
	<ul>
		<?php if(in_array("admin",$permissions)) {?>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('Work.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Work.id'))); ?></li>
		<li><?php echo $html->link(__('List Works', true), array('action' => 'index'));?></li>
		<?php }?>
	</ul>
</div>
	
	</fieldset>
</div>

<div class="related">
	<h3><?php __('Related Images');?></h3>
	<?php if (!empty($work['Image'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Title'); ?></th>
		<th><?php __('Path'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($work['Image'] as $image):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $image['title'];?></td>
			<td><?php 
			//echo '<img src="' . $imagePath .$image['path'] . '_small.jpg">'
			echo $html->link(
			$html->image( $imagePath . $image['path'] . '_small.jpg', array("alt" => "")),
			array('controller' => 'images', 'action' => 'view', $image['id']),
			array('escape'=>false)
			);
			?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller' => 'images', 'action' => 'view', $image['id'])); ?>
				<?php if(in_array("admin",$permissions)) {?>
				<?php //echo $html->link(__('Edit', true), array('controller' => 'images', 'action' => 'edit', $image['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller' => 'images', 'action' => 'delete', $image['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $image['id'])); ?>
				<?php }?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php //echo $html->link(__('New Image', true), array('controller' => 'images', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>

<div class="related">
	<h3><?php __('Location history');?></h3>
	<?php if (!empty($work['Location'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Date'); ?></th>
		<th><?php __('Location'); ?></th>
		<th><?php __('Notes'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($work['Location'] as $image):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $image['date'];?></td>
			<td><?php echo $image['location'];?></td>
			<td><?php echo $image['notes'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller' => 'locations', 'action' => 'view', $image['id'])); ?>
				<?php if(in_array("admin",$permissions)) {?>
				<?php echo $html->link(__('Edit', true), array('controller' => 'locations', 'action' => 'edit', $image['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller' => 'locations', 'action' => 'delete', $image['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $image['id'])); ?>
				<?php }?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php //echo $html->link(__('New Image', true), array('controller' => 'images', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>

<div class="related">
	<h3><?php __('Exhibition history');?></h3>
	<?php if (!empty($work['Location'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('id'); ?></th>
		<th><?php __('Exhibition'); ?></th>
		<th><?php __('Notes'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($work['Exhibition'] as $image):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $image['id'];?></td>
			<td><?php echo $image['title'];?></td>
			<td><?php echo $image['notes'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller' => 'exhibitions', 'action' => 'view', $image['id'])); ?>
				<?php if(in_array("admin",$permissions)) {?>
				<?php echo $html->link(__('Edit', true), array('controller' => 'exhibitions', 'action' => 'edit', $image['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller' => 'exhibitions', 'action' => 'delete', $image['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $image['id'])); ?>
				<?php }?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php //echo $html->link(__('New Image', true), array('controller' => 'images', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>

