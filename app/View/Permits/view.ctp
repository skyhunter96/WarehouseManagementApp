<div class="permits view">
<h2><?php echo __('Permit'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($permit['Permit']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Users'); ?></dt>
		<dd>
			<?php echo $this->Html->link($permit['Users']['id'], array('controller' => 'users', 'action' => 'view', $permit['Users']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Warehouse Places'); ?></dt>
		<dd>
			<?php echo $this->Html->link($permit['WarehousePlaces']['name'], array('controller' => 'warehouse_places', 'action' => 'view', $permit['WarehousePlaces']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Allowed'); ?></dt>
		<dd>
			<?php echo h($permit['Permit']['allowed']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($permit['Permit']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($permit['Permit']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Permit'), array('action' => 'edit', $permit['Permit']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Permit'), array('action' => 'delete', $permit['Permit']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $permit['Permit']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Permits'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Permit'), array('action' => 'add')); ?> </li>
	</ul>
</div>
