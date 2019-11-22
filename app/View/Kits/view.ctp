<div class="kits view">
<h2><?php echo __('Kit'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($kit['Kit']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Code'); ?></dt>
		<dd>
			<?php echo h($kit['Item']['code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Item'); ?></dt>
		<dd>
			<?php echo $this->Html->link($kit['Item']['name'], array('controller' => 'items', 'action' => 'view', $kit['Item']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pid'); ?></dt>
		<dd>
			<?php echo h($kit['Kit']['pid']); ?>
			&nbsp;
		</dd>

		<dt><?php echo __('Hts Number'); ?></dt>
		<dd>
			<?php echo h($kit['Kit']['hts_number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tax Group'); ?></dt>
		<dd>
			<?php echo h($kit['Kit']['tax_group']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Eccn'); ?></dt>
		<dd>
			<?php echo h($kit['Kit']['eccn']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Release Date'); ?></dt>
		<dd>
			<?php echo h($kit['Kit']['release_date']); ?>
			&nbsp;
		</dd>

		<dt><?php echo __('Item Type'); ?></dt>
		<dd>
			<?php echo h($item_type['ItemType']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Decription'); ?></dt>
		<dd>
			<?php echo h($kit['Item']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Weight'); ?></dt>
		<dd>
			<?php echo h($kit['Item']['weight']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Measurement unit'); ?></dt>
		<dd>
			<?php echo h($measurement_unit['MeasurementUnit']['name']); ?>
			&nbsp;
		</dd>

		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($kit['Kit']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is For Distributors'); ?></dt>
		<dd>
			<?php if($kit['Kit']['is_for_distributors']) echo "Yes"; else echo "No" ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Hide Kit Kontent'); ?></dt>
		<dd>
			<?php if($kit['Kit']['hide_kit_kontent']) echo "Yes"; else echo "No" ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($kit['Kit']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($kit['Kit']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Kit'), array('action' => 'edit', $kit['Kit']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Kit'), array('action' => 'delete', $kit['Kit']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $kit['Kit']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Kits'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Kit'), array('action' => 'add')); ?> </li>

	</ul>
</div>
