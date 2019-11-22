<div class="warehousePlaces form">
<?php echo $this->Form->create('WarehousePlace'); ?>
	<fieldset>
		<legend><?php echo __('Edit Warehouse Place'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('code');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('is_default');
		echo $this->Form->input('is_active');
		echo $this->Form->input('warehouse_id', array('options' => $warehouses));
		echo $this->Form->input('ItemType.ItemType', array('multiple' => 'checkbox'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('WarehousePlace.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('WarehousePlace.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Places'), array('action' => 'index')); ?></li>
	</ul>
</div>
