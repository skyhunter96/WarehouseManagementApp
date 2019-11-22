<div class="Material form">
	<table cellpadding="0" cellspacing="0">
		<thead>
		<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('code'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th><?php echo $this->Paginator->sort('warehouses_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($places as $warehousePlace): ?>
			<tr>
				<td><?php echo h($warehousePlace['id']); ?>&nbsp;</td>
				<td><?php echo h($warehousePlace['code']); ?>&nbsp;</td>
				<td><?php echo h($warehousePlace['name']); ?>&nbsp;</td>
				<td><?php echo h($warehousePlace['description']); ?>&nbsp;</td>
				<td>
					<?php echo $this->Html->link($warehousePlace['name'], array('controller' => 'warehouses', 'action' => 'view', $warehousePlace['id'])); ?>
				</td>
				<td class="actions">
					<?php echo $this->Html->link(__('View addresses'), array('action' => 'viewAddresses', $warehousePlace['id'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>

