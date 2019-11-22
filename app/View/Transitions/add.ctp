<div class="transitions form">
<?php echo $this->Form->create('Transition', array('class' => 'vertical clearfix', 'url' => 'chooseUsers')); ?>
	<fieldset>
		<legend><?php echo __('Add Transition'); ?></legend>
	<?php

		echo $this->Form->input('warehouses_places_from', array('options' => $warehousePlaces, 'class' => 'js-example-basic-single js-states form-control'));
		echo $this->Form->input('status', array('options' => $status));
		echo $this->Form->input('type', array('options' => $type));

	?>
	</fieldset>
<?php echo $this->Form->end(__('Next')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Transitions'), array('action' => 'index')); ?></li>
	</ul>
</div>

<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>
