<div class="itemsPlaces form">
<?php echo $this->Form->create('ItemsPlace'); ?>
	<fieldset>
		<legend><?php echo __('Add Items Place'); ?></legend>
	<?php
		echo $this->Form->input('items_id');
		echo $this->Form->input('warehouse_places_id');
		echo $this->Form->input('total');
		echo $this->Form->input('available');
		echo $this->Form->input('reserved');
		echo $this->Form->input('used');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Items Places'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Items'), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Items'), array('controller' => 'items', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Warehouse Places'), array('controller' => 'warehouse_places', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Warehouse Places'), array('controller' => 'warehouse_places', 'action' => 'add')); ?> </li>
	</ul>
</div>
