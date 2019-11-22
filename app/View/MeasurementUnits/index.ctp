<div class="measurementUnits index">
	<h2><?php echo __('Measurement Units'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('symbol'); ?></th>
			<th><?php echo $this->Paginator->sort('active'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($measurementUnits as $measurementUnit): ?>
	<tr>
		<td><?php echo h($measurementUnit['MeasurementUnit']['id']); ?>&nbsp;</td>
		<td><?php echo h($measurementUnit['MeasurementUnit']['name']); ?>&nbsp;</td>
		<td><?php echo h($measurementUnit['MeasurementUnit']['symbol']); ?>&nbsp;</td>
		<td><?php if($measurementUnit['MeasurementUnit']['active']) echo "Yes"; else echo "No" ?>&nbsp;</td>
		<td><?php echo h($measurementUnit['MeasurementUnit']['created']); ?>&nbsp;</td>
		<td><?php echo h($measurementUnit['MeasurementUnit']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $measurementUnit['MeasurementUnit']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $measurementUnit['MeasurementUnit']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $measurementUnit['MeasurementUnit']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $measurementUnit['MeasurementUnit']['id']))); ?>
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
		<li><?php echo $this->Html->link(__('New Unit'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Init TCPDF File'), array('action' => 'init_tcpdf')) ?></li>
	</ul>
</div>
