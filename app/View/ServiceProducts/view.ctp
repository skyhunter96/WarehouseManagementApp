<div class="serviceProducts view">
<h2><?php echo __('Service Product'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($serviceProduct['ServiceProduct']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Item'); ?></dt>
		<dd>
			<?php echo $this->Html->link($serviceProduct['Item']['name'], array('controller' => 'items', 'action' => 'view', $serviceProduct['Item']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pid'); ?></dt>
		<dd>
			<?php echo h($serviceProduct['ServiceProduct']['pid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Hts Number'); ?></dt>
		<dd>
			<?php echo h($serviceProduct['ServiceProduct']['hts_number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tax Group'); ?></dt>
		<dd>
			<?php echo h($serviceProduct['ServiceProduct']['tax_group']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Eccn'); ?></dt>
		<dd>
			<?php echo h($serviceProduct['ServiceProduct']['eccn']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Release Date'); ?></dt>
		<dd>
			<?php echo h($serviceProduct['ServiceProduct']['release_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is For Distributors'); ?></dt>
		<dd>
			<?php if ($serviceProduct['ServiceProduct']['is_for_distributors']) echo "Yes"; else echo "No" ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($serviceProduct['ServiceProduct']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Project'); ?></dt>
		<dd>
			<?php echo h($serviceProduct['ServiceProduct']['project']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($serviceProduct['ServiceProduct']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($serviceProduct['ServiceProduct']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Service Product'), array('action' => 'edit', $serviceProduct['ServiceProduct']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Service Product'), array('action' => 'delete', $serviceProduct['ServiceProduct']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $serviceProduct['ServiceProduct']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Service Products'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Service Product'), array('action' => 'add')); ?> </li>
	</ul>
</div>
