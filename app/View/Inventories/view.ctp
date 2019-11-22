<div class="inventories view">
<h2><?php echo __('Inventory'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($inventory['Inventory']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Code'); ?></dt>
		<dd>
			<?php echo h($inventory['Item']['code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Item'); ?></dt>
		<dd>
			<?php echo $this->Html->link($inventory['Item']['name'], array('controller' => 'items', 'action' => 'view', $inventory['Item']['id'])); ?>
			&nbsp;
		</dd>

		<dt><?php echo __('Item Type'); ?></dt>
		<dd>
			<?php echo h($item_type['ItemType']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Decription'); ?></dt>
		<dd>
			<?php echo h($inventory['Item']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Weight'); ?></dt>
		<dd>
			<?php echo h($inventory['Item']['weight']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Measurement unit'); ?></dt>
		<dd>
			<?php echo h($measurement_unit['MeasurementUnit']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($inventory['Inventory']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Recommended Rating'); ?></dt>
		<dd>
			<?php echo h($inventory['Inventory']['recommended_rating']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($inventory['Inventory']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($inventory['Inventory']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Inventory'), array('action' => 'edit', $inventory['Inventory']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Inventory'), array('action' => 'delete', $inventory['Inventory']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $inventory['Inventory']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Inventories'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Inventory'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Items'), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item'), array('controller' => 'items', 'action' => 'add')); ?> </li>
	</ul>
</div>
