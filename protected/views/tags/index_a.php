<?php

?>

   <div class="panel panel-primary">
     <div class="panel-heading"><i class="fa fa-user"></i>Tunnit</div>
     <div class="panel-body">

  <table class="table table-striped" id="mobileTable">
  <thead class="myBgColors">
  <tr>
  <th><?php echo Yii::t('main', 'ID'); ?></th>
  <th><?php echo Yii::t('main', 'TAG'); ?></th>
  <th><?php echo Yii::t('main', 'Nimi'); ?></th>
  <th><?php echo Yii::t('main', 'PVM'); ?></th>
  <th><?php echo Yii::t('main', 'Aloitus'); ?></th>
  <th><?php echo Yii::t('main', 'Lopetus'); ?></th>
  <th><?php echo Yii::t('main', 'status'); ?></th>
  <th><?php echo Yii::t('main', 'Tilanne'); ?></th>

  </tr>
  </thead>
  <?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
  	'template'=>'{items}<table class="table table-striped table-condensed"></table><br/>{pager}',


	'pager' => array(
           'firstPageLabel'=>'<<',
           'prevPageLabel'=>'< Edellinen',
           'nextPageLabel'=>'Seuraava >',
           'lastPageLabel'=>'>>',
           //'maxButtonCount'=>'10',
           'header'=>'<h3>Siirry sivulle:</h3>',
           'cssFile'=>false,
       ), 

  )); ?>
  </table>

  </div>
</div>






