<div class="semiproducts view">
<h2><?php echo __('Semiproduct'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($semiproduct['Semiproduct']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Code'); ?></dt>
		<dd>
			<?php echo h($semiproduct['Item']['code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Item'); ?></dt>
		<dd>
			<?php echo $this->Html->link($semiproduct['Item']['name'], array('controller' => 'items', 'action' => 'view', $semiproduct['Item']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Item Type'); ?></dt>
		<dd>
			<?php echo h($item_type['ItemType']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Decription'); ?></dt>
		<dd>
			<?php echo h($semiproduct['Item']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Weight'); ?></dt>
		<dd>
			<?php echo h($semiproduct['Item']['weight']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Measurement unit'); ?></dt>
		<dd>
			<?php echo h($measurement_unit['MeasurementUnit']['name']); ?>
			&nbsp;
		</dd>

		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($semiproduct['Semiproduct']['status']); ?>
			&nbsp;
		</dd>

		<dt><?php echo __('Is For Service Production'); ?></dt>
		<dd>
			<?php if($semiproduct['Semiproduct']['is_for_service_production']) echo "Yes"; else echo "No"; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($semiproduct['Semiproduct']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($semiproduct['Semiproduct']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Semiproduct'), array('action' => 'edit', $semiproduct['Semiproduct']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Semiproduct'), array('action' => 'delete', $semiproduct['Semiproduct']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $semiproduct['Semiproduct']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Semiproducts'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Semiproduct'), array('action' => 'add')); ?> </li>

	</ul>
</div>
