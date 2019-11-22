<div class="inventories form">
<?php echo $this->Form->create('Inventory'); ?>
	<fieldset>
		<legend><?php echo __('Edit Inventory'); ?></legend>
	<?php
		echo $this->Form->input('Item.name');
		echo $this->Form->input('Item.description');
		echo $this->Form->input('Item.weight', array('required' => false));
		echo $this->Form->input('Item.measurement_unit_id', array('label' => 'Measurement Unit', 'options' => $measurement_units));
		echo $this->Form->input('Item.ItemTypeId', array('label' => 'Item Type', 'options' => $item_types, 'hiddenField' => true));
		echo $this->Form->input('status', array('options' => $status));
		echo $this->Form->input('recommended_rating', array('options' => $recommended_rating));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Inventory.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('Inventory.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Inventories'), array('action' => 'index')); ?></li>
	</ul>
</div>
