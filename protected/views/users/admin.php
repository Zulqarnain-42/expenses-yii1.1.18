

<h1 class="text-3xl font-bold text-white mb-4">Manage Users</h1>

<!-- Action Buttons -->
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
    <!-- Create Button -->
    <?php echo CHtml::link('➕ Add New User', ['users/create'], [
        'class' => 'inline-block bg-green-600 hover:bg-green-700 text-white font-semibold text-base px-6 py-3 rounded shadow'
    ]); ?>
</div>

<!-- GridView -->
<?php $this->widget('zii.widgets.grid.CGridView', [
    'id' => 'users-grid',
    'dataProvider' => $model->search(),
    'cssFile' => false,
    'itemsCssClass' => 'min-w-full divide-y divide-gray-700 table-auto text-sm text-gray-300 bg-black',
    'pagerCssClass' => 'mt-4 flex justify-center space-x-2',
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
    'columns' => [
        [
            'name' => 'id',
            'headerHtmlOptions' => ['class' => 'px-4 py-2 bg-gray-900 text-left'],
            'htmlOptions' => ['class' => 'px-4 py-2'],
        ],
        [
            'name' => 'username',
            'headerHtmlOptions' => ['class' => 'px-4 py-2 bg-gray-900 text-left'],
            'htmlOptions' => ['class' => 'px-4 py-2'],
        ],
        [
            'name' => 'email',
            'headerHtmlOptions' => ['class' => 'px-4 py-2 bg-gray-900 text-left'],
            'htmlOptions' => ['class' => 'px-4 py-2'],
        ],
        [
            'name' => 'full_name',
            'headerHtmlOptions' => ['class' => 'px-4 py-2 bg-gray-900 text-left'],
            'htmlOptions' => ['class' => 'px-4 py-2'],
        ],
        [
            'name' => 'created_at',
            'headerHtmlOptions' => ['class' => 'px-4 py-2 bg-gray-900 text-left'],
            'htmlOptions' => ['class' => 'px-4 py-2'],
        ],
        [
            'class' => 'CButtonColumn',
            'headerHtmlOptions' => ['class' => 'px-4 py-2 bg-gray-900 text-left'],
            'htmlOptions' => ['class' => 'px-4 py-2 space-x-2'],
            'buttons' => [
                'view' => [
                    'label' => '👁️ View',
                    'options' => [
                        'class' => 'inline-block bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded text-sm font-semibold'
                    ],
                ],
                'update' => [
                    'label' => '✏️ Edit',
                    'options' => [
                        'class' => 'inline-block bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded text-sm font-semibold'
                    ],
                ],
                'delete' => array(
                    'label' => '🗑️',
                    'url' => 'Yii::app()->createUrl("users/delete", array("id"=>$data->id))',
                    'options' => array(
                        'class' => 'inline-block bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded text-sm font-semibold',
                        'onclick' => 'if(confirm("Are you sure you want to delete this item?")) {
                            var form = document.createElement("form");
                            form.method = "POST";
                            form.action = this.href;
                            document.body.appendChild(form);
                            form.submit();
                        }
                        return false;',
                    ),
                ),

            ],
        ],
    ],
]); ?>
