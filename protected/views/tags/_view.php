<?php
/* @var $this TagsController */
/* @var $data Tags */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tag_id')); ?>:</b>
	<?php echo CHtml::encode($data->tag_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('time')); ?>:</b>
	<?php echo CHtml::encode($data->time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('aloitus')); ?>:</b>
	<?php echo CHtml::encode($data->aloitus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lopetus')); ?>:</b>
	<?php echo CHtml::encode($data->lopetus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('etunimi')); ?>:</b>
	<?php echo CHtml::encode($data->etunimi); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('sukunimi')); ?>:</b>
	<?php echo CHtml::encode($data->sukunimi); ?>
	<br />

	*/ ?>

</div>