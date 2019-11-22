<div class="measurementUnits view">
<h2><?php echo __('Measurement Unit'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($measurementUnit['MeasurementUnit']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($measurementUnit['MeasurementUnit']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Symbol'); ?></dt>
		<dd>
			<?php echo h($measurementUnit['MeasurementUnit']['symbol']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Active'); ?></dt>
		<dd>
			<?php if($measurementUnit['MeasurementUnit']['active']) echo "Yes"; else echo "No" ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($measurementUnit['MeasurementUnit']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($measurementUnit['MeasurementUnit']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Measurement Unit'), array('action' => 'edit', $measurementUnit['MeasurementUnit']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Measurement Unit'), array('action' => 'delete', $measurementUnit['MeasurementUnit']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $measurementUnit['MeasurementUnit']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Measurement Units'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Measurement Unit'), array('action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Items'); ?></h3>
	<?php if (!empty($measurementUnit['Item'])): ?>
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
	<?php foreach ($measurementUnit['Item'] as $item): ?>
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
