<div class="consumables view">
<h2><?php echo __('Consumable'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($consumable['Consumable']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Code'); ?></dt>
		<dd>
			<?php echo h($consumable['Item']['code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Item'); ?></dt>
		<dd>
			<?php echo $this->Html->link($consumable['Item']['name'], array('controller' => 'items', 'action' => 'view', $consumable['Item']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Item Type'); ?></dt>
		<dd>
			<?php echo h($item_type['ItemType']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Decription'); ?></dt>
		<dd>
			<?php echo h($consumable['Item']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Weight'); ?></dt>
		<dd>
			<?php echo h($consumable['Item']['weight']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Measurement unit'); ?></dt>
		<dd>
			<?php echo h($measurement_unit['MeasurementUnit']['name']); ?>
			&nbsp;
		</dd>

		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($consumable['Consumable']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Recommended Rating'); ?></dt>
		<dd>
			<?php echo h($consumable['Consumable']['recommended_rating']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($consumable['Consumable']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($consumable['Consumable']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Consumable'), array('action' => 'edit', $consumable['Consumable']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Consumable'), array('action' => 'delete', $consumable['Consumable']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $consumable['Consumable']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Consumables'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Consumable'), array('action' => 'add')); ?> </li>

	</ul>
</div>
