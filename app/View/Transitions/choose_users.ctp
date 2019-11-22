<div class="transitions form">
	<?php echo $this->Form->create('Transition', array('class' => 'vertical clearfix', 'url' => 'save')); ?>
	<fieldset>
		<legend><?php echo __('Choose User for transition'); ?></legend>
		<?php

		echo $this->Form->input('warehouses_places_from', array('type' => 'hidden'));
		echo $this->Form->input('status', array('type' => 'hidden'));
		echo $this->Form->input('type', array('type' => 'hidden'));
		echo $this->Form->input('show', array('type' => 'hidden'));
		echo $this->Form->input('created_by', array('type' => 'hidden'));
		echo $this->Form->input('code', array('type' => 'hidden'));
		if($show){
			echo $this->Form->input('issued_by', array('options' => $issued, 'class' => 'js-example-basic-single js-states form-control'));
		}
		if($showReceived){
			echo $this->Form->input('received_by', array('options' => $received, 'class' => 'js-example-basic-single js-states form-control'));
		}

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
