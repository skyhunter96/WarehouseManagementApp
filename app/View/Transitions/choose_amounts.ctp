<div class="transitions form">
	<?php echo $this->Form->create('Transition', array('class' => 'vertical clearfix', 'url' => 'chooseDestination')); ?>
	<fieldset>
		<legend><?php echo __('Choose Amounts for Transition'); ?></legend>
		<?php

		echo $this->Form->input('address', array('type' => 'hidden'));
		echo $this->Form->input('items', array('type' => 'hidden'));
		echo $this->Form->input('demanded_quantity', array('default' => $demanded_quantity, 'required' => true, ));
		echo $this->Form->input('issued_quantity', array('required' => true, ));

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
