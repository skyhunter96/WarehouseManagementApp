<div class="warehousePlaces view">
<h2><?php echo __('Warehouse Place'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($warehousePlace['WarehousePlace']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Code'); ?></dt>
		<dd>
			<?php echo h($warehousePlace['WarehousePlace']['code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($warehousePlace['WarehousePlace']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($warehousePlace['WarehousePlace']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Default'); ?></dt>
		<dd>
			<?php if($warehousePlace['WarehousePlace']['is_default']) echo "Yes"; else echo "No" ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Active'); ?></dt>
		<dd>
			<?php if($warehousePlace['WarehousePlace']['is_active']) echo "Yes"; else echo "No" ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Warehouses'); ?></dt>
		<dd>
			<?php echo $this->Html->link($warehousePlace['Warehouses']['name'], array('controller' => 'warehouses', 'action' => 'view', $warehousePlace['Warehouses']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($warehousePlace['WarehousePlace']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($warehousePlace['WarehousePlace']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Place'), array('action' => 'edit', $warehousePlace['WarehousePlace']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Place'), array('action' => 'delete', $warehousePlace['WarehousePlace']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $warehousePlace['WarehousePlace']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Places'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Place'), array('action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<?php if (!empty($warehousePlace['ItemType'])): ?>
	<h3><?php echo __('Related Item Types'); ?></h3>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Code'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Class'); ?></th>
	</tr>
	<?php foreach ($warehousePlace['ItemType'] as $itemType): ?>
		<tr>
			<td><?php echo $itemType['id']; ?></td>
			<td><?php echo $itemType['code']; ?></td>
			<td><?php echo $itemType['name']; ?></td>
			<td><?php echo $itemType['class']; ?></td>

		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<h3><?php echo __('Items in this place'); ?></h3>
	<table>
	<thead>
	<tr>
		<th>Item</th>
		<th>Total</th>
		<th>Available</th>
		<th>Reserved</th>
		<th>Used</th>
	</tr>
	</thead>
	<tbody>
	<?php if(isset($items)): ?>
	<?php foreach ($items as $item): ?>
		<tr>
			<td><?php echo h($item['items_id']) ?></td>
			<td><?php echo h($item['total']) ?></td>
			<td><?php echo h($item['available']) ?></td>
			<td><?php echo h($item['reserved']) ?></td>
			<td><?php echo h($item['used']) ?></td>
		</tr>
	<?php endforeach; ?>
	<?php endif; ?>
	</tbody>
	</table>


</div>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>
