<h1 class="text-3xl font-bold text-white mb-6">
    View Expense #<?php echo $model->id; ?>
</h1>

<div class="bg-gray-900 text-gray-300 shadow rounded-lg overflow-hidden max-w-3xl mx-auto">
    <?php $this->widget('zii.widgets.CDetailView', array(
        'data' => $model,
        'cssFile' => false,
        'htmlOptions' => ['class' => 'table w-full text-sm'],
        'itemCssClass' => 'border-b border-gray-700',
        'attributes' => array(
            array(
                'name' => 'id',
                'label' => 'ID',
                'value' => $model->id,
                'template' => '<tr class="{class}">
                    <th class="text-left px-6 py-3 font-medium text-gray-400 bg-gray-800 w-1/3">{label}</th>
                    <td class="px-6 py-3">{value}</td>
                </tr>',
            ),
            array(
                'label' => 'Category',
                'type' => 'raw',
                'value' => $model->category ? CHtml::encode($model->category->name) : '<span class="text-red-400">Not set</span>',
                'template' => '<tr class="{class}">
                    <th class="text-left px-6 py-3 font-medium text-gray-400 bg-gray-800">{label}</th>
                    <td class="px-6 py-3">{value}</td>
                </tr>',
            ),
            array(
                'name' => 'amount',
                'template' => '<tr class="{class}">
                    <th class="text-left px-6 py-3 font-medium text-gray-400 bg-gray-800">{label}</th>
                    <td class="px-6 py-3">{value}</td>
                </tr>',
            ),
            array(
                'name' => 'description',
                'template' => '<tr class="{class}">
                    <th class="text-left px-6 py-3 font-medium text-gray-400 bg-gray-800">{label}</th>
                    <td class="px-6 py-3">{value}</td>
                </tr>',
            ),
            array(
                'name' => 'date',
                'template' => '<tr class="{class}">
                    <th class="text-left px-6 py-3 font-medium text-gray-400 bg-gray-800">{label}</th>
                    <td class="px-6 py-3">{value}</td>
                </tr>',
            ),
            array(
                'name' => 'status',
                'value' => $model->status,
                'template' => '<tr class="{class}">
                    <th class="text-left px-6 py-3 font-medium text-gray-400 bg-gray-800">{label}</th>
                    <td class="px-6 py-3">{value}</td>
                </tr>',
            ),
            array(
                'name' => 'admin_comment',
                'template' => '<tr class="{class}">
                    <th class="text-left px-6 py-3 font-medium text-gray-400 bg-gray-800">{label}</th>
                    <td class="px-6 py-3">{value}</td>
                </tr>',
            ),
            array(
                'name' => 'created_at',
                'template' => '<tr class="{class}">
                    <th class="text-left px-6 py-3 font-medium text-gray-400 bg-gray-800">{label}</th>
                    <td class="px-6 py-3">{value}</td>
                </tr>',
            ),
            array(
                'name' => 'updated_at',
                'template' => '<tr class="{class}">
                    <th class="text-left px-6 py-3 font-medium text-gray-400 bg-gray-800">{label}</th>
                    <td class="px-6 py-3">{value}</td>
                </tr>',
            ),
        ),
    )); ?>
</div>
