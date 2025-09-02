

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

<!-- GridView -->
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'expenses-grid',
    'dataProvider' => $model->search(),
	    'filter' => null,  // disable default filters to avoid confusion
    'cssFile' => false,
    'itemsCssClass' => 'min-w-full divide-y divide-gray-700 table-auto text-sm text-gray-300 bg-black rounded',
    'summaryCssClass' => 'px-4 py-2 text-gray-400',
    'pagerCssClass' => 'mt-4 flex justify-center space-x-2',
    'pager' => array(
        'cssFile' => false,
        'header' => false,
        'htmlOptions' => ['class' => 'inline-flex'],
        'selectedPageCssClass' => 'bg-gray-700 text-white rounded px-3 py-1',
        'hiddenPageCssClass' => 'hidden',
        'internalPageCssClass' => 'px-3 py-1 rounded hover:bg-gray-800 cursor-pointer',
    ),
    'columns' => array(
        array(
            'name' => 'id',
            'headerHtmlOptions' => ['class' => 'px-4 py-2 bg-gray-900 text-left'],
            'htmlOptions' => ['class' => 'px-4 py-2 whitespace-nowrap'],
        ),
        array(
    		'header' => 'Category',
    		'value' => function($data) {
        		return isset($data->category) ? CHtml::encode($data->category->name) : '<span class="text-red-400">Not set</span>';
    		},
    		'type' => 'raw', // allow HTML output
    		'headerHtmlOptions' => ['class' => 'px-4 py-2 bg-gray-900 text-left'],
    		'htmlOptions' => ['class' => 'px-4 py-2 whitespace-nowrap'],
		),

        array(
            'name' => 'amount',
            'header' => 'Amount',
            'headerHtmlOptions' => ['class' => 'px-4 py-2 bg-gray-900 text-left'],
            'htmlOptions' => ['class' => 'px-4 py-2 whitespace-nowrap break-all'],
        ),
        array(
            'name' => 'description',
            'headerHtmlOptions' => ['class' => 'px-4 py-2 bg-gray-900 text-left'],
            'htmlOptions' => ['class' => 'px-4 py-2'],
        ),
        array(
            'name' => 'date',
            'header' => 'Date',
            'headerHtmlOptions' => ['class' => 'px-4 py-2 bg-gray-900 text-left'],
            'htmlOptions' => ['class' => 'px-4 py-2 whitespace-nowrap'],
        ),
        array(
            'name' => 'status',
            'header' => 'Status',
            'headerHtmlOptions' => ['class' => 'px-4 py-2 bg-gray-900 text-left'],
            'htmlOptions' => ['class' => 'px-4 py-2 whitespace-nowrap'],
            'value' => function($data) {
                return $data->status ? 'Approved' : 'Pending';
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
