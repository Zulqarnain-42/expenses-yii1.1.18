<?php

/**
 * This is the model class for table "expenses".
 *
 * The followings are the available columns in table 'expenses':
 * @property string $id
 * @property string $category_id
 * @property string $amount
 * @property string $description
 * @property string $date
 * @property string $status
 * @property string $admin_comment
 * @property string $created_at
 * @property string $updated_at
 * @property int $user_id
 */
class Expenses extends CActiveRecord
{
    public $date_from;
    public $date_to;


	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'expenses';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('category_id, amount, date', 'required'),
			array('amount', 'length', 'max'=>10),
			array('description, admin_comment, created_at, updated_at', 'safe'),

			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
            array('category_id, amount, description, date, user_id, status, from_date, to_date', 'safe', 'on'=>'search'),
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
			'category' => array(self::BELONGS_TO, 'Category', 'category_id'),
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'category_id' => 'Category',
			'amount' => 'Amount',
			'description' => 'Description',
			'date' => 'Date',
			'status' => 'Status',
			'admin_comment' => 'Admin Comment',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('category_id',$this->category_id,true);
		$criteria->compare('amount',$this->amount,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('admin_comment',$this->admin_comment,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);

		if (!empty($this->date_from) && !empty($this->date_to)) {
            $criteria->addCondition("t.date >= :date_from AND t.date <= :date_to");
            $criteria->params[':date_from'] = $this->date_from;
            $criteria->params[':date_to']   = $this->date_to;
        } elseif (!empty($this->date_from)) {
            $criteria->addCondition("t.date >= :date_from");
            $criteria->params[':date_from'] = $this->date_from;
        } elseif (!empty($this->date_to)) {
            $criteria->addCondition("t.date <= :date_to");
            $criteria->params[':date_to'] = $this->date_to;
        }

		return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'sort'=>array(
                'defaultOrder'=>'t.date DESC',
            ),
        ));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Expenses the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function getStatusOptions()
	{
    	return array(
        	'draft' => 'Draft',
        	'approved' => 'Approved',
			'disapproved' => 'Disapproved'
    	);
	}
}
