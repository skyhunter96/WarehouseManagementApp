<div class="consumables index">
	<h2><?php echo __('Consumables'); ?></h2>
	<?php echo $this->Form->create('Consumable', array('url' => 'index')) ?>
	<fieldset>
		<legend><?php echo __('Search Consumables') ?></legend>
		<?php
		echo $this->Form->input('Item.keywords');
		?>
	</fieldset>
	<?php echo $this->Form->end(__('Submit')) ?>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('item_id'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('recommended_rating'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($consumables as $consumable): ?>
	<tr>
		<td><?php echo h($consumable['Consumable']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($consumable['Item']['name'], array('action' => 'view', $consumable['Consumable']['id'])); ?>
		</td>
		<td><?php echo h($consumable['Consumable']['status']); ?>&nbsp;</td>
		<td><?php echo h($consumable['Consumable']['recommended_rating']); ?>&nbsp;</td>
		<td><?php echo h($consumable['Consumable']['created']); ?>&nbsp;</td>
		<td><?php echo h($consumable['Consumable']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $consumable['Consumable']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $consumable['Consumable']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $consumable['Consumable']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $consumable['Consumable']['id']))); ?>
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
		<li><?php echo $this->Html->link(__('New Consumable'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Init TCPDF File'), array('action' => 'init_tcpdf')) ?></li>
	</ul>
</div>
