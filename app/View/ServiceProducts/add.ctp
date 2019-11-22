<div class="serviceProducts form">
<?php echo $this->Form->create('ServiceProduct'); ?>
	<fieldset>
		<legend><?php echo __('Add Service Product'); ?></legend>
	<?php
		echo $this->Form->input('Item.name');
		echo $this->Form->input('Item.description');
		echo $this->Form->input('hts_number');
		echo $this->Form->input('tax_group', array('label' => 'Tax Group', 'options' => $tax));
		echo $this->Form->input('eccn');
		echo $this->Form->input('release_date');
		echo $this->Form->input('Item.ItemTypeId', array('label' => 'Item Type', 'options' => $item_types));
		echo $this->Form->input('is_for_distributors');
		echo $this->Form->input('status', array('label' => 'Status', 'options' => $status));
		echo $this->Form->input('project');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Service Products'), array('action' => 'index')); ?></li>
	</ul>
</div>
