<div class="warehousePlaces index">
	<h2><?php echo __('Warehouse Places'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('code'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th><?php echo $this->Paginator->sort('is_default'); ?></th>
			<th><?php echo $this->Paginator->sort('is_active'); ?></th>
			<th><?php echo $this->Paginator->sort('warehouses_id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($warehousePlaces as $warehousePlace): ?>
	<tr>
		<td><?php echo h($warehousePlace['WarehousePlace']['id']); ?>&nbsp;</td>
		<td><?php echo h($warehousePlace['WarehousePlace']['code']); ?>&nbsp;</td>
		<td><?php echo h($warehousePlace['WarehousePlace']['name']); ?>&nbsp;</td>
		<td><?php echo h($warehousePlace['WarehousePlace']['description']); ?>&nbsp;</td>
		<td><?php if($warehousePlace['WarehousePlace']['is_default']) echo "Yes"; else echo "No" ?>&nbsp;</td>
		<td><?php if($warehousePlace['WarehousePlace']['is_active']) echo "Yes"; else echo "No" ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($warehousePlace['Warehouses']['name'], array('controller' => 'warehouses', 'action' => 'view', $warehousePlace['Warehouses']['id'])); ?>
		</td>
		<td><?php echo h($warehousePlace['WarehousePlace']['created']); ?>&nbsp;</td>
		<td><?php echo h($warehousePlace['WarehousePlace']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $warehousePlace['WarehousePlace']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $warehousePlace['WarehousePlace']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $warehousePlace['WarehousePlace']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $warehousePlace['WarehousePlace']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Place'), array('action' => 'add')); ?></li>
	</ul>
</div>
