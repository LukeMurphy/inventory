<div class="works index">
	<span style="font-weight: bold; color: red"><?php __('Works');?> </span>
	|
	<?php echo $html->link(__('New Work', true), array('action' => 'add')); ?>
	<p>
	<?php
	echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>
	</p>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><?php echo $paginator->sort('id');?></th>
			<th><?php echo "image";?></th>
			<th><?php echo $paginator->sort('title');?></th>
			<th><?php echo $paginator->sort('Year','date_year');?></th>
			<th><?php echo $paginator->sort('height');?></th>
			<th><?php echo $paginator->sort('width');?></th>
			<th><?php echo $paginator->sort('consignment');?></th>
			<th><?php echo $paginator->sort('status');?></th>
			<?php 
			/*
			<th class="actions"><?php __('Actions');?></th>
			*/
			?>
		</tr>
		<?php
		$i = 0;
		foreach ($works as $work):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
		/******************/
		// Color coding

		$bgColor = '#ffffff';
		$style = '';

		/******************/

		?>
		<tr>
			<td><?php echo $work['Work']['id']; ?>
			</td>
			<td><?php 
			$found = false;
			foreach($images as $image) {
				if($image['Work']['id'] == $work['Work']['id'] && !$found) {
					echo $html->link(
					$html->image( $imagePath . $image['Image']['path'] . '_small.jpg', array("alt" => "")),
					array('controller' => 'works', 'action' => 'view', $image['Work']['id']), array('escape'=>false)
					);
					$found=true;
				}
			}

			?></td>
			<td><?php echo $work['Work']['title']; ?>
			</td>
			<td><?php echo $work['Work']['date_year']; ?>
			</td>
			<td><?php echo $work['Work']['height']; ?>
			</td>
			<td><?php echo $work['Work']['width']; ?>
			</td>
			<td><?php echo $work['Work']['consignment']; ?>
			</td>
			<td><?php echo $work['Work']['status']; ?>
			</td>
			<?php 
			/*
			 * 
			 */
			?>
			<td class="actions"><?php echo $html->link(__('View', true), array('action' => 'edit', $work['Work']['id']));?>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
</div>
<div class="paging">
<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
	|
	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
</div>

