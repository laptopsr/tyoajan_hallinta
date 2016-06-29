<?php
/* @var $this TagsController */
/* @var $data Tags */

$tilanne = '';

if($data->status == 1){
$data->status = 'TYÖ';
$tilanne = '<span class="btn btn-warning btn-block">avoinna<span>';
} elseif($data->status == 11){
$data->status = 'TYÖ';
$tilanne = '<span class="btn btn-success btn-block">suljettu<span>';
} elseif($data->status == 2){
$data->status = 'LOUNASTAUKO';
$tilanne = '<span class="btn btn-warning btn-block">avoinna<span>';
} elseif($data->status == 22){
$data->status = 'LOUNASTAUKO';
$tilanne = '<span class="btn btn-success btn-block">suljettu<span>';
}

$aloitus = '';
if(!empty($data->aloitus))
$aloitus = date("H:i",strtotime($data->aloitus));

$lopetus = '';
if(!empty($data->lopetus))
$lopetus = date("H:i",strtotime($data->lopetus));
?>

<tr>

	<td><?php echo $data->id; ?></td>
	<td><?php echo $data->tag_id; ?></td>
	<td><?php echo $data->etunimi.' '.$data->sukunimi; ?></td>
	<td><?php echo date("d.m.Y",strtotime($data->aloitus)); ?></td>
	<td><?php echo $aloitus; ?></td>
	<td><?php echo $lopetus; ?></td>
	<td><?php echo $data->status; ?></td>
	<td><?php echo $tilanne; ?></td>
</tr>
