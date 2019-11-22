<div class="serviceProducts form">
<?php echo $this->Form->create('ServiceProduct'); ?>
	<fieldset>
		<legend><?php echo __('Edit Service Product'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('Item.name');
		echo $this->Form->input('Item.description');
		echo $this->Form->input('hts_number');
		echo $this->Form->input('tax_group', array('label' => 'Tax Group', 'options' => $tax));
		echo $this->Form->input('eccn');
		echo $this->Form->input('release_date');
		echo $this->Form->input('is_for_distributors');
		echo $this->Form->input('status', array('options' => $status));
		echo $this->Form->input('project');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ServiceProduct.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('ServiceProduct.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Service Products'), array('action' => 'index')); ?></li>
	</ul>
</div>
