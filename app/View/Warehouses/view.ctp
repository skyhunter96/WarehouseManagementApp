<div class="warehouses view">
<h2><?php echo __('Warehouse'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($warehouse['Warehouse']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($warehouse['Warehouse']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($warehouse['Warehouse']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($warehouse['Warehouse']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Warehouse'), array('action' => 'edit', $warehouse['Warehouse']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Warehouse'), array('action' => 'delete', $warehouse['Warehouse']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $warehouse['Warehouse']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Warehouses'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Warehouse'), array('action' => 'add')); ?> </li>
	</ul>
</div>
