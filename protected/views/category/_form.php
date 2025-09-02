<?php
/* @var $this CategoryController */
/* @var $model Category */
/* @var $form CActiveForm */
?>

<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'category-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('class' => 'space-y-12 text-white'),
)); ?>

<!-- Form Header -->
<div class="border-b border-white/10 pb-12">
    <h2 class="text-base font-semibold leading-7 text-white">Category Info</h2>
    <p class="mt-1 text-sm leading-6 text-gray-400">
        This information will be used to manage categories in your system.
    </p>

    <!-- Form Grid -->
    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

        <!-- Category Name -->
        <div class="sm:col-span-4">
            <?php echo $form->labelEx($model, 'name', ['class' => 'block text-sm font-medium text-white']); ?>
            <div class="mt-2">
                <div class="flex items-center rounded-md bg-white/5 pl-3 outline outline-1 -outline-offset-1 outline-white/10 focus-within:outline-2 focus-within:outline-indigo-500">
                    <span class="shrink-0 text-sm text-gray-400">category/</span>
                    <?php echo $form->textField($model, 'name', array(
                        'placeholder' => 'news',
                        'class' => 'block min-w-0 grow bg-transparent py-1.5 pr-3 pl-1 text-sm text-white placeholder:text-gray-500 focus:outline-none'
                    )); ?>
                </div>
            </div>
            <?php echo $form->error($model, 'name', ['class' => 'text-red-400 text-sm mt-1']); ?>
        </div>

        <!-- Slug Field -->
        <div class="sm:col-span-4">
            <?php echo $form->labelEx($model, 'slug', ['class' => 'block text-sm font-medium text-white']); ?>
            <div class="mt-2">
                <?php echo $form->textField($model, 'slug', array(
                    'placeholder' => 'news-updates',
                    'class' => 'block w-full rounded-md bg-white/5 px-3 py-1.5 text-sm text-white placeholder:text-gray-500 outline outline-1 -outline-offset-1 outline-white/10 focus:outline-2 focus:outline-indigo-500'
                )); ?>
            </div>
            <?php echo $form->error($model, 'slug', ['class' => 'text-red-400 text-sm mt-1']); ?>
        </div>

        <!-- Description -->
        <div class="col-span-full">
            <?php echo $form->labelEx($model, 'description', ['class' => 'block text-sm font-medium text-white']); ?>
            <div class="mt-2">
                <?php echo $form->textArea($model, 'description', array(
                    'rows' => 3,
                    'placeholder' => 'Optional category description...',
                    'class' => 'block w-full rounded-md bg-white/5 px-3 py-1.5 text-sm text-white placeholder:text-gray-500 outline outline-1 -outline-offset-1 outline-white/10 focus:outline-2 focus:outline-indigo-500'
                )); ?>
            </div>
            <?php echo $form->error($model, 'description', ['class' => 'text-red-400 text-sm mt-1']); ?>
        </div>

    </div>
</div>

<!-- Form Footer Buttons -->
<div class="mt-6 flex items-center justify-end gap-x-6">
    <a href="<?php echo $this->createUrl('index'); ?>" class="text-sm font-semibold text-white hover:underline">
        Cancel
    </a>
    <?php echo CHtml::submitButton(
        $model->isNewRecord ? 'Create' : 'Save',
        [
            'class' => 'rounded-md bg-indigo-500 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500'
        ]
    ); ?>
</div>

<?php $this->endWidget(); ?>
