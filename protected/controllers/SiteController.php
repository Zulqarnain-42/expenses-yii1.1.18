<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$this->layout = false;
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	public function actionDashboard()
	{
		$this->layout = '//layouts/dashboard';

		$userId = Yii::app()->user->id;
		$isAdmin = Yii::app()->user->role === 'admin';

		$labels = [];
		$data = [];
		$totalExpenses = 0;

		if ($isAdmin) {
			// Admin: Show all categories with total expenses (across all users)
			$categories = Category::model()->with('expenses')->findAll();

			foreach ($categories as $category) {
				$labels[] = $category->name;

				$totalAmount = 0;
				foreach ($category->expenses as $expense) {
					$amount = (float) $expense->amount;
					$totalAmount += $amount;
					$totalExpenses += $amount; // accumulate overall total
				}

				$data[] = $totalAmount;
			}

		} else {
			// Regular user: Only show categories this user has used (based on their expenses)
			$expenses = Expenses::model()->with('category')->findAllByAttributes([
				'user_id' => $userId
			]);

			$categoryTotals = [];

			foreach ($expenses as $expense) {
				if (!$expense->category) {
					continue; // Skip if category is missing (data integrity check)
				}

				$categoryName = $expense->category->name;
				$amount = (float) $expense->amount;

				if (!isset($categoryTotals[$categoryName])) {
					$categoryTotals[$categoryName] = 0;
				}

				$categoryTotals[$categoryName] += $amount;
				$totalExpenses += $amount; // accumulate overall total
			}

			foreach ($categoryTotals as $categoryName => $total) {
				$labels[] = $categoryName;
				$data[] = $total;
			}
		}

		// Pass data to dashboard view (for Chart.js) plus total expenses
		$this->render('dashboard', [
			'labels' => json_encode($labels),
			'data' => json_encode($data),
			'totalExpenses' => $totalExpenses,
		]);
	}




	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}