<div class="itemTypes form">
	<?php echo $this->Form->create(false, array('url' => array('controller' => 'itemTypes', 'action' => 'save'), 'id' => 'ItemTypesAdd')); ?>
	<fieldset>
		<legend><?php echo __('Add Item Type'); ?></legend>
		<?php
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

		<li><?php echo $this->Html->link(__('List Item Types'), array('action' => 'index')); ?></li>
	</ul>
</div>
