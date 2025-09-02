

<!-- Page Header -->
<h1 class="text-3xl font-bold text-white mb-4">Manage Categories</h1>

<!-- Buttons -->
<div class="flex justify-between items-center mb-6">

    <?php echo CHtml::link('➕ Create Category', ['category/create'], [
        'class' => 'inline-block bg-green-600 hover:bg-green-700 text-white font-semibold text-sm px-5 py-2 rounded shadow'
    ]); ?>
</div>

<!-- Search and Import Controls -->
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">

    <!-- Search Box -->
    <form method="get" action="<?php echo $this->createUrl('index'); ?>" class="w-full sm:w-1/3">
        <input 
            type="text" 
            name="search" 
            placeholder="Search categories..." 
            value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>"
            class="w-full px-4 py-2 rounded border border-gray-600 bg-gray-800 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500"
        />
    </form>

    <!-- Import CSV Button -->
    <?php echo CHtml::link('Export CSV', ['category/export'], [
        'class' => 'inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-5 py-2 rounded shadow whitespace-nowrap'
    ]); ?>

</div>

<!-- GridView -->
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'category-grid',
    'dataProvider' => $model->search(),
    'cssFile' => false,
    'itemsCssClass' => 'min-w-full divide-y divide-gray-700 table-auto text-sm text-gray-300 bg-black',
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
            'htmlOptions' => ['class' => 'px-4 py-2'],
        ),
        array(
            'name' => 'name',
            'headerHtmlOptions' => ['class' => 'px-4 py-2 bg-gray-900 text-left'],
            'htmlOptions' => ['class' => 'px-4 py-2'],
        ),
        array(
            'name' => 'slug',
            'headerHtmlOptions' => ['class' => 'px-4 py-2 bg-gray-900 text-left'],
            'htmlOptions' => ['class' => 'px-4 py-2 break-all'],
        ),
        array(
            'name' => 'description',
            'headerHtmlOptions' => ['class' => 'px-4 py-2 bg-gray-900 text-left'],
            'htmlOptions' => ['class' => 'px-4 py-2'],
        ),
        array(
            'name' => 'parent_id',
            'headerHtmlOptions' => ['class' => 'px-4 py-2 bg-gray-900 text-left'],
            'htmlOptions' => ['class' => 'px-4 py-2'],
        ),
        array(
            'name' => 'status',
            'headerHtmlOptions' => ['class' => 'px-4 py-2 bg-gray-900 text-left'],
            'htmlOptions' => ['class' => 'px-4 py-2'],
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
