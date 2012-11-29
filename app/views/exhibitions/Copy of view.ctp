<style>
div.gridElement {
	width: 110px;
	height: 160px;
	float: left;
	padding: 5px;
	margin: 2px;
	border: 1px #ccc Solid;
	font-size: 80%;
}

div.imagegridElement {
	height: 85px;
	text-align: center;
}
</style>

<div class="exhibitions view">
	<h2>
	<?php  __('Exhibition');?>
	</h2>
	<dl>
	<?php $i = 0; $class = ' class="altrow"';?>
		<dt <?php if ($i % 2 == 0) echo $class;?>>
		<?php __('Id'); ?>
		</dt>
		<dd <?php if ($i++ % 2 == 0) echo $class;?>>
		<?php echo $exhibition['Exhibition']['id']; ?>
			&nbsp;
		</dd>
		<dt <?php if ($i % 2 == 0) echo $class;?>>
		<?php __('Title'); ?>
		</dt>
		<dd <?php if ($i++ % 2 == 0) echo $class;?>>
		<?php echo $exhibition['Exhibition']['title']; ?>
			&nbsp;
		</dd>
		<dt <?php if ($i % 2 == 0) echo $class;?>>
		<?php __('Notes'); ?>
		</dt>
		<dd <?php if ($i++ % 2 == 0) echo $class;?>>
		<?php echo $exhibition['Exhibition']['notes']; ?>
			&nbsp;
		</dd>
	</dl>
</div>

<?php if(in_array("admin",$permissions)): ?>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Exhibition', true), array('action' => 'edit', $exhibition['Exhibition']['id'])); ?>
		</li>
		<li><?php echo $html->link(__('Delete Exhibition', true), array('action' => 'delete', $exhibition['Exhibition']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $exhibition['Exhibition']['id'])); ?>
		</li>
		<li><?php echo $html->link(__('List Exhibitions', true), array('action' => 'index')); ?>
		</li>
		<li><?php echo $html->link(__('New Exhibition', true), array('action' => 'add')); ?>
		</li>
	</ul>
</div>
<?php endif; ?>

<div class="related">
	<h3>
	<?php __('Selected Works');?>
	</h3>
	<?php if (!empty($exhibition['Work'])):?>

	<?php

	$i = 0;
	//foreach ($works as $work):
	foreach ($exhibition['Work'] as $work):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
	/******************/
	// Color coding

	$bgColor = '#ffffff';
	$style = '';
	if ($work['consignment'] == "RESERVED") {
		$bgColor = '#efefef';
	}
	if($work['consignment'] == "NFS-Estate") {
		$bgColor = '#efefef';
	}
	if($work['consignment'] == "on consignment: p-s") {
		$bgColor = '#E2E1E0';
	}
	if($work['consignment'] == "on consignment: w-t") {
		$bgColor = '#F1F1EA';
	}
	if($work['consignment'] == "In storage") {
		$bgColor = '#ffffff';
	}
	if($work['consignment'] == "NFS-Estate" || $work['consignment'] == "sold") {
		//$style = 'opacity:0.4;filter:alpha(opacity=40);';
	}
	/******************/
	?>
	<div class="gridElement"
	<?php echo ' style="background-color:'.$bgColor.'"'; ?>>
		<div class="imagegridElement">
		<?php
		$found = false;
		foreach($images as $image) {
			if($image['Work']['id'] == $work['id'] && !$found) {
				//echo '<img src="' . $imagePath .$image['Image']['path'] . '_small.jpg">';
				echo $html->link(
				$html->image( $imagePath . $image['Image']['path'] . '_small.jpg', array("alt" => "","style"=>$style)),
				array('controller' => 'works', 'action' => 'view', $image['Work']['id']),
				array('escape'=>false)
				);
				$found=true;
			}
		}
		?>
		</div>
		<?php echo "<br />"; ?>
		<?php // echo $work['Work']['id']; ?>
		<?php //echo $work['Work']['inventory_id']; ?>
		<?php echo $work['title']; ?>
		<?php echo ", "; ?>
		<?php echo $work['date_year']; ?>
		<?php echo "<br />"; ?>
		<?php echo $work['consignment']; ?>
		<?php echo "<br />"; ?>
		<?php echo $work['status']; ?>
	</div>
	<?php endforeach; ?>
</div>
	<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Work', true), array('controller' => 'works', 'action' => 'add'));?>
			</li>
		</ul>
	</div>
</div>
	<?php
	/*
	 <table cellpadding="0" cellspacing="0">
		<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Inventory Id'); ?></th>
		<th><?php __('Inventory Tag'); ?></th>
		<th><?php __('Title'); ?></th>
		<th><?php __('Date Year'); ?></th>
		<th><?php __('Date General'); ?></th>
		<th><?php __('Height'); ?></th>
		<th><?php __('Width'); ?></th>
		<th><?php __('Notes'); ?></th>
		<th><?php __('Consignment'); ?></th>
		<th><?php __('Status'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
		</tr>
		<?php
		$i = 0;
		foreach ($exhibition['Work'] as $work):
		$class = null;
		if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
		}
		?>
		<tr <?php echo $class;?>>
		<td><?php echo $work['id'];?></td>
		<td><?php echo $work['inventory_id'];?></td>
		<td><?php echo $work['inventory_tag'];?></td>
		<td><?php echo $work['title'];?></td>
		<td><?php echo $work['date_year'];?></td>
		<td><?php echo $work['date_general'];?></td>
		<td><?php echo $work['height'];?></td>
		<td><?php echo $work['width'];?></td>
		<td><?php echo $work['notes'];?></td>
		<td><?php echo $work['consignment'];?></td>
		<td><?php echo $work['status'];?></td>
		<td class="actions"><?php echo $html->link(__('View', true), array('controller' => 'works', 'action' => 'view', $work['id'])); ?>
		<?php echo $html->link(__('Edit', true), array('controller' => 'works', 'action' => 'edit', $work['id'])); ?>
		<?php echo $html->link(__('Delete', true), array('controller' => 'works', 'action' => 'delete', $work['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $work['id'])); ?>
		</td>
		</tr>
		<?php endforeach; ?>
		</table>
		*/
	?>
