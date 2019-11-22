<div class="itemsPlaces view">
<h2><?php echo __('Items Place'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($itemsPlace['ItemsPlace']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Items'); ?></dt>
		<dd>
			<?php echo $this->Html->link($itemsPlace['Items']['name'], array('controller' => 'items', 'action' => 'view', $itemsPlace['Items']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Warehouse Places'); ?></dt>
		<dd>
			<?php echo $this->Html->link($itemsPlace['WarehousePlaces']['name'], array('controller' => 'warehouse_places', 'action' => 'view', $itemsPlace['WarehousePlaces']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Total'); ?></dt>
		<dd>
			<?php echo h($itemsPlace['ItemsPlace']['total']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Available'); ?></dt>
		<dd>
			<?php echo h($itemsPlace['ItemsPlace']['available']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Reserved'); ?></dt>
		<dd>
			<?php echo h($itemsPlace['ItemsPlace']['reserved']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Used'); ?></dt>
		<dd>
			<?php echo h($itemsPlace['ItemsPlace']['used']); ?>
			&nbsp;
		</dd>
	</dl>
</div>

