

<!-- Page Header -->
<h1 class="text-3xl font-bold text-white mb-4">Manage Expenses</h1>

<!-- Buttons -->
<div class="flex justify-between items-center mb-6">
    <?php echo CHtml::link('➕ Create Expense', ['expenses/create'], [
        'class' => 'inline-block bg-green-600 hover:bg-green-700 text-white font-semibold text-sm px-5 py-2 rounded shadow'
    ]); ?>
</div>

<!-- Search and Export Controls -->
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">

    <!-- Export CSV Button -->
    <?php echo CHtml::link('Export CSV', ['expenses/export'], [
        'class' => 'inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-5 py-2 rounded shadow whitespace-nowrap'
    ]); ?>	
</div>

<!-- ✅ Date Range Filter Form (AJAX enabled) -->
<div class="flex flex-col sm:flex-row items-center gap-4 mb-6 bg-gray-900 p-4 rounded-lg shadow">
    <?php echo CHtml::beginForm('', 'get', ['id' => 'date-filter-form', 'class' => 'flex flex-col sm:flex-row gap-4']); ?>

        <?php echo CHtml::textField('Expenses[date_from]', $model->date_from, [
            'placeholder' => 'From (YYYY-MM-DD)',
            'class' => 'bg-gray-800 border border-gray-600 text-white px-3 py-2 rounded text-sm w-44'
        ]); ?>

        <?php echo CHtml::textField('Expenses[date_to]', $model->date_to, [
            'placeholder' => 'To (YYYY-MM-DD)',
            'class' => 'bg-gray-800 border border-gray-600 text-white px-3 py-2 rounded text-sm w-44'
        ]); ?>

        <?php echo CHtml::submitButton('Filter', [
            'class' => 'bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-5 py-2 rounded shadow'
        ]); ?>

        <button type="button" id="reset-filter" 
            class="bg-gray-700 hover:bg-gray-800 text-white font-semibold px-5 py-2 rounded shadow">
            Reset
        </button>

    <?php echo CHtml::endForm(); ?>
</div>


<!-- GridView -->
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'expenses-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,  // enable filters but only show for category below
    'cssFile' => false,
    'itemsCssClass' => 'min-w-full divide-y divide-gray-700 table-auto text-sm text-gray-300 bg-black rounded',
    'summaryCssClass' => 'px-4 py-2 text-gray-400',
    'pagerCssClass' => 'mt-4',
    'pager' => array(
        'cssFile' => false,
        'header' => false,
        'htmlOptions' => ['class' => 'flex justify-center items-center space-x-2'],
        'selectedPageCssClass' => 'bg-blue-600 text-white font-semibold px-3 py-1 rounded shadow',
        'internalPageCssClass' => 'bg-gray-800 text-white px-3 py-1 rounded hover:bg-gray-700 transition-all duration-200 cursor-pointer',
        'firstPageLabel' => '« First',
        'lastPageLabel' => 'Last »',
        'nextPageLabel' => '›',
        'prevPageLabel' => '‹',
        'firstPageCssClass' => 'bg-gray-700 text-white px-3 py-1 rounded hover:bg-gray-600 transition-all duration-200 cursor-pointer',
        'lastPageCssClass' => 'bg-gray-700 text-white px-3 py-1 rounded hover:bg-gray-600 transition-all duration-200 cursor-pointer',
        'nextPageCssClass' => 'bg-gray-700 text-white px-3 py-1 rounded hover:bg-gray-600 transition-all duration-200 cursor-pointer',
        'previousPageCssClass' => 'bg-gray-700 text-white px-3 py-1 rounded hover:bg-gray-600 transition-all duration-200 cursor-pointer',
        'hiddenPageCssClass' => 'hidden',
    ),
    'columns' => array(
        array(
            'name' => 'id',
            'filter' => false, // Disable filter for ID column
            'headerHtmlOptions' => ['class' => 'px-4 py-2 bg-gray-900 text-left'],
            'htmlOptions' => ['class' => 'px-4 py-2 whitespace-nowrap'],
        ),
        array(
            'name' => 'category_id', // Assuming 'category_id' is foreign key in expenses table
            'header' => 'Category',
            'value' => function ($data) {
                return isset($data->category) ? CHtml::encode($data->category->name) : '<span class="text-red-400">Not set</span>';
            },
            'type' => 'raw',
            'filter' => CHtml::dropDownList(
                'Expenses[category_id]',
                $model->category_id,
                CHtml::listData(Category::model()->findAll(['order' => 'name ASC']), 'id', 'name'),
                [
                    'empty' => 'All Categories',
                    'class' => 'bg-gray-800 border border-gray-600 text-white px-3 py-1 rounded focus:outline-none focus:ring focus:ring-indigo-500 text-sm'
                ]
            ),
            'headerHtmlOptions' => ['class' => 'px-4 py-2 bg-gray-900 text-left'],
            'htmlOptions' => ['class' => 'px-4 py-2 whitespace-nowrap'],
        ),
        array(
            'name' => 'amount',
            'filter' => false, // Disable filter for amount
            'header' => 'Amount',
            'headerHtmlOptions' => ['class' => 'px-4 py-2 bg-gray-900 text-left'],
            'htmlOptions' => ['class' => 'px-4 py-2 whitespace-nowrap break-all'],
        ),
        array(
            'name' => 'description',
            'filter' => false, // Disable filter for description
            'headerHtmlOptions' => ['class' => 'px-4 py-2 bg-gray-900 text-left'],
            'htmlOptions' => ['class' => 'px-4 py-2'],
        ),
        array(
            'name' => 'date',
            'filter' => false, // Disable filter for date
            'header' => 'Date',
            'headerHtmlOptions' => ['class' => 'px-4 py-2 bg-gray-900 text-left'],
            'htmlOptions' => ['class' => 'px-4 py-2 whitespace-nowrap'],
        ),
		array(
			'name' => 'user_id',
			'header' => 'User',
			'value' => function ($data) {
				return isset($data->user) ? CHtml::encode($data->user->username) : '<span class="text-red-400">No User</span>';
			},
			'type' => 'raw', // allow HTML output (for fallback message)
			'filter' => false, // change to dropdown if you want filtering
			'headerHtmlOptions' => ['class' => 'px-4 py-2 bg-gray-900 text-left'],
			'htmlOptions' => ['class' => 'px-4 py-2 whitespace-nowrap'],
		),

        array(
            'name' => 'status',
            'filter' => false, // Disable filter for status
            'header' => 'Status',
            'headerHtmlOptions' => ['class' => 'px-4 py-2 bg-gray-900 text-left'],
            'htmlOptions' => ['class' => 'px-4 py-2 whitespace-nowrap'],
            'value' => function ($data) {
                return $data->status;
            },
        ),
        array(
            'class' => 'CButtonColumn',
            'headerHtmlOptions' => ['class' => 'px-4 py-2 bg-gray-900'],
            'htmlOptions' => ['class' => 'px-4 py-2 space-x-2'],
            'buttons' => array(
                'view' => array(
                    'label' => '👁️',
                    'options' => ['class' => 'inline-block bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded text-sm font-semibold'],
                ),
                'update' => array(
                    'label' => '✏️',
                    'options' => ['class' => 'inline-block bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded text-sm font-semibold'],
                ),
                'delete' => array(
                    'label' => '🗑️',
                    'options' => ['class' => 'inline-block bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded text-sm font-semibold'],
                ),
            ),
        ),
    ),
)); ?>


<?php
// ✅ JS for AJAX form binding
Yii::app()->clientScript->registerScript('date-filter-ajax', "
    $('#date-filter-form').on('submit', function(e) {
        e.preventDefault();
        $.fn.yiiGridView.update('expenses-grid', {
            data: $(this).serialize()
        });
    });

    $('#reset-filter').on('click', function() {
        $('#date-filter-form')[0].reset();
        $.fn.yiiGridView.update('expenses-grid', { data: {} });
    });
");
?>