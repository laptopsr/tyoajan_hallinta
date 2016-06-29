<?php

/**
 * This is the model class for table "tags".
 *
 * The followings are the available columns in table 'tags':
 * @property integer $id
 * @property string $tag_id
 * @property string $time
 * @property string $aloitus
 * @property string $lopetus
 * @property integer $status
 * @property integer $etunimi
 * @property integer $sukunimi
 */
class Tags extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tags';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tag_id, time, aloitus, lopetus, status, etunimi, sukunimi', 'required'),
			array('status, etunimi, sukunimi', 'numerical', 'integerOnly'=>true),
			array('tag_id', 'length', 'max'=>255),
			array('aloitus, lopetus', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, tag_id, time, aloitus, lopetus, status, etunimi, sukunimi', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'tag_id' => 'Tag',
			'time' => 'Time',
			'aloitus' => 'Aloitus',
			'lopetus' => 'Lopetus',
			'status' => 'Status',
			'etunimi' => 'Etunimi',
			'sukunimi' => 'Sukunimi',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('tag_id',$this->tag_id,true);
		$criteria->compare('time',$this->time,true);
		$criteria->compare('aloitus',$this->aloitus,true);
		$criteria->compare('lopetus',$this->lopetus,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('etunimi',$this->etunimi);
		$criteria->compare('sukunimi',$this->sukunimi);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Tags the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
