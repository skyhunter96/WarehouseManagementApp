<div class="goods view">
<h2><?php echo __('Good'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($good['Good']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Code'); ?></dt>
		<dd>
			<?php echo h($good['Item']['code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Item'); ?></dt>
		<dd>
			<?php echo $this->Html->link($good['Item']['name'], array('controller' => 'items', 'action' => 'view', $good['Item']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pid'); ?></dt>
		<dd>
			<?php echo h($good['Good']['pid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Item Type'); ?></dt>
		<dd>
			<?php echo h($item_type['ItemType']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Decription'); ?></dt>
		<dd>
			<?php echo h($good['Item']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Weight'); ?></dt>
		<dd>
			<?php echo h($good['Item']['weight']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Measurement unit'); ?></dt>
		<dd>
			<?php echo h($measurement_unit['MeasurementUnit']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($good['Good']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Hts Number'); ?></dt>
		<dd>
			<?php echo h($good['Good']['hts_number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tax Group'); ?></dt>
		<dd>
			<?php echo h($good['Good']['tax_group']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Eccn'); ?></dt>
		<dd>
			<?php echo h($good['Good']['eccn']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Release Date'); ?></dt>
		<dd>
			<?php echo h($good['Good']['release_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is For Distributors'); ?></dt>
		<dd>
			<?php if($good['Good']['is_for_distributors']) echo "Yes"; else echo "No" ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($good['Good']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($good['Good']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Good'), array('action' => 'edit', $good['Good']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Good'), array('action' => 'delete', $good['Good']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $good['Good']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Goods'), array('action' => 'index')); ?> </li>
	</ul>
</div>
