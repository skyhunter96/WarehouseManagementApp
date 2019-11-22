<div class="transitionsItems form">
<?php echo $this->Form->create('TransitionsItem'); ?>
	<fieldset>
		<legend><?php echo __('Edit Transitions Item'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('transitions_id');
		echo $this->Form->input('items_id');
		echo $this->Form->input('demanded_quantity');
		echo $this->Form->input('issued_quantity');
		echo $this->Form->input('from_address');
		echo $this->Form->input('to_address');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('TransitionsItem.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('TransitionsItem.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Transitions Items'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Transitions'), array('controller' => 'transitions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Transitions'), array('controller' => 'transitions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Items'), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Items'), array('controller' => 'items', 'action' => 'add')); ?> </li>
	</ul>
</div>
