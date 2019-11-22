<div class="warehouseAddresses index">
	<h2><?php echo __('Warehouse Addresses'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('code'); ?></th>
			<th><?php echo $this->Paginator->sort('row'); ?></th>
			<th><?php echo $this->Paginator->sort('shelf'); ?></th>
			<th><?php echo $this->Paginator->sort('partition'); ?></th>
			<th><?php echo $this->Paginator->sort('barcode'); ?></th>
			<th><?php echo $this->Paginator->sort('warehouse_places_id'); ?></th>
			<th><?php echo $this->Paginator->sort('active'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($warehouseAddresses as $warehouseAddress): ?>
	<tr>
		<td><?php echo h($warehouseAddress['WarehouseAddress']['id']); ?>&nbsp;</td>
		<td><?php echo h($warehouseAddress['WarehouseAddress']['code']); ?>&nbsp;</td>
		<td><?php echo h($warehouseAddress['WarehouseAddress']['row']); ?>&nbsp;</td>
		<td><?php echo h($warehouseAddress['WarehouseAddress']['shelf']); ?>&nbsp;</td>
		<td><?php echo h($warehouseAddress['WarehouseAddress']['partition']); ?>&nbsp;</td>
		<td><?php echo $this->Html->link($warehouseAddress['WarehouseAddress']['barcode'], array('action' => 'init_tcpdf', $warehouseAddress['WarehouseAddress']['id'])); ?></td>
		<td>
			<?php echo $this->Html->link($warehouseAddress['WarehousePlaces']['name'], array('controller' => 'warehouse_places', 'action' => 'view', $warehouseAddress['WarehousePlaces']['id'])); ?>
		</td>
		<td><?php if($warehouseAddress['WarehouseAddress']['active']) echo "Yes"; else echo "No" ?>&nbsp;</td>
		<td><?php echo h($warehouseAddress['WarehouseAddress']['created']); ?>&nbsp;</td>
		<td><?php echo h($warehouseAddress['WarehouseAddress']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $warehouseAddress['WarehouseAddress']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $warehouseAddress['WarehouseAddress']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $warehouseAddress['WarehouseAddress']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $warehouseAddress['WarehouseAddress']['id']))); ?>

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
		<li><?php echo $this->Html->link(__('New Address'), array('action' => 'add')); ?></li>
	</ul>
</div>
