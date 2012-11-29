<div class="works_view">
<h3><?php  __('Work');?></h3>
	<?php $i = 0; $class = ' class="altrow"';?>
		<div <?php echo $class;?>>
		<?php __('Inventory Id'); ?> : 
			<span class="bold"><?php echo $work['Work']['inventory_id']; ?></span>
		</div>
		<div <?php echo $class;?>>
		<?php __('Inventory Tag'); ?> : 
			<span class="bold"><?php echo $work['Work']['inventory_tag']; ?></span>
		</div>
		<div <?php //echo $class;?>>
		<?php __('Title'); ?> : 
			<span class="bold"><?php echo $work['Work']['title']; ?></span>
		</div>
		<div <?php echo $class;?>>
		<?php __('Date Year'); ?> : 
			<span class="bold"><?php echo $work['Work']['date_year']; ?></span>
		</div>
		<div <?php //echo $class;?>>
		<?php __('Date General'); ?> : 
			<span class="bold"><?php echo $work['Work']['date_general']; ?></span>
		</div>
		<div <?php echo $class;?>>
		<?php __('Height'); ?> : 
			<span class="bold"><?php echo $work['Work']['height']; ?></span>
			 [x] 
		<?php __('Width'); ?> : 
			<span class="bold"><?php echo $work['Work']['width']; ?></span>
		</div>
		<div <?php //echo $class;?>>
		<?php __('Notes'); ?> : 
			<span class="bold"><?php echo $work['Work']['notes']; ?></span>
		</div>
		<div <?php echo $class;?>>
		<?php __('consignment'); ?> : 
			<span class="bold"><?php echo $work['Work']['consignment']; ?></span>
		</div>
		<div <?php echo $class;?>>
		<?php __('status'); ?> : 
			<span class="bold"><?php echo $work['Work']['status']; ?></span>
		</div>
	</dl>
<div class="actions">
	<ul>
	<?php if(in_array("editor",$permissions)) {?>
		<?php if( $work['Work']['consignment'] != "RESERVED") {?>
		<li><?php echo $html->link(__('Edit Work', true), array('action' => 'edit', $work['Work']['id'])); ?> </li>
		<?php }?>
		
		<?php if( $work['Work']['consignment'] == "RESERVED" && in_array("admin",$permissions)) {?>
		<li><?php echo $html->link(__('Edit Work', true), array('action' => 'edit', $work['Work']['id'])); ?> </li>
		<?php }?>
		
		<?php if(in_array("admin",$permissions)) {?>
		<li><?php echo $html->link(__('Delete Work', true), array('action' => 'delete', $work['Work']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $work['Work']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Works', true), array('action' => 'index')); ?> </li>
		<?php }?>
		<li><?php echo $html->link(__('New Work', true), array('action' => 'add')); ?> </li>
		<li><?php //echo $html->link(__('List Images', true), array('controller' => 'images', 'action' => 'index')); ?> </li>
		<li><?php //echo $html->link(__('New Image', true), array('controller' => 'images', 'action' => 'add')); ?> </li>
	<?php }?>
	</ul>
</div>
</div>

<div class="related">
	<h3><?php __('Images');?></h3>
	<?php if (!empty($work['Image'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Title'); ?></th>
		<th><?php __('Image'); ?></th>
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
	
			echo $html->link(
			$html->image( $imagePath . $image['path'] . '_med.jpg', array("alt" => "")),
			array('controller' => 'images', 'action' => 'view', $image['id']),
			array('escape'=>false)
			);

			
			?>
			</td>
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
				<?php } ?>
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
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller' => 'exhibitions', 'action' => 'view', $image['id'])); ?>
				<?php if(in_array("admin",$permissions)) {?>
				<?php echo $html->link(__('Edit', true), array('controller' => 'exhibitions', 'action' => 'edit', $image['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller' => 'exhibitions', 'action' => 'delete', $image['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $image['id'])); ?>
				<?php } ?>
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
