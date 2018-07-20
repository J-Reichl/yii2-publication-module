<?php
/**
 * /app/src/../runtime/giiant/d4b4964a63cc95065fa0ae19074007ee
 *
 * @package default
 */


use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use dmstr\bootstrap\Tabs;

/**
 *
 * @var yii\web\View $this
 * @var dmstr\modules\publication\models\crud\PublicationItem $model
 */
$copyParams = $model->attributes;

$this->title = Yii::t('models', 'Publication Item');
$this->params['breadcrumbs'][] = ['label' => Yii::t('models', 'Publication Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('cruds', 'View');
?>
<div class="giiant-crud publication-item-view">

    <!-- flash message -->
    <?php if (\Yii::$app->session->getFlash('deleteError') !== null) : ?>
        <span class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <?php echo \Yii::$app->session->getFlash('deleteError') ?>
        </span>
    <?php endif; ?>

    <h1>
        <?php echo Yii::t('models', 'Publication Item') ?>
        <small>
            <?php echo Html::encode($model->id) ?>
        </small>
    </h1>


    <div class="clearfix crud-navigation">

        <!-- menu buttons -->
        <div class='pull-left'>
            <?php echo Html::a(
	'<span class="glyphicon glyphicon-pencil"></span> ' . Yii::t('cruds', 'Edit'),
	[ 'update', 'id' => $model->id],
	['class' => 'btn btn-info']) ?>

            <?php echo Html::a(
	'<span class="glyphicon glyphicon-copy"></span> ' . Yii::t('cruds', 'Copy'),
	['create', 'id' => $model->id, 'PublicationItem'=>$copyParams],
	['class' => 'btn btn-success']) ?>

            <?php echo Html::a(
	'<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('cruds', 'New'),
	['create'],
	['class' => 'btn btn-success']) ?>
        </div>

        <div class="pull-right">
            <?php echo Html::a('<span class="glyphicon glyphicon-list"></span> '
	. Yii::t('cruds', 'Full list'), ['index'], ['class'=>'btn btn-default']) ?>
        </div>

    </div>

    <hr/>

    <?php $this->beginBlock('dmstr\modules\publication\models\crud\PublicationItem'); ?>


    <?php echo DetailView::widget([
		'model' => $model,
		'attributes' => [
			// generated by schmunk42\giiant\generators\crud\providers\core\RelationProvider::attributeFormat
			[
				'format' => 'html',
				'attribute' => 'category_id',
				'value' => ($model->category ?
					Html::a('<i class="glyphicon glyphicon-list"></i>', ['/publication/crud/publication-category/index']).' '.
					Html::a('<i class="glyphicon glyphicon-circle-arrow-right"></i> '.$model->category->label, ['/publication/crud/publication-category/view', 'id' => $model->category->id, ]).' '.
					Html::a('<i class="glyphicon glyphicon-paperclip"></i>', ['create', 'PublicationItem'=>['category_id' => $model->category_id]])
					:
					'<span class="label label-warning">?</span>'),
			],
			[
				'class' => yii\grid\DataColumn::className(),
				'attribute' => 'status',
				'value' => function ($model) {
					return '<div class="label label-' . ($model->status === 'published' ? 'success' : 'warning') . '">' . ucfirst($model->status) . '</div>';
				},
				'format' => 'raw',
			],
			[
				'class' => yii\grid\DataColumn::className(),
				'attribute' => 'title',
				'value' => function ($model) {
					return $model->title;
				},
				'format' => 'raw',
			],
			[
				'class' => yii\grid\DataColumn::className(),
				'attribute' => 'release_date',
				'value' => function ($model) {
					return \Yii::$app->formatter->asDateTime($model->release_date);
				},
				'format' => 'raw',
			],
			[
				'class' => yii\grid\DataColumn::className(),
				'attribute' => 'end_date',
				'value' => function ($model) {
					return \Yii::$app->formatter->asDateTime($model->end_date);
				},
				'format' => 'raw',
			],
		],
	]); ?>


    <hr/>

    <?php echo Html::a('<span class="glyphicon glyphicon-trash"></span> ' . Yii::t('cruds', 'Delete'), ['delete', 'id' => $model->id],
	[
		'class' => 'btn btn-danger',
		'data-confirm' => '' . Yii::t('cruds', 'Are you sure to delete this item?') . '',
		'data-method' => 'post',
	]); ?>
    <?php $this->endBlock(); ?>



<?php $this->beginBlock('PublicationItemMetas'); ?>
<div style='position: relative'>
<div style='position:absolute; right: 0px; top: 0px;'>
  <?php echo Html::a(
	'<span class="glyphicon glyphicon-list"></span> ' . Yii::t('cruds', 'List All') . ' Publication Item Metas',
	['/publication/crud/publication-item-meta/index'],
	['class'=>'btn text-muted btn-xs']
) ?>
  <?php echo Html::a(
	'<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('cruds', 'New') . ' Publication Item Meta',
	['/publication/crud/publication-item-meta/create', 'PublicationItemMeta' => ['item_id' => $model->id]],
	['class'=>'btn btn-success btn-xs']
); ?>
</div>
</div>
<?php Pjax::begin(['id'=>'pjax-PublicationItemMetas', 'enableReplaceState'=> false, 'linkSelector'=>'#pjax-PublicationItemMetas ul.pagination a, th a']) ?>
<?php echo
'<div class="table-responsive">'
	. \yii\grid\GridView::widget([
		'layout' => '{summary}{pager}<br/>{items}{pager}',
		'dataProvider' => new \yii\data\ActiveDataProvider([
				'query' => $model->getPublicationItemMetas(),
				'pagination' => [
					'pageSize' => 20,
					'pageParam'=>'page-publicationitemmetas',
				]
			]),
		'pager'        => [
			'class'          => yii\widgets\LinkPager::className(),
			'firstPageLabel' => Yii::t('cruds', 'First'),
			'lastPageLabel'  => Yii::t('cruds', 'Last')
		],
		'columns' => [
			[
				'class'      => 'yii\grid\ActionColumn',
				'template'   => '{view} {update}',
				'contentOptions' => ['nowrap'=>'nowrap'],
				'urlCreator' => function ($action, $model, $key, $index) {
					// using the column name as key, not mapping to 'id' like the standard generator
					$params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
					$params[0] = '/publication/crud/publication-item-meta' . '/' . $action;
					$params['PublicationItemMeta'] = ['item_id' => $model->primaryKey()[0]];
					return $params;
				},
				'buttons'    => [

				],
				'controller' => '/publication/crud/publication-item-meta'
			],
			'id',
			'language',
			[
				'class' => yii\grid\DataColumn::className(),
				'attribute' => 'status',
				'value' => function ($model) {
					return '<div class="label label-' . ($model->status === 'published' ? 'success' : 'warning') . '">' . ucfirst($model->status) . '</div>';
				},
				'format' => 'raw',
			],
			[
				'class' => yii\grid\DataColumn::className(),
				'attribute' => 'release_date',
				'value' => function ($model) {
					return \Yii::$app->formatter->asDateTime($model->release_date);
				},
				'format' => 'raw',
			],
			[
				'class' => yii\grid\DataColumn::className(),
				'attribute' => 'end_date',
				'value' => function ($model) {
					return \Yii::$app->formatter->asDateTime($model->end_date);
				},
				'format' => 'raw',
			],
		]
	])
	. '</div>'
?>
<?php Pjax::end() ?>
<?php $this->endBlock() ?>


<?php $this->beginBlock('PublicationItemTranslations'); ?>
<div style='position: relative'>
<div style='position:absolute; right: 0px; top: 0px;'>
  <?php echo Html::a(
	'<span class="glyphicon glyphicon-list"></span> ' . Yii::t('cruds', 'List All') . ' Publication Item Translations',
	['/publication/crud/publication-item-translation/index'],
	['class'=>'btn text-muted btn-xs']
) ?>
  <?php echo Html::a(
	'<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('cruds', 'New') . ' Publication Item Translation',
	['/publication/crud/publication-item-translation/create', 'PublicationItemTranslation' => ['item_id' => $model->id]],
	['class'=>'btn btn-success btn-xs']
); ?>
</div>
</div>
<?php Pjax::begin(['id'=>'pjax-PublicationItemTranslations', 'enableReplaceState'=> false, 'linkSelector'=>'#pjax-PublicationItemTranslations ul.pagination a, th a']) ?>
<?php echo
'<div class="table-responsive">'
	. \yii\grid\GridView::widget([
		'layout' => '{summary}{pager}<br/>{items}{pager}',
		'dataProvider' => new \yii\data\ActiveDataProvider([
				'query' => $model->getPublicationItemTranslations(),
				'pagination' => [
					'pageSize' => 20,
					'pageParam'=>'page-publicationitemtranslations',
				]
			]),
		'pager'        => [
			'class'          => yii\widgets\LinkPager::className(),
			'firstPageLabel' => Yii::t('cruds', 'First'),
			'lastPageLabel'  => Yii::t('cruds', 'Last')
		],
		'columns' => [
			[
				'class'      => 'yii\grid\ActionColumn',
				'template'   => '{view} {update}',
				'contentOptions' => ['nowrap'=>'nowrap'],
				'urlCreator' => function ($action, $model, $key, $index) {
					// using the column name as key, not mapping to 'id' like the standard generator
					$params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
					$params[0] = '/publication/crud/publication-item-translation' . '/' . $action;
					$params['PublicationItemTranslation'] = ['item_id' => $model->primaryKey()[0]];
					return $params;
				},
				'buttons'    => [

				],
				'controller' => '/publication/crud/publication-item-translation'
			],
			'id',
			'language',
			[
				'class' => yii\grid\DataColumn::className(),
				'attribute' => 'title',
				'value' => function ($model) {
					return $model->title;
				},
				'format' => 'raw',
			],
			'content_widget_json:ntext',
			'teaser_widget_json:ntext',
		]
	])
	. '</div>'
?>
<?php Pjax::end() ?>
<?php $this->endBlock() ?>


    <?php echo Tabs::widget(
	[
		'id' => 'relation-tabs',
		'encodeLabels' => false,
		'items' => [
			[
				'label'   => '<b class=""># '.Html::encode($model->id).'</b>',
				'content' => $this->blocks['dmstr\modules\publication\models\crud\PublicationItem'],
				'active'  => true,
			],
			[
				'content' => $this->blocks['PublicationItemMetas'],
				'label'   => '<small>Publication Item Metas <span class="badge badge-default">'. $model->getPublicationItemMetas()->count() . '</span></small>',
				'active'  => false,
			],
			[
				'content' => $this->blocks['PublicationItemTranslations'],
				'label'   => '<small>Publication Item Translations <span class="badge badge-default">'. $model->getPublicationItemTranslations()->count() . '</span></small>',
				'active'  => false,
			],
		]
	]
);
?>
</div>
