<div class="warehousePlaces form">
<?php echo $this->Form->create('WarehousePlace'); ?>
	<fieldset>
		<legend><?php echo __('Add Warehouse Place'); ?></legend>
	<?php
		echo $this->Form->input('code');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('is_default');
		echo $this->Form->input('is_active');
		echo $this->Form->input('warehouse_id', array('options' => $warehouses));
		echo $this->Form->input('ItemType.ItemType', array('multiple' => 'checkbox',));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Places'), array('action' => 'index')); ?></li>
	</ul>
</div>
