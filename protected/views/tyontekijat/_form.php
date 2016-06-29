<?php
/* @var $this TyontekijatController */
/* @var $model Tyontekijat */
/* @var $form CActiveForm */
?>

<div class="row form">
 <div class="col-sm-4">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tyontekijat-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'tag_id'); ?>
		<?php echo $form->textField($model,'tag_id',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'tag_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'etunimi'); ?>
		<?php echo $form->textField($model,'etunimi',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'etunimi'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sukunimi'); ?>
		<?php echo $form->textField($model,'sukunimi',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'sukunimi'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Luo' : 'Tallenna', array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>
 </div>
</div><!-- form -->
