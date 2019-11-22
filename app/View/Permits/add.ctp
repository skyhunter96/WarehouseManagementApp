<div class="permits form">
<?php echo $this->Form->create('Permit', array('class' => 'vertical clearfix', )); ?>
	<fieldset>
		<legend><?php echo __('Add Permit'); ?></legend>
	<?php
		echo $this->Form->input('users_id');
		echo $this->Form->input('warehouse_places_id');
		echo $this->Form->input('allowed');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Permits'), array('action' => 'index')); ?></li>
	</ul>
</div>
