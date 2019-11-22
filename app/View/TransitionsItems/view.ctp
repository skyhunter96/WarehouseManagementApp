<div class="transitionsItems view">
<h2><?php echo __('Transitions Item'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($transitionsItem['TransitionsItem']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Transitions'); ?></dt>
		<dd>
			<?php echo $this->Html->link($transitionsItem['Transitions']['id'], array('controller' => 'transitions', 'action' => 'view', $transitionsItem['Transitions']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Items'); ?></dt>
		<dd>
			<?php echo $this->Html->link($transitionsItem['Items']['name'], array('controller' => 'items', 'action' => 'view', $transitionsItem['Items']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Demanded Quantity'); ?></dt>
		<dd>
			<?php echo h($transitionsItem['TransitionsItem']['demanded_quantity']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Issued Quantity'); ?></dt>
		<dd>
			<?php echo h($transitionsItem['TransitionsItem']['issued_quantity']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('From Address'); ?></dt>
		<dd>
			<?php echo h($transitionsItem['TransitionsItem']['from_address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('To Address'); ?></dt>
		<dd>
			<?php echo h($transitionsItem['TransitionsItem']['to_address']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Transitions Item'), array('action' => 'edit', $transitionsItem['TransitionsItem']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Transitions Item'), array('action' => 'delete', $transitionsItem['TransitionsItem']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $transitionsItem['TransitionsItem']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Transitions Items'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Transitions Item'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Transitions'), array('controller' => 'transitions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Transitions'), array('controller' => 'transitions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Items'), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Items'), array('controller' => 'items', 'action' => 'add')); ?> </li>
	</ul>
</div>
