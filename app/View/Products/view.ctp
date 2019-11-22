<div class="products view">
<h2><?php echo __('Product'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($product['Product']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Code'); ?></dt>
		<dd>
			<?php echo h($product['Item']['code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Item'); ?></dt>
		<dd>
			<?php echo $this->Html->link($product['Item']['name'], array('controller' => 'items', 'action' => 'view', $product['Item']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pid'); ?></dt>
		<dd>
			<?php echo h($product['Product']['pid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Item Type'); ?></dt>
		<dd>
			<?php echo h($item_type['ItemType']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Decription'); ?></dt>
		<dd>
			<?php echo h($product['Item']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Weight'); ?></dt>
		<dd>
			<?php echo h($product['Item']['weight']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Measurement unit'); ?></dt>
		<dd>
			<?php echo h($measurement_unit['MeasurementUnit']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Hts Number'); ?></dt>
		<dd>
			<?php echo h($product['Product']['hts_number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tax Group'); ?></dt>
		<dd>
			<?php echo h($product['Product']['tax_group']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Eccn'); ?></dt>
		<dd>
			<?php echo h($product['Product']['eccn']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Release Date'); ?></dt>
		<dd>
			<?php echo h($product['Product']['release_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is For Distributors'); ?></dt>
		<dd>
			<?php if ($product['Product']['is_for_distributors']) echo "Yes"; else echo "No"; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($product['Product']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is For Service Production'); ?></dt>
		<dd>
			<?php if($product['Product']['is_for_service_production']) echo "Yes"; else echo "No" ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Project'); ?></dt>
		<dd>
			<?php echo h($product['Product']['project']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($product['Product']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($product['Product']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Product'), array('action' => 'edit', $product['Product']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Product'), array('action' => 'delete', $product['Product']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $product['Product']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('action' => 'add')); ?> </li>

	</ul>
</div>
