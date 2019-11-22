<div class="transitions view">
<h2><?php echo __('Transition'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($transition['Transition']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Code'); ?></dt>
		<dd>
			<?php echo h($transition['Transition']['code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User Created By'); ?></dt>
		<dd>
			<?php echo h($transition['Transition']['user_created_by']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Warehouses Places From'); ?></dt>
		<dd>
			<?php echo h($transition['Transition']['warehouses_places_from']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Warehouses Places To'); ?></dt>
		<dd>
			<?php echo h($transition['Transition']['warehouses_places_to']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User Issued By'); ?></dt>
		<dd>
			<?php echo h($transition['Transition']['user_issued_by']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User Received By'); ?></dt>
		<dd>
			<?php echo h($transition['Transition']['user_received_by']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($transition['Transition']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($transition['Transition']['type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Work Order'); ?></dt>
		<dd>
			<?php echo h($transition['Transition']['work_order']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($transition['Transition']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($transition['Transition']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Transition'), array('action' => 'edit', $transition['Transition']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Transition'), array('action' => 'delete', $transition['Transition']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $transition['Transition']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Transitions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Transition'), array('action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Items'); ?></h3>
	<?php if (!empty($transition['Item'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Code'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Weight'); ?></th>
		<th><?php echo __('Measurement Unit Id'); ?></th>
		<th><?php echo __('Item Type Id'); ?></th>
		<th><?php echo __('Is Deleted'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($transition['Item'] as $item): ?>
		<tr>
			<td><?php echo $item['id']; ?></td>
			<td><?php echo $item['code']; ?></td>
			<td><?php echo $item['name']; ?></td>
			<td><?php echo $item['description']; ?></td>
			<td><?php echo $item['weight']; ?></td>
			<td><?php echo $item['measurement_unit_id']; ?></td>
			<td><?php echo $item['item_type_id']; ?></td>
			<td><?php echo $item['is_deleted']; ?></td>
			<td><?php echo $item['created']; ?></td>
			<td><?php echo $item['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'items', 'action' => 'view', $item['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'items', 'action' => 'edit', $item['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'items', 'action' => 'delete', $item['id']), array('confirm' => __('Are you sure you want to delete # %s?', $item['id']))); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Item'), array('controller' => 'items', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
