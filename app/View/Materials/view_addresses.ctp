<div class="Material form">
	<table cellpadding="0" cellspacing="0">
		<thead>
		<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('code'); ?></th>
			<th><?php echo $this->Paginator->sort('row'); ?></th>
			<th><?php echo $this->Paginator->sort('shelf'); ?></th>
			<th><?php echo $this->Paginator->sort('partition'); ?></th>
			<th><?php echo $this->Paginator->sort('barcode'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($adresses as $warehouseAddress): ?>
			<tr>
				<td><?php echo h($warehouseAddress['WarehouseAddress']['id']); ?>&nbsp;</td>
				<td><?php echo h($warehouseAddress['WarehouseAddress']['code']); ?>&nbsp;</td>
				<td><?php echo h($warehouseAddress['WarehouseAddress']['row']); ?>&nbsp;</td>
				<td><?php echo h($warehouseAddress['WarehouseAddress']['shelf']); ?>&nbsp;</td>
				<td><?php echo h($warehouseAddress['WarehouseAddress']['partition']); ?>&nbsp;</td>
				<td><?php echo h($warehouseAddress['WarehouseAddress']['barcode']); ?>&nbsp;</td>

				<td class="actions">
					<?php echo $this->Form->postLink(__('Add to this Address'), array('action' => 'addToAddress', $warehouseAddress['WarehouseAddress']['id']), array('confirm' => __('Are you sure you want to add to this address'))); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>
