<?php

class ExpensesController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/dashboard';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','export','admin'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
    	$model = $this->loadModel($id);

    	// Check if the logged-in user is admin
    	if (!Yii::app()->user->isAdmin) {
        	// If not admin, check if this record belongs to the user
        	if ($model->user_id != Yii::app()->user->id) {
            	throw new CHttpException(403, 'You are not authorized to view this record.');
        	}
    	}

    	$this->render('view', array(
        	'model' => $model,
    	));
	}

	public function actionExport()
	{
		// Disable layout and rendering
		$this->layout = false;
		Yii::app()->clientScript->reset(); // disable scripts if any

		// Define criteria for fetching expenses
		$criteria = new CDbCriteria();

		// If user is not admin, filter expenses by logged-in user ID
		if (!Yii::app()->user->isAdmin) {
			$criteria->compare('user_id', Yii::app()->user->id);
		}

		// Fetch expenses according to criteria, with eager loading of category to reduce queries
		$criteria->with = ['category'];

		$expenses = Expenses::model()->findAll($criteria);

		// Set CSV headers
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=expenses_export_' . date('Y-m-d') . '.csv');
		header('Pragma: no-cache');
		header('Expires: 0');

		// Open output stream
		$output = fopen('php://output', 'w');

		// Write the CSV column headers, replacing 'Category ID' with 'Category Name'
		fputcsv($output, ['ID', 'Category Name', 'Amount', 'Description', 'Date', 'Status']);

		// Write each expense row
		foreach ($expenses as $expense) {
			fputcsv($output, [
				$expense->id,
				isset($expense->category) ? $expense->category->name : 'N/A', // fallback if no category
				$expense->amount,
				$expense->description,
				$expense->date,
				$expense->status ? 'Approved' : 'Pending',
			]);
		}

		fclose($output);
		Yii::app()->end(); // terminate app after output
	}


	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Expenses;
		$listCategories = CHtml::listData(Category::model()->findAll(), 'id', 'name');

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Expenses']))
		{
			$model->attributes=$_POST['Expenses'];
			$model->user_id = Yii::app()->user->id; // Set the user ID

			print_r($model->attributes); exit;
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
			'listCategories'=>$listCategories,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model = $this->loadModel($id);
		$listCategories = CHtml::listData(Category::model()->findAll(), 'id', 'name');

		// Access check: if user is not admin and does not own this expense, deny access
		if (!Yii::app()->user->isAdmin && $model->user_id != Yii::app()->user->id) {
			throw new CHttpException(403, 'You are not authorized to update this record.');
		}

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Expenses'])) {
			$model->attributes = $_POST['Expenses'];

			// Only set user_id if you want to allow users to change ownership,
			// typically you wouldn’t reset user_id on update.
			// So, better to comment this out or check role before setting it.
			// $model->user_id = Yii::app()->user->id;

			if ($model->save())
				$this->redirect(array('view', 'id' => $model->id));
		}

		$this->render('update', array(
			'model' => $model,
			'listCategories' => $listCategories,
		));
	}


	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Expenses');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Expenses('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Expenses']))
			$model->attributes=$_GET['Expenses'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Expenses the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Expenses::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Expenses $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='expenses-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
