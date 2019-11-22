<?php
$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
	echo $this->Html->meta('icon');

	echo $this->Html->css('cake.generic');
	echo $this->Html->css('kickstart');
	echo $this->Html->css('style');
	echo $this->Html->css('select2');

	echo $this->fetch('meta');
	echo $this->fetch('css');
	echo $this->fetch('script');
	echo $this->Html->script('jquery.min');
	echo $this->Html->script('kickstart.js');
	echo $this->Html->script('select2.min.js');

	?>
<!--	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>-->

</head>
<body>

<ul class="menu">
	<li class="current">
		<?php echo $this->Html->link(
				'Home',
				array(
					'controller' => 'pages',
					'action' => 'display',
					'full_base' => true
				)
			)
		?>
	</li><?php if ((AuthComponent::user('group_id') == 1) || (AuthComponent::user('group_id') == 2) || (AuthComponent::user('group_id') == 3)){ //LOGIC FOR SHOWING ONLY TO ADMINS AND MANAGERS ?>
	<li><a href=""><span class="icon" data-icon="R">Items</a>
		<ul>
			<li>
				<?php echo
				$this->Html->link(
					'Measurement Units',
					array(
						'controller' => 'measurementUnits',
						'action' => 'index',
						'full_base' => true
					)
				) ?>
			</li>
			<li>
				<?php echo $this->Html->link(
						'Item Types',
						array(
							'controller' => 'itemTypes',
							'action' => 'index',
							'full_base' => true
						)
				) ?>
			</li>
			<li>
				<?php echo $this->Html->link(
					'Materials',
					array(
						'controller' => 'materials',
						'action' => 'index',
						'full_base' => true
					)
				)
				?>
			</li>
			<li>
				<?php echo $this->Html->link(
					'Semiproducts',
					array(
						'controller' => 'semiproducts',
						'action' => 'index',
						'full_base' => true
					)
				)
				?>
			</li>
			<li>
				<?php echo $this->Html->link(
					'Products',
					array(
						'controller' => 'products',
						'action' => 'index',
						'full_base' => true
					)
				)
				?>
			</li>
			<li>
				<?php echo $this->Html->link(
					'Goods',
					array(
						'controller' => 'goods',
						'action' => 'index',
						'full_base' => true
					)
				)
				?>
			</li>
			<li>
				<?php echo $this->Html->link(
					'Kits',
					array(
						'controller' => 'kits',
						'action' => 'index',
						'full_base' => true
					)
				)
				?>
			</li>
			<li>
				<?php echo $this->Html->link(
					'Consumables',
					array(
						'controller' => 'consumables',
						'action' => 'index',
						'full_base' => true
					)
				)
				?>
			</li>
			<li>
				<?php echo $this->Html->link(
					'Inventories',
					array(
						'controller' => 'inventories',
						'action' => 'index',
						'full_base' => true
					)
				)
				?>
			</li>
			<li>
				<?php echo $this->Html->link(
					'Service Products',
					array(
						'controller' => 'serviceProducts',
						'action' => 'index',
						'full_base' => true
					)
				)
				?>
			</li>
			<li>
				<?php echo $this->Html->link(
					'Service Suppliers',
					array(
						'controller' => 'serviceSuppliers',
						'action' => 'index',
						'full_base' => true
					)
				)
				?>
			</li>
		</ul>
	</li>
	<li><a href=""><span class="icon" data-icon="R"></span>Warehouses</a>
		<ul>
			<li>
				<?php echo $this->Html->link(
					'Warehouses',
					array(
						'controller' => 'warehouses',
						'action' => 'index',
						'full_base' => true
					)
				) ?>
			</li>
			<li>
				<?php echo $this->Html->link(
					'Warehouse Places',
					array(
						'controller' => 'warehousePlaces',
						'action' => 'index',
						'full_base' => true
					)
				) ?>
			</li>
			<li>
				<?php echo $this->Html->link(
					'Warehouse Adress',
					array(
						'controller' => 'warehouseAddresses',
						'action' => 'index',
						'full_base' => true
					)
				)
				?>
			</li>
			<li>
				<?php echo $this->Html->link(
					'Grant Permits',
					array(
						'controller' => 'permits',
						'action' => 'index',
						'full_base' => true
					)
				)
				?>
			</li>
			<li>
				<?php echo $this->Html->link(
					'Transitions',
					array(
						'controller' => 'transitions',
						'action' => 'index',
						'full_base' => true
					)
				)
				?>
			</li>
		</ul>
	</li>
	<li><a href=""><span class="icon" data-icon="R"></span>Users & Groups</a>
		<ul>
			<li>
				<?php echo $this->Html->link(
					'Users',
					array(
						'controller' => 'users',
						'action' => 'index',
						'full_base' => true
					)
				)
				?>
			</li>
			<li>
				<?php echo $this->Html->link(
					'Groups',
					array(
						'controller' => 'groups',
						'action' => 'index',
						'full_base' => true
					)
				)
				?>
			</li>
		</ul>
	</li> <?php } ?>
    <li>
        <?php
            echo $this->Html->link(
            'About',
            array(
                'controller' => 'home',
                'action' => 'about',
                'full_base' => true
            )
            )
        ?>
    </li>
	<li>
		<?php
			if (!$this->Session->read('Auth.User')) {
				echo $this->Html->link(
				'Login',
				array(
					'controller' => 'users',
					'action' => 'login',
					'full_base' => true
				)
			);
			}
			else{
				echo $this->Html->link(
				'Logout',
				array(
					'controller' => 'users',
					'action' => 'logout',
					'full_base' => true
				)
			);
			}
		?>
	</li>
</ul>
<?php echo $this->Flash->render(); ?>
<?php echo $this->Flash->render('auth'); ?>
<?php echo $this->Flash->render('bad'); ?>
<div class="grid">

	<!-- ===================================== END HEADER ===================================== -->
<!--col12-->
	<div class="col_12 grid">
		<?php echo $this->fetch('content'); ?>
	</div>

</div>

<div class="clear"></div>
<div id="footer">

	<?php echo $this->element('sql_dump'); ?>
</div>



</body>
</html>
