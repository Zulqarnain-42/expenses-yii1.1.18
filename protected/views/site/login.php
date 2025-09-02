<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-900">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?php echo CHtml::encode($this->pageTitle); ?></title>
  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-full">
  <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
      <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company" class="mx-auto h-10 w-auto" />
      <h2 class="mt-10 text-center text-2xl font-bold tracking-tight text-gray-100">Sign in to your account</h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
      <?php $form = $this->beginWidget('CActiveForm', [
        'id' => 'login-form',
        'enableClientValidation' => true,
        'clientOptions' => ['validateOnSubmit' => true],
        'htmlOptions' => ['class' => 'space-y-6'],
      ]); ?>

        <div>
          <?php echo $form->labelEx($model, 'username', ['class' => 'block text-sm font-medium text-gray-100']); ?>
          <div class="mt-2">
            <?php echo $form->textField($model, 'username', [
              'autocomplete' => 'username',
              'class' => 'block w-full rounded-md bg-gray-800 px-3 py-1.5 text-base text-gray-100 placeholder:text-gray-400 outline-1 -outline-offset-1 outline-gray-600 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm',
            ]); ?>
            <?php echo $form->error($model, 'username', ['class' => 'text-red-500 text-sm mt-1']); ?>
          </div>
        </div>

        <div>
          <div class="flex items-center justify-between">
            <?php echo $form->labelEx($model, 'password', ['class' => 'block text-sm font-medium text-gray-100']); ?>
          </div>
          <div class="mt-2">
            <?php echo $form->passwordField($model, 'password', [
              'autocomplete' => 'current-password',
              'class' => 'block w-full rounded-md bg-gray-800 px-3 py-1.5 text-base text-gray-100 placeholder:text-gray-400 outline-1 -outline-offset-1 outline-gray-600 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm',
            ]); ?>
            <?php echo $form->error($model, 'password', ['class' => 'text-red-500 text-sm mt-1']); ?>
          </div>
        </div>

        <div class="flex items-center">
          <?php echo $form->checkBox($model, 'rememberMe', ['class' => 'h-4 w-4 rounded border-gray-600 text-indigo-600 focus:ring-indigo-500']); ?>
          <?php echo $form->label($model, 'rememberMe', ['class' => 'ml-2 block text-sm text-gray-100']); ?>
          <?php echo $form->error($model, 'rememberMe', ['class' => 'text-red-500 text-sm ml-4']); ?>
        </div>

        <div>
          <?php echo CHtml::submitButton('Sign in', [
            'class' => 'flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600',
          ]); ?>
        </div>

      <?php $this->endWidget(); ?>
    </div>
  </div>
</body>
</html>