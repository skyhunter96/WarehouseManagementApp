<div class="products index">
	<h2><?php echo __('Products'); ?></h2>
	<?php echo $this->Form->create('Product', array('url' => 'index')) ?>
		<fieldset>
			<legend><?php echo __('Search Products') ?></legend>
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
			<th><?php echo $this->Paginator->sort('pid'); ?></th>
			<th><?php echo $this->Paginator->sort('hts_number'); ?></th>
			<th><?php echo $this->Paginator->sort('tax_group'); ?></th>
			<th><?php echo $this->Paginator->sort('eccn'); ?></th>
			<th><?php echo $this->Paginator->sort('release_date'); ?></th>
			<th><?php echo $this->Paginator->sort('is_for_distributors'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('is_for_service_production'); ?></th>
			<th><?php echo $this->Paginator->sort('project'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($products as $product): ?>
	<tr>
		<td><?php echo h($product['Product']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($product['Item']['name'], array('action' => 'view', $product['Product']['id'])); ?>
		</td>
		<td><?php echo h($product['Product']['pid']); ?>&nbsp;</td>
		<td><?php echo h($product['Product']['hts_number']); ?>&nbsp;</td>
		<td><?php echo h($product['Product']['tax_group']); ?>&nbsp;</td>
		<td><?php echo h($product['Product']['eccn']); ?>&nbsp;</td>
		<td><?php echo h($product['Product']['release_date']); ?>&nbsp;</td>
		<td><?php if($product['Product']['is_for_distributors']) echo "Yes"; else echo "No" ?>&nbsp;</td>
		<td><?php echo h($product['Product']['status']); ?>&nbsp;</td>
		<td><?php if ($product['Product']['is_for_service_production']) echo "Yes"; else echo "No" ?>&nbsp;</td>
		<td><?php echo h($product['Product']['project']); ?>&nbsp;</td>
		<td><?php echo h($product['Product']['created']); ?>&nbsp;</td>
		<td><?php echo h($product['Product']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $product['Product']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $product['Product']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $product['Product']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $product['Product']['id']))); ?>
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
		<li><?php echo $this->Html->link(__('New Product'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Init TCPDF File'), array('action' => 'init_tcpdf')) ?></li>
	</ul>
</div>
