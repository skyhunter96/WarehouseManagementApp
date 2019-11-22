<div class="warehouseAddresses form">
<?php echo $this->Form->create('WarehouseAddress', array('class' => 'vertical clearfix', )); ?>
	<fieldset>
		<legend><?php echo __('Add Warehouse Address'); ?></legend>
	<?php
		echo $this->Form->input('row');
		echo $this->Form->input('shelf');
		echo $this->Form->input('partition');
		echo $this->Form->input('warehouse_places_id');
		echo $this->Form->input('active');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Addresses'), array('action' => 'index')); ?></li>
	</ul>
</div>
