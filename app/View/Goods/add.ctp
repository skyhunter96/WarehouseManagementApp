<div class="  col_10">
<!--	goods form-->
<?php echo $this->Form->create('Good'); ?>
	<fieldset>
		<legend><?php echo __('Add Good'); ?></legend>
	<?php
		echo $this->Form->input('Item.name');
		echo $this->Form->input('Item.description');
		echo $this->Form->input('Item.weight', array('required' => false));
		echo $this->Form->input('Item.measurement_unit_id', array('label' => 'Measurement Unit', 'options' => $measurement_units));
		echo $this->Form->input('Item.item_type_id', array('label' => 'Item Type', 'options' => $item_types));
		echo $this->Form->input('status', array('label' => 'Status', 'options' => $status));
		echo $this->Form->input('hts_number');
		echo $this->Form->input('tax_group', array('label' => 'Tax Group', 'options' => $tax));
		echo $this->Form->input('eccn');
		echo $this->Form->input('release_date');
		echo $this->Form->input('is_for_distributors');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class=" col_2">
<!--	actions-->
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Goods'), array('action' => 'index')); ?></li>
	</ul>
</div>
