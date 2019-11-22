<div class="transitionsItems index">
	<h2><?php echo __('Transitions Items'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('transitions_id'); ?></th>
			<th><?php echo $this->Paginator->sort('items_id'); ?></th>
			<th><?php echo $this->Paginator->sort('demanded_quantity'); ?></th>
			<th><?php echo $this->Paginator->sort('issued_quantity'); ?></th>
			<th><?php echo $this->Paginator->sort('from_address'); ?></th>
			<th><?php echo $this->Paginator->sort('to_address'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($transitionsItems as $transitionsItem): ?>
	<tr>
		<td><?php echo h($transitionsItem['TransitionsItem']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($transitionsItem['Transitions']['id'], array('controller' => 'transitions', 'action' => 'view', $transitionsItem['Transitions']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($transitionsItem['Items']['name'], array('controller' => 'items', 'action' => 'view', $transitionsItem['Items']['id'])); ?>
		</td>
		<td><?php echo h($transitionsItem['TransitionsItem']['demanded_quantity']); ?>&nbsp;</td>
		<td><?php echo h($transitionsItem['TransitionsItem']['issued_quantity']); ?>&nbsp;</td>
		<td><?php echo h($transitionsItem['TransitionsItem']['from_address']); ?>&nbsp;</td>
		<td><?php echo h($transitionsItem['TransitionsItem']['to_address']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $transitionsItem['TransitionsItem']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $transitionsItem['TransitionsItem']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $transitionsItem['TransitionsItem']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $transitionsItem['TransitionsItem']['id']))); ?>
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
		<li><?php echo $this->Html->link(__('New Transitions Item'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Transitions'), array('controller' => 'transitions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Transitions'), array('controller' => 'transitions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Items'), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Items'), array('controller' => 'items', 'action' => 'add')); ?> </li>
	</ul>
</div>
