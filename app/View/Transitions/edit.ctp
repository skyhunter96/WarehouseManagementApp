<div class="transitions form">
<?php echo $this->Form->create('Transition'); ?>
	<fieldset>
		<legend><?php echo __('Edit Transition'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('warehouses_places_from', array('options' => $warehousePlaces, 'class' => 'js-example-basic-single js-states form-control'));
		echo $this->Form->input('user_issued_by');
		echo $this->Form->input('user_received_by');
		echo $this->Form->input('status', array('options' => $status));
		echo $this->Form->input('type', array('options' => $type));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Transition.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('Transition.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Transitions'), array('action' => 'index')); ?></li>
	</ul>
</div>
