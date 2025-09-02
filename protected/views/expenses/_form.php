<?php
/* @var $this ExpensesController */
/* @var $model Expenses */
/* @var $form CActiveForm */
?>

<!-- START: Form Wrapper -->
<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'expenses-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('class' => 'space-y-12 text-white'),
)); ?>

<div class="border-b border-white/10 pb-12">
    <h2 class="text-base font-semibold leading-7 text-white">Expense Details</h2>
    <p class="mt-1 text-sm leading-6 text-gray-400">Fill out the details for this expense record.</p>

    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

        <!-- Category Dropdown -->
        <div class="sm:col-span-3">
            <?php echo $form->labelEx($model, 'category_id', ['class' => 'block text-sm font-medium text-white']); ?>
            <div class="mt-2">
                <?php echo $form->dropDownList($model, 'category_id', $listCategories, [
                    'prompt' => 'Select Category',
                    'class' => 'block w-full bg-gray-800 border border-gray-600 text-white text-sm rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500'
                ]); ?>
            </div>
            <?php echo $form->error($model, 'category_id', ['class' => 'text-red-400 text-sm mt-1']); ?>
        </div>

        <!-- Amount Field -->
        <div class="sm:col-span-3">
            <?php echo $form->labelEx($model, 'amount', ['class' => 'block text-sm font-medium text-white']); ?>
            <div class="mt-2">
                <?php echo $form->textField($model, 'amount', [
                    'placeholder' => 'e.g. 150.00',
                    'class' => 'block w-full bg-gray-800 border border-gray-600 text-white text-sm rounded-md px-3 py-2 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500'
                ]); ?>
            </div>
            <?php echo $form->error($model, 'amount', ['class' => 'text-red-400 text-sm mt-1']); ?>
        </div>

        <!-- Description -->
        <div class="col-span-full">
            <?php echo $form->labelEx($model, 'description', ['class' => 'block text-sm font-medium text-white']); ?>
            <div class="mt-2">
                <?php echo $form->textArea($model, 'description', [
                    'rows' => 4,
                    'placeholder' => 'Write a description...',
                    'class' => 'block w-full bg-gray-800 border border-gray-600 text-white text-sm rounded-md px-3 py-2 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500'
                ]); ?>
            </div>
            <?php echo $form->error($model, 'description', ['class' => 'text-red-400 text-sm mt-1']); ?>
        </div>

        <!-- Date Picker -->
        <div class="sm:col-span-3">
            <?php echo $form->labelEx($model, 'date', ['class' => 'block text-sm font-medium text-white']); ?>
            <div class="mt-2 relative">
                <input
                    type="text"
                    id="expense-datepicker"
                    name="Expenses[date]"
                    value="<?php echo CHtml::encode($model->date); ?>"
                    placeholder="Select date"
                    class="datepicker-input block w-full bg-gray-800 border border-gray-600 text-white text-sm rounded-md px-3 py-2 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                />
            </div>
            <?php echo $form->error($model, 'date', ['class' => 'text-red-400 text-sm mt-1']); ?>
        </div>

    </div>
</div>
<?php if (Yii::app()->user->role == 'admin'): ?>

<div class="sm:col-span-3">
    <?php echo $form->labelEx($model, 'status', ['class' => 'block text-sm font-medium text-white']); ?>
    <div class="mt-2">
        <?php echo $form->dropDownList($model, 'status', Expenses::getStatusOptions(), [
            'prompt' => 'Select Status',
            'class' => 'block w-full bg-gray-800 border border-gray-600 text-white text-sm rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500'
        ]); ?>
    </div>
    <?php echo $form->error($model, 'status', ['class' => 'text-red-400 text-sm mt-1']); ?>
</div>


<div class="border-b border-white/10 pb-12">
	<div class="col-span-full">
		<?php echo $form->labelEx($model, 'admin_comment', ['class' => 'block text-sm font-medium text-white']); ?>
		<div class="mt-2">
                <?php echo $form->textArea($model, 'admin_comment', [
                    'rows' => 4,
                    'placeholder' => 'Write a Comment...',
                    'class' => 'block w-full bg-gray-800 border border-gray-600 text-white text-sm rounded-md px-3 py-2 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500'
                ]); ?>
            </div>
            <?php echo $form->error($model, 'admin_comment', ['class' => 'text-red-400 text-sm mt-1']); ?>
        </div>
    </div>
	<?php endif; ?>

<!-- Submit Buttons -->
<div class="mt-6 flex items-center justify-end gap-x-6">
    <a href="<?php echo $this->createUrl('index'); ?>" class="text-sm font-semibold text-white hover:underline">
        Cancel
    </a>
    <?php echo CHtml::submitButton(
        $model->isNewRecord ? 'Create' : 'Save',
        array(
            'class' => 'rounded-md bg-indigo-500 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500'
        )
    ); ?>
</div>
<?php $this->endWidget(); ?>
<!-- END: Form Wrapper -->

<!-- Flowbite JS (Datepicker) -->
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/datepicker.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        new Datepicker(document.getElementById('expense-datepicker'), {
            autohide: true,
            format: 'yyyy-mm-dd',
            todayHighlight: true
        });
    });
</script>
