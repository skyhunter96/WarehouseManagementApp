<div class="materials view">
<h2><?php echo __('Material'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($material['Material']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Code'); ?></dt>
		<dd>
			<?php echo h($material['Item']['code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Item'); ?></dt>
		<dd>
			<?php echo $this->Html->link($material['Item']['name'], array('controller' => 'items', 'action' => 'view', $material['Item']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Item Type'); ?></dt>
		<dd>
			<?php echo h($item_type['ItemType']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Decription'); ?></dt>
		<dd>
			<?php echo h($material['Item']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Weight'); ?></dt>
		<dd>
			<?php echo h($material['Item']['weight']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Measurement unit'); ?></dt>
		<dd>
			<?php if(isset(($measurement_unit['MeasurementUnit']))) echo h($measurement_unit['MeasurementUnit']['name']); else echo "Nema" ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($material['Material']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is For Service Production'); ?></dt>
		<dd>
			<?php if($material['Material']['is_for_service_production']) echo "Yes"; else echo "No"; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Recommended Rating'); ?></dt>
		<dd>
			<?php echo h($material['Material']['recommended_rating']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($material['Material']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($material['Material']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Material'), array('action' => 'edit', $material['Material']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Material'), array('action' => 'delete', $material['Material']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $material['Material']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Materials'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Material'), array('action' => 'add')); ?> </li>

	</ul>
</div>
