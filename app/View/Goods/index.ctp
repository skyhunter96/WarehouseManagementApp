<div class="goods index">
	<h2><?php echo __('Goods'); ?></h2>
	<?php echo $this->Form->create('Good', array('url' => 'index')) ?>
	<fieldset>
		<legend><?php echo __('Search Goods') ?></legend>
		<?php
		echo $this->Form->input('Item.keywords');
		?>
	</fieldset>
	<?php echo $this->Form->end(__('Submit')) ?>
	<h2><?php echo __('Goods'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('item_id'); ?></th>
			<th><?php echo $this->Paginator->sort('pid'); ?></th>
			<th><?php echo $this->Paginator->sort('hts_number'); ?></th>
			<th><?php echo $this->Paginator->sort('tax_group'); ?></th>
			<th><?php echo $this->Paginator->sort('eccn'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('release_date'); ?></th>
			<th><?php echo $this->Paginator->sort('is_for_distributors'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($goods as $good): ?>
	<tr>
		<td><?php echo h($good['Good']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($good['Item']['name'], array('action' => 'view', $good['Good']['id'])); ?>
		</td>
		<td><?php echo h($good['Good']['pid']); ?>&nbsp;</td>
		<td><?php echo h($good['Good']['hts_number']); ?>&nbsp;</td>
		<td><?php echo h($good['Good']['tax_group']); ?>&nbsp;</td>
		<td><?php echo h($good['Good']['eccn']); ?>&nbsp;</td>
		<td><?php echo h($good['Good']['status']); ?>&nbsp;</td>
		<td><?php echo h($good['Good']['release_date']); ?>&nbsp;</td>
		<td><?php if ($good['Good']['is_for_distributors']) echo "Yes"; else echo "No" ?>&nbsp;</td>
		<td><?php echo h($good['Good']['created']); ?>&nbsp;</td>
		<td><?php echo h($good['Good']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $good['Good']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $good['Good']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $good['Good']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $good['Good']['id']))); ?>
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
		<li><?php echo $this->Html->link(__('New Good'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Init TCPDF File'), array('action' => 'init_tcpdf')) ?></li>
	</ul>
</div>
