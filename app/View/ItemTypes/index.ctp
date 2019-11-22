<div class="itemTypes index">
	<h2><?php echo __('Item Types'); ?></h2>
	<?php echo $this->Form->create('ItemType', array('url' => 'index')) ?>
	<fieldset>
		<legend><?php echo __('Search Products') ?></legend>
		<?php
		echo $this->Form->input('keywords');
		?>
	</fieldset>
	<?php echo $this->Form->end(__('Submit')) ?>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('code'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('class'); ?></th>
			<th><?php echo $this->Paginator->sort('tangible'); ?></th>
			<th><?php echo $this->Paginator->sort('active'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($itemTypes as $itemType): ?>
	<tr>
		<td><?php echo h($itemType['ItemType']['id']); ?>&nbsp;</td>
		<td><?php echo h($itemType['ItemType']['code']); ?>&nbsp;</td>
		<td><?php echo h($itemType['ItemType']['name']); ?>&nbsp;</td>
		<td><?php echo h($itemType['ItemType']['class']); ?>&nbsp;</td>
		<td><?php if($itemType['ItemType']['tangible']) echo "Yes"; else echo "No" ?></td>
		<td><?php if($itemType['ItemType']['active']) echo "Yes"; else echo "No" ?></td>
		<td><?php echo h($itemType['ItemType']['created']); ?>&nbsp;</td>
		<td><?php echo h($itemType['ItemType']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $itemType['ItemType']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'save', $itemType['ItemType']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $itemType['ItemType']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $itemType['ItemType']['id']))); ?>
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
		<li><?php echo $this->Html->link(__('New Item Type'), array('action' => 'save')); ?></li>
		<li><?php echo $this->Html->link(__('Init TCPDF File'), array('action' => 'init_tcpdf')) ?></li>
	</ul>
</div>
