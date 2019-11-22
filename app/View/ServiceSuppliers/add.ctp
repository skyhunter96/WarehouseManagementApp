<div class="serviceSuppliers form">
<?php echo $this->Form->create('ServiceSupplier'); ?>
	<fieldset>
		<legend><?php echo __('Add Service Supplier'); ?></legend>
	<?php
		echo $this->Form->input('Item.name');
		echo $this->Form->input('Item.description');
		echo $this->Form->input('Item.ItemTypeId', array('label' => 'Item Type', 'options' => $item_types));
		echo $this->Form->input('status', array('options' => $status));
		echo $this->Form->input('recommended_rating', array('options' => $recommended_rating));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Service Suppliers'), array('action' => 'index')); ?></li>
	</ul>
</div>
