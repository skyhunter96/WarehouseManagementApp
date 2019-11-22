<div class="serviceSuppliers form">
<?php echo $this->Form->create('ServiceSupplier'); ?>
	<fieldset>
		<legend><?php echo __('Edit Service Supplier'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('Item.name');
		echo $this->Form->input('Item.description');
		echo $this->Form->input('status', array('options' => $status));
		echo $this->Form->input('recommended_rating', array('options' => $recommended_rating));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ServiceSupplier.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('ServiceSupplier.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Service Suppliers'), array('action' => 'index')); ?></li>
	</ul>
</div>
