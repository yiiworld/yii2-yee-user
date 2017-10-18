<?php

use yeesoft\grid\GridView;
use yeesoft\helpers\Html;
use yeesoft\models\User;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var yeesoft\user\models\AuthRuleSearch $searchModel
 */
$this->title = Yii::t('yee/user', 'Rules');
$this->params['breadcrumbs'][] = ['label' => Yii::t('yee/user', 'Users'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = $this->title;

$this->params['description'] = 'YeeCMS 0.2.0';
$this->params['header-content'] = Html::a(Yii::t('yee', 'Add New'), ['create'], ['class' => 'btn btn-sm btn-primary']);
?>

<div class="box box-primary">
    <div class="box-body">
        <?php $pjax = Pjax::begin() ?>
        <?=
        GridView::widget([
            'pjaxId' => $pjax->id,
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'quickFilters' => false,
            'columns' => [
                ['class' => 'yeesoft\grid\CheckboxColumn', 'options' => ['style' => 'width:10px'], 'displayFilter' => false],
                [
                    'attribute' => 'name',
                    'class' => 'yeesoft\grid\columns\TitleActionColumn',
                    'title' => function ($model) {
                        if (User::hasPermission('manageRolesAndPermissions')) {
                            return Html::a("{$model->name} [{$model->className}]", ['update', 'id' => $model->name], ['data-pjax' => 0]);
                        } else {
                            return "{$model->name} [{$model->className}]";
                        }
                    },
                    'buttonsTemplate' => '{update} {delete}',
                    'filterOptions' => ['colspan' => 2],
                ],
            ],
        ])
        ?>

        <?php Pjax::end() ?>
    </div>
</div>