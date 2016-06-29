<?php
/* @var $this TyontekijatController */
/* @var $data Tyontekijat */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tag_id')); ?>:</b>
	<?php echo CHtml::encode($data->tag_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('etunimi')); ?>:</b>
	<?php echo CHtml::encode($data->etunimi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sukunimi')); ?>:</b>
	<?php echo CHtml::encode($data->sukunimi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />


</div>