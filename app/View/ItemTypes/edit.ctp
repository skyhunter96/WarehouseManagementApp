<div class="itemTypes form">
<?php echo $this->Form->create('ItemType', array('action' => 'save')); ?>
	<fieldset>
		<legend><?php echo __('Edit Item Type'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('code');
		echo $this->Form->input('name');
		echo $this->Form->input('class', array('options' => $classes));
		echo $this->Form->input('tangible');
		echo $this->Form->input('active');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ItemType.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('ItemType.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Item Types'), array('action' => 'index')); ?></li>
	</ul>
</div>
