<div class="transitions form">
	<?php echo $this->Form->create('TransitionsItem', array('class' => 'vertical clearfix', 'url' => 'chooseItems')); ?>
	<fieldset>
		<legend><?php echo __('Choose Addresses for Transition'); ?></legend>
		<?php
		echo $this->Form->input('received_by', array('type' => 'hidden'));
		echo $this->Form->input('addresses', array('options' => $address, 'class' => 'js-example-basic-single js-states form-control'));

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
