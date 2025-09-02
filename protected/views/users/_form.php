<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>

<div class="bg-gray-900 p-6 rounded-lg shadow-md max-w-2xl mx-auto">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'users-form',
		'enableClientValidation' => true,
        'enableAjaxValidation' => false,
        'htmlOptions' => ['class' => 'space-y-6'],
    )); ?>

    <p class="text-sm text-gray-400 mb-4">
        Fields with <span class="text-red-500">*</span> are required.
    </p>

    <?php echo $form->errorSummary($model, null, null, ['class' => 'bg-red-100 text-red-800 p-3 rounded mb-4']); ?>

    <!-- Username -->
    <div>
        <?php echo $form->labelEx($model, 'username', ['class' => 'block text-gray-300 mb-1 font-semibold']); ?>
        <?php echo $form->textField($model, 'username', [
            'class' => 'w-full px-4 py-2 bg-gray-800 text-white border border-gray-700 rounded focus:outline-none focus:ring-2 focus:ring-blue-500',
            'maxlength' => 50,
            'placeholder' => 'Username',
        ]); ?>
        <?php echo $form->error($model, 'username', ['class' => 'text-red-500 text-sm mt-1']); ?>
    </div>

    <!-- Email -->
    <div>
        <?php echo $form->labelEx($model, 'email', ['class' => 'block text-gray-300 mb-1 font-semibold']); ?>
        <?php echo $form->textField($model, 'email', [
            'class' => 'w-full px-4 py-2 bg-gray-800 text-white border border-gray-700 rounded focus:outline-none focus:ring-2 focus:ring-blue-500',
            'maxlength' => 100,
            'placeholder' => 'Email address',
            'type' => 'email',
        ]); ?>
        <?php echo $form->error($model, 'email', ['class' => 'text-red-500 text-sm mt-1']); ?>
    </div>

    <!-- Full Name -->
    <div>
        <?php echo $form->labelEx($model, 'full_name', ['class' => 'block text-gray-300 mb-1 font-semibold']); ?>
        <?php echo $form->textField($model, 'full_name', [
            'class' => 'w-full px-4 py-2 bg-gray-800 text-white border border-gray-700 rounded focus:outline-none focus:ring-2 focus:ring-blue-500',
            'maxlength' => 100,
            'placeholder' => 'Full Name',
        ]); ?>
        <?php echo $form->error($model, 'full_name', ['class' => 'text-red-500 text-sm mt-1']); ?>
    </div>
    <?php if ($model->isNewRecord): ?>

		<!-- Password -->
		<div>
			<?php echo $form->labelEx($model, '[password]', ['class' => 'block text-gray-300 mb-1 font-semibold']); ?>
			<?php echo $form->passwordField($model, 'password', [
				'class' => 'w-full px-4 py-2 bg-gray-800 text-white border border-gray-700 rounded focus:outline-none focus:ring-2 focus:ring-blue-500',
				'maxlength' => 255,
				'placeholder' => 'Password',
				'autocomplete' => 'new-password',
			]); ?>
			<?php echo $form->error($model, 'password', ['class' => 'text-red-500 text-sm mt-1']); ?>
		</div>

		<!-- Repeat Password -->
		<div>
			<?php echo $form->labelEx($model, 'repeat_password', ['class' => 'block text-gray-300 mb-1 font-semibold']); ?>
			<?php echo $form->passwordField($model, 'repeat_password', [
				'class' => 'w-full px-4 py-2 bg-gray-800 text-white border border-gray-700 rounded focus:outline-none focus:ring-2 focus:ring-blue-500',
				'maxlength' => 255,
				'placeholder' => 'Repeat Password',
				'autocomplete' => 'new-password',
			]); ?>
			<?php echo $form->error($model, 'repeat_password', ['class' => 'text-red-500 text-sm mt-1']); ?>
		</div>
	<?php endif; ?>


    <!-- Submit Button -->
    <div class="flex justify-end">
        <?php echo CHtml::submitButton(
            $model->isNewRecord ? '➕ Create User' : '💾 Save Changes',
            ['class' => 'bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded shadow']
        ); ?>
    </div>

    <?php $this->endWidget(); ?>
</div>
