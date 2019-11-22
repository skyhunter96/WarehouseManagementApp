<div class="itemTypes view">
<h2><?php echo __('Item Type'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($itemType['ItemType']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Code'); ?></dt>
		<dd>
			<?php echo h($itemType['ItemType']['code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($itemType['ItemType']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Class'); ?></dt>
		<dd>
			<?php echo h($itemType['ItemType']['class']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tangible'); ?></dt>
		<dd>

			<?php if($itemType['ItemType']['tangible']) echo "Yes"; else echo "No" ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Active'); ?></dt>
		<dd>

			<?php if($itemType['ItemType']['active']) echo "Yes"; else echo "No" ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($itemType['ItemType']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($itemType['ItemType']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Item Type'), array('action' => 'edit', $itemType['ItemType']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Item Type'), array('action' => 'delete', $itemType['ItemType']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $itemType['ItemType']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Item Types'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item Type'), array('action' => 'add')); ?> </li>
	</ul>
</div>

