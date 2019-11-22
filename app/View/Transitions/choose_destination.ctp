<div class="transitions form">
	<?php echo $this->Form->create('Transition', array('class' => 'vertical clearfix', 'url' => 'insert')); ?>
	<fieldset>
		<legend><?php echo __('Choose Destination for Transition'); ?></legend>
		<?php

		echo $this->Form->input('addressFrom', array('type' => 'hidden'));
		echo $this->Form->input('address', array('type' => 'hidden'));
		echo $this->Form->input('items', array('type' => 'hidden'));
		echo $this->Form->input('received_by', array('type' => 'hidden'));
		echo $this->Form->input('demanded_quantity', array('type' => 'hidden'));
		echo $this->Form->input('issued_quantity', array('type' => 'hidden'));
		echo $this->Form->input('destination_address', array('options' => $addressTo, 'class' => 'js-example-basic-single js-states form-control'));

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
