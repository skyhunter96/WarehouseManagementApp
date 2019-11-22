<div class="measurementUnits form">
<?php echo $this->Form->create('MeasurementUnit'); ?>
	<fieldset>
		<legend><?php echo __('Edit Measurement Unit'); ?></legend>
	<?php
		echo $this->Form->input('id');
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

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('MeasurementUnit.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('MeasurementUnit.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Units'), array('action' => 'index')); ?></li
	</ul>
</div>
