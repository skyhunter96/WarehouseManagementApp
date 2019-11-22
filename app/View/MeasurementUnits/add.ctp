<div class="measurementUnits form">
<?php echo $this->Form->create('MeasurementUnit'); ?>
	<fieldset>
		<legend><?php echo __('Add Measurement Unit'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('symbol');
		echo $this->Form->input('active');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Units'), array('action' => 'index')); ?></li>
	</ul>
</div>
