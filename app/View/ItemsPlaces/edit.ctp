<div class="itemsPlaces form">
<?php echo $this->Form->create('ItemsPlace'); ?>
	<fieldset>
		<legend><?php echo __('Edit Items Place'); ?></legend>
	<?php
		echo $this->Form->input('id');
//		echo $this->Form->input('items_id');
//		echo $this->Form->input('warehouse_places_id');
		echo $this->Form->input('total');
		echo $this->Form->input('available');
		echo $this->Form->input('reserved');
		echo $this->Form->input('used');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

