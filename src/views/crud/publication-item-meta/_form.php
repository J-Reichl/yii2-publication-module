<?php
/**
 * /app/src/../runtime/giiant/4b7e79a8340461fe629a6ac612644d03
 *
 * @package default
 */


use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \dmstr\bootstrap\Tabs;
use yii\helpers\StringHelper;

/**
 *
 * @var yii\web\View $this
 * @var dmstr\modules\publication\models\crud\PublicationItemMeta $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="publication-item-meta-form">

    <?php $form = ActiveForm::begin([
		'id' => 'PublicationItemMeta',
		'layout' => 'horizontal',
		'enableClientValidation' => true,
		'errorSummaryCssClass' => 'error-summary alert alert-danger',
		'fieldConfig' => [
			'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
			'horizontalCssClasses' => [
				'label' => 'col-sm-2',
				//'offset' => 'col-sm-offset-4',
				'wrapper' => 'col-sm-8',
				'error' => '',
				'hint' => '',
			],
		],
	]
);
?>

    <div class="">
        <?php $this->beginBlock('main'); ?>

        <p>


<!-- attribute item_id -->
			<?php echo // generated by schmunk42\giiant\generators\crud\providers\core\RelationProvider::activeField
$form->field($model, 'item_id')->widget(\kartik\select2\Select2::classname(), [
		'name' => 'class_name',
		'model' => $model,
		'attribute' => 'item_id',
		'data' => \yii\helpers\ArrayHelper::map(dmstr\modules\publication\models\crud\PublicationItem::find()->all(), 'id', 'id'),
		'options' => [
			'placeholder' => Yii::t('cruds', 'Type to autocomplete'),
			'multiple' => false,
			'disabled' => (isset($relAttributes) && isset($relAttributes['item_id'])),
		]
	]); ?>

<!-- attribute language -->
			<?php echo $form->field($model, 'language')->textInput(['maxlength' => true]) ?>

<!-- attribute release_date -->
			<?php echo $form->field($model, 'release_date')->widget(zhuravljov\yii\widgets\DateTimePicker::class, ['clientOptions' => ['autoclose' => true]]) ?>

<!-- attribute status -->
			<?php
$model->status = dmstr\modules\publication\models\crud\PublicationItemMeta::STATUS_PUBLISHED;
?>
			<?php echo $form->field($model, 'status')->widget(\kartik\select2\Select2::class, [
		'data' => [$model::STATUS_PUBLISHED => \Yii::t('crud', 'Published'), $model::STATUS_DRAFT => \Yii::t('crud', 'Draft')] ]); ?>

<!-- attribute end_date -->
			<?php echo $form->field($model, 'end_date')->widget(zhuravljov\yii\widgets\DateTimePicker::class, ['clientOptions' => ['autoclose' => true]]) ?>
        </p>
        <?php $this->endBlock(); ?>

        <?php echo
Tabs::widget(
	[
		'encodeLabels' => false,
		'items' => [
			[
				'label'   => Yii::t('models', 'PublicationItemMeta'),
				'content' => $this->blocks['main'],
				'active'  => true,
			],
		]
	]
);
?>
        <hr/>

        <?php echo $form->errorSummary($model); ?>

        <?php echo Html::submitButton(
	'<span class="glyphicon glyphicon-check"></span> ' .
	($model->isNewRecord ? Yii::t('cruds', 'Create') : Yii::t('cruds', 'Save')),
	[
		'id' => 'save-' . $model->formName(),
		'class' => 'btn btn-success'
	]
);
?>

        <?php ActiveForm::end(); ?>

    </div>

</div>
