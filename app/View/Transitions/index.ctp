<div class="transitions index">
	<h2><?php echo __('Transitions'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('code'); ?></th>
			<th><?php echo $this->Paginator->sort('user_created_by'); ?></th>
			<th><?php echo $this->Paginator->sort('warehouses_places_from'); ?></th>
			<th><?php echo $this->Paginator->sort('warehouses_places_to'); ?></th>
			<th><?php echo $this->Paginator->sort('user_issued_by'); ?></th>
			<th><?php echo $this->Paginator->sort('user_received_by'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('type'); ?></th>
			<th><?php echo $this->Paginator->sort('work_order'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($transitions as $transition): ?>
	<tr>
		<td><?php echo h($transition['Transition']['id']); ?>&nbsp;</td>
		<td><?php echo h($transition['Transition']['code']); ?>&nbsp;</td>
		<td><?php echo h($transition['Transition']['user_created_by']); ?>&nbsp;</td>
		<td><?php echo h($transition['Transition']['warehouses_places_from']); ?>&nbsp;</td>
		<td><?php echo h($transition['Transition']['warehouses_places_to']); ?>&nbsp;</td>
		<td><?php echo h($transition['Transition']['user_issued_by']); ?>&nbsp;</td>
		<td><?php echo h($transition['Transition']['user_received_by']); ?>&nbsp;</td>
		<td><?php echo h($transition['Transition']['status']); ?>&nbsp;</td>
		<td><?php echo h($transition['Transition']['type']); ?>&nbsp;</td>
		<td><?php echo h($transition['Transition']['work_order']); ?>&nbsp;</td>
		<td><?php echo h($transition['Transition']['created']); ?>&nbsp;</td>
		<td><?php echo h($transition['Transition']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Add Items'), array('action' => 'chooseAddresses', $transition['Transition']['id'])); ?>
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $transition['Transition']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $transition['Transition']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $transition['Transition']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $transition['Transition']['id']))); ?>
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
		<li><?php echo $this->Html->link(__('New Transition'), array('action' => 'add')); ?></li>
	</ul>
</div>
