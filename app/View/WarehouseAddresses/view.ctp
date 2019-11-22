<div class="warehouseAddresses view">
<h2><?php echo __('Warehouse Address'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($warehouseAddress['WarehouseAddress']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Code'); ?></dt>
		<dd>
			<?php echo h($warehouseAddress['WarehouseAddress']['code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Row'); ?></dt>
		<dd>
			<?php echo h($warehouseAddress['WarehouseAddress']['row']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Shelf'); ?></dt>
		<dd>
			<?php echo h($warehouseAddress['WarehouseAddress']['shelf']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Partition'); ?></dt>
		<dd>
			<?php echo h($warehouseAddress['WarehouseAddress']['partition']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Barcode'); ?></dt>
		<dd>
			<?php echo h($warehouseAddress['WarehouseAddress']['barcode']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Warehouse Places'); ?></dt>
		<dd>
			<?php echo $this->Html->link($warehouseAddress['WarehousePlaces']['name'], array('controller' => 'warehouse_places', 'action' => 'view', $warehouseAddress['WarehousePlaces']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Active'); ?></dt>
		<dd>
			<?php if($warehouseAddress['WarehouseAddress']['active']) echo "Yes"; else echo "No" ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($warehouseAddress['WarehouseAddress']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($warehouseAddress['WarehouseAddress']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
	<fieldset>
		<legend><?php echo __('Items on this address') ?></legend>
	</fieldset>

	<table cellpadding="0" cellspacing="0">
		<thead>
		<tr>
			<th><?php echo $this->Paginator->sort('item_id'); ?></th>
			<th><?php echo $this->Paginator->sort('code'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('total') ?></th>
			<th><?php echo (__('Remove from this Address'))?></th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($items as $item): ?>
			<tr>
				<td><?php echo h($item['Items']['id']); ?>&nbsp;</td>
				<td><?php echo h($item['Items']['code']); ?>&nbsp;</td>
				<td><?php echo h($item['Items']['name']); ?>&nbsp;</td>
				<td><?php echo h($item['ItemsAddress']['total']); ?></td>
				<td><?php echo $this->Form->postLink(__('Remove'), array('action' => 'removeFromAddress', $item['Items']['id']), array('confirm' => __('Are you sure you want to remove this Item from this Address'))); ?> </td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
	<?php if ($warehouseAddress['WarehouseAddress']['active']):  ?>
	<?php echo $this->Form->create('Item', array('url' => 'itemToAdd')) ?>
	<fieldset>
		<legend><?php echo __('Item') ?></legend>
		<?php echo $this->Form->input('item_id', array('type' => 'hidden')); ?>
		<?php echo $this->Form->input('item_name', array('type' => 'hidden', 'required' => false, 'div' => false)); ?>
		<?php echo $this->Form->input('total', array('required' => true)); ?>
	</fieldset>
	<?php echo $this->Form->end(__('Add this item')) ?>
	<?php endif; ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Address'), array('action' => 'edit', $warehouseAddress['WarehouseAddress']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Address'), array('action' => 'delete', $warehouseAddress['WarehouseAddress']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $warehouseAddress['WarehouseAddress']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Addresses'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Address'), array('action' => 'add')); ?> </li>
	</ul>
</div>
<script>
    $(document).ready(function() {
        // $('.js-example-basic-single').select2();

        $('#ItemItemId').select2({
            minimumInputLength: 0,
            placeholder: "Odaberite artikal",
            allowClear: true,
            query: function(query){
                var process = {results: []};
                $.ajax({
                    dataType: 'json',
                    type: 'POST',
                    evalScripts: true,
                    data: ({term: query.term}),
                    url: '/WarehouseManagementApp/WarehouseAddresses/searchItem',
                    success: function(data){
                        console.log(data);
                        var index;
                        for (var index = 0; index < data.length; ++index) {
                            process.results.push({id: data[index].Item.id, text: data[index].Item.code + ' - ' + data[index].Item.name });
                        };
                        query.callback(process);
                    },
                    error:function(xhr){
                        //Show message
                        var error_msg = 'Error: ' + xhr.status + ' ' + xhr.statusText;
                        alert(error_msg);

                    }
                });
            },
            initSelection : function (element, callback) {
                var data = {id: $("#ItemItemId").val(), text: $("#ItemItemName").val()};
                callback(data);
            }
        });
        //Fill-up form based on client selection
        $("#ItemItemId").on("select2-selecting", function(e) {
            //Set client title value
            $("#ItemItemName").val(e.object.text);
        });
        //Clear client selection
        $('#ItemItemId').on("select2-clearing", function(e) {
            //Clear client title value
            $('#ItemItemName').val('');
        });


    });
</script>
