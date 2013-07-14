<div class="works index">
<span style="font-weight:bold; color:red"><?php __('Works');?></span> | <?php 
if(in_array("editor",$permissions)) echo $html->link(__('New Work', true), array('action' => 'add')); ?>
| <a href="<?php echo $_SERVER['REQUEST_URI']."&list=true"; ?>">View as list</a>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>

<?php
$finalWorksArray = array();
foreach ($works as $work) {
	array_push($finalWorksArray,array("Work"=>$work['Work']));
}

//$works = array_unique($works);
$i = 0;
foreach ($finalWorksArray as $work):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
	/******************/
	// Color coding

	$bgColor = '#ffffff';
	$style = '';
	if ($work['Work']['consignment'] == "RESERVED") {
		$bgColor = '#efefef';
	}
	if($work['Work']['consignment'] == "NFS-Estate") {
		$bgColor = '#efefef';
	}
	if($work['Work']['consignment'] == "on consignment: p-s") {
		$bgColor = '#E2E1E0';
	}
	if($work['Work']['consignment'] == "on consignment: w-t") {
		$bgColor = '#F1F1EA';
	}
	if($work['Work']['consignment'] == "In storage") {
		$bgColor = '#ffffff';
	}
	if($work['Work']['consignment'] == "NFS-Estate" || $work['Work']['consignment'] == "sold") {
		//$style = 'opacity:0.4;filter:alpha(opacity=40);';
	}
	/******************/
?>
		<div class="gridElement" <?php echo ' style="background-color:'.$bgColor.'"'; ?>>
		<div class="imagegridElement">
		<?php 
		$found = false;
		foreach($images as $image) {
			if($image['Work']['id'] == $work['Work']['id'] && !$found) {
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
			<?php echo $work['Work']['title']; ?>
			<?php echo ", "; ?>
			<?php echo $work['Work']['date_year']; ?>
			<?php echo "<br />"; ?>
			<?php echo $work['Work']['consignment']; ?>
			<?php echo "<br />"; ?>
			<?php echo $work['Work']['status']; ?>
			</div>

<?php endforeach; ?>
</div>
<br clear="all" />

<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
</div>
<div class="actions">
	<ul>
	<?php if(in_array("editor",$permissions)) {?>
		<li><?php echo $html->link(__('New Work', true), array('action' => 'add')); ?></li>
	<?php }?>
	<?php if(in_array("admin",$permissions)) {?>
		<li><?php echo $html->link(__('List Images', true), array('controller' => 'images', 'action' => 'index')); ?> </li>
	<?php }?>
	</ul>
</div>
