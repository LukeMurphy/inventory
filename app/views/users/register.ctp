<div class="users form">
<?php echo $form->create('User',array("action"=>"register"));?>
	<fieldset>
 		<legend>Register</legend>
		<?php
		echo $form->input('username');
		echo $form->input('password');
		?>
	</fieldset>
<?php echo $form->end(__('Submit', true));?>
</div>