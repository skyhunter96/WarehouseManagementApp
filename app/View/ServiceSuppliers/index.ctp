<div class="serviceSuppliers index">
	<h2><?php echo __('Service Suppliers'); ?></h2>
	<?php echo $this->Form->create('ServiceProduct', array('url' => 'index')) ?>
	<fieldset>
		<legend><?php echo __('Service Suppliers') ?></legend>
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
	<?php foreach ($serviceSuppliers as $serviceSupplier): ?>
	<tr>
		<td><?php echo h($serviceSupplier['ServiceSupplier']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($serviceSupplier['Item']['name'], array('action' => 'view', $serviceSupplier['ServiceSupplier']['id'])); ?>
		</td>
		<td><?php echo h($serviceSupplier['ServiceSupplier']['status']); ?>&nbsp;</td>
		<td><?php echo h($serviceSupplier['ServiceSupplier']['recommended_rating']); ?>&nbsp;</td>
		<td><?php echo h($serviceSupplier['ServiceSupplier']['created']); ?>&nbsp;</td>
		<td><?php echo h($serviceSupplier['ServiceSupplier']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $serviceSupplier['ServiceSupplier']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $serviceSupplier['ServiceSupplier']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $serviceSupplier['ServiceSupplier']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $serviceSupplier['ServiceSupplier']['id']))); ?>
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
		<li><?php echo $this->Html->link(__('New Service Supplier'), array('action' => 'add')); ?></li>a
		<li><?php echo $this->Html->link(__('Init TCPDF File'), array('action' => 'init_tcpdf')) ?></li>
	</ul>
</div>
