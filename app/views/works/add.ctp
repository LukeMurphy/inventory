<div class="works form"><?php echo $form->create('Work', array('method'=>'post','enctype'=>'multipart/form-data'));?>
	<fieldset>
 		<legend><?php __('Add Work');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('inventory_id', array('size'=>'5','type'=>'text','label'=>'Inventory ID (suggested)','value'=>($defaultInventoryId+1)));
		echo $form->input('inventory_tag', array('size'=>'5','label'=>'Inventory Tag (eg. studio #)'));
		echo "<br clear=all>";
		echo $form->input('title');
		//echo $form->input('date_year', array('type'=>'text','size'=>'5'));
		e( $yearList->select('date_year', 'YEAR'));
		echo $form->input('date_general', array('size'=>'5','label'=>'Month or Day (optional)'));
		echo "<br clear=all>";
		echo $form->input('height', array('size'=>'5'));
		echo $form->input('width', array('size'=>'5'));
		echo "<br clear=all>Upload images:<br>" . $form->file('Image/filedata1');
		echo "<br>" . $form->file('Image/filedata2');
		echo "<br>" . $form->file('Image/filedata3');
		echo "<br clear=all>";
		echo "<br clear=all>";
		echo $form->input('location',array('label'=>'Current location'));
		echo $form->input('location/date',array('label'=>'Date of location'));
		//echo $form->input('consignment',array('label'=>'Current consignment'));
		echo "<br clear=all>";
		e( $consignment->select('consignment', 'consignment'));
		e( $consignment->select('status', 'status'));
		echo $form->input('Exhibition');
		
		//echo $form->input('status', array('size'=>'20'));
		echo $form->input('notes');
		echo "<br>" . $form->end('SAVE');
	?>
<br clear='all' />
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Works', true), array('action' => 'index'));?></li>
	</ul>
</div>
	</fieldset>
</div>
