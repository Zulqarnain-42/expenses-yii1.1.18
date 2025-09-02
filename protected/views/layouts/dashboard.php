<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" />
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>

</head>
<body class="bg-gray-900 text-white">

<div class="min-h-full">
  <!-- Navigation -->
  <nav class="bg-gray-800">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="flex h-16 items-center justify-between">
        <div class="flex items-center">
          <div class="shrink-0">
            <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company" class="size-8" />
          </div>
          <div class="hidden md:block">
            <?php if (Yii::app()->user->role == 'admin'): ?>

            <?php
                $this->widget('zii.widgets.CMenu', array(
                    'htmlOptions' => array(
                        'class' => 'ml-10 flex items-baseline space-x-4', // Tailwind flex layout
                    ),
                    'itemCssClass' => 'inline-block', // optional
                    'activeCssClass' => 'bg-gray-950/50 text-white', // Active link style
                    'linkLabelWrapper' => null,
                    'encodeLabel' => false,
                    'items' => array(
                        array(
                            'label' => 'Dashboard',
                            'url' => array('/site/dashboard'),
                            'linkOptions' => array(
                                'class' => 'rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white',
                            ),
                        ),
                        array(
                            'label' => 'Users',
                            'url' => array('/users/admin'),
                            'linkOptions' => array(
                                'class' => 'rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white',
                            ),
                        ),
                        array(
                            'label' => 'Categories',
                            'url' => array('/category/admin'),
                            'linkOptions' => array(
                                'class' => 'rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white',
                            ),
                        ),
                        array(
                            'label' => 'Expenses',
                            'url' => array('/expenses/admin'),
                            'linkOptions' => array(
                                'class' => 'rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white',
                            ),
                        ),
                        array(
                            'label' => 'Logout (' . CHtml::encode(Yii::app()->user->name) . ')',
                            'url' => array('/site/logout'),
                            'visible' => !Yii::app()->user->isGuest,
                            'linkOptions' => array(
                                'class' => 'rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white',
                            ),
                        ),
                    ),
                ));
            ?>
<?php elseif (Yii::app()->user->role == 'user'): ?>

            <?php
                $this->widget('zii.widgets.CMenu', array(
                    'htmlOptions' => array(
                        'class' => 'ml-10 flex items-baseline space-x-4', // Tailwind flex layout
                    ),
                    'itemCssClass' => 'inline-block', // optional
                    'activeCssClass' => 'bg-gray-950/50 text-white', // Active link style
                    'linkLabelWrapper' => null,
                    'encodeLabel' => false,
                    'items' => array(
                        array(
                            'label' => 'Dashboard',
                            'url' => array('/site/dashboard'),
                            'linkOptions' => array(
                                'class' => 'rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white',
                            ),
                        ),
                        array(
                            'label' => 'Expenses',
                            'url' => array('/expenses/admin'),
                            'linkOptions' => array(
                                'class' => 'rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white',
                            ),
                        ),
                        array(
                            'label' => 'Logout (' . CHtml::encode(Yii::app()->user->name) . ')',
                            'url' => array('/site/logout'),
                            'visible' => !Yii::app()->user->isGuest,
                            'linkOptions' => array(
                                'class' => 'rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white',
                            ),
                        ),
                    ),
                ));
            ?>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <!-- Page Header -->
  <header class="bg-gray-800 relative after:pointer-events-none after:absolute after:inset-x-0 after:inset-y-0 after:border-y after:border-white/10">
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
      <h1 class="text-3xl font-bold tracking-tight text-white"><?php echo CHtml::encode($this->pageTitle); ?></h1>
    </div>
  </header>

  <!-- Main Content -->
  <main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
      <?php echo $content; ?>
    </div>
  </main>
</div>

</body>
</html>
