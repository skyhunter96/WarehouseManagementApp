<div class="materials index">
	<h2><?php echo __('Materials'); ?></h2>
	<?php echo $this->Form->create('Material', array('url' => 'index')) ?>
	<fieldset>
		<legend><?php echo __('Materials') ?></legend>
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
			<th><?php echo $this->Paginator->sort('is_for_service_production'); ?></th>
			<th><?php echo $this->Paginator->sort('recommended_rating'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($materials as $material): ?>
	<tr>
		<td><?php echo h($material['Material']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($material['Item']['name'], array('action' => 'view', $material['Material']['id'])); ?>
		</td>
		<td><?php echo h($material['Material']['status']); ?>&nbsp;</td>
		<td><?php if($material['Material']['is_for_service_production']) echo "Yes"; else echo "No" ?>&nbsp;</td>
		<td><?php echo h($material['Material']['recommended_rating']); ?>&nbsp;</td>
		<td><?php echo h($material['Material']['created']); ?>&nbsp;</td>
		<td><?php echo h($material['Material']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $material['Material']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $material['Material']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $material['Material']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $material['Material']['id']))); ?>
<!--			--><?php //echo $this->Html->link(__('Add to Warehouse'), array('action' => 'addToWarehouse', $material['Material']['id'])) ?>
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
	<?php echo $this->Form->create('Material', array('url' => 'import_excel', 'enctype' => 'multipart/form-data'))?>
	<?php echo $this->Form->input('excel_file', array('type' => 'file','between' => '<br />', )) ?>
	<?php echo $this->Form->end(__('Import')) ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Material'), array('action' => 'add')); ?></li>
        <li><?php echo $this->Html->link(__('Init TCPDF File'), array('action' => 'init_tcpdf')) ?></li>
	</ul>

</div>
