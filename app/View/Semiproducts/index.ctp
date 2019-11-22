<div class="semiproducts index">
	<h2><?php echo __('Semiproducts'); ?></h2>
	<?php echo $this->Form->create('Semiproduct', array('url' => 'index')) ?>
	<fieldset>
		<legend><?php echo __('Search Semiproducts') ?></legend>
		<?php
		echo $this->Form->input('keywords');
		?>
	</fieldset>
	<?php echo $this->Form->end(__('Submit')) ?>
	<h2><?php echo __('Semiproducts'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('item_id'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('is_for_service_production'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($semiproducts as $semiproduct): ?>
	<tr>
		<td><?php echo h($semiproduct['Semiproduct']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($semiproduct['Item']['name'], array('action' => 'view', $semiproduct['Semiproduct']['id'])); ?>
		</td>
		<td><?php echo h($semiproduct['Semiproduct']['status']); ?>&nbsp;</td>
		<td><?php if($semiproduct['Semiproduct']['is_for_service_production']) echo "Yes"; else echo "No" ?>&nbsp;</td>
		<td><?php echo h($semiproduct['Semiproduct']['created']); ?>&nbsp;</td>
		<td><?php echo h($semiproduct['Semiproduct']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $semiproduct['Semiproduct']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $semiproduct['Semiproduct']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $semiproduct['Semiproduct']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $semiproduct['Semiproduct']['id']))); ?>
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
		<li><?php echo $this->Html->link(__('New Semiproduct'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Init TCPDF File'), array('action' => 'init_tcpdf')) ?></li>
	</ul>
</div>
