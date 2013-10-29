<?php echo $this->Html->css('cake.generic'); ?>
<div class="widgets form">
<?php echo $this->Form->create('Widget'); ?>
	<fieldset>
		<legend><?php echo __('Edit Widget'); ?></legend>
	<?php
		echo $this->Form->input('id');
		//echo $this->Form->input('user_id');
		echo $this->Form->input('url');
		echo $this->Form->input('title');
		echo $this->Form->input('nr_of_articles');
		echo $this->Form->input('_column');
		echo $this->Form->input('_order');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Widget.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Widget.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Widgets'), array('action' => 'index')); ?></li>
	</ul>
</div>
