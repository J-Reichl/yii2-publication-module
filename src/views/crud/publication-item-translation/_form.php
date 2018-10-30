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
 * @var dmstr\modules\publication\models\crud\PublicationItemTranslation $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="publication-item-translation-form">

    <?php $form = ActiveForm::begin([
		'id' => 'PublicationItemTranslation',
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
			'placeholder' => Yii::t('publication', 'Type to autocomplete'),
			'multiple' => false,
			'disabled' => (isset($relAttributes) && isset($relAttributes['item_id'])),
		]
	]); ?>

<!-- attribute language -->
			<?php echo $form->field($model, 'language')->textInput(['maxlength' => true]) ?>

<!-- attribute content_widget_json -->
			<?php echo $form->field($model, 'content_widget_json')->widget(\beowulfenator\JsonEditor\JsonEditorWidget::class, [
		'id' => 'content_widget_jsonEditor',
		'schema' =>$model->content_widget_schema,
		'enableSelectize' => true,
		'clientOptions' => [
			'theme' => 'bootstrap3',
			'disable_collapse' => true,
			'disable_properties' => true,
            'keep_oneof_values' => false,
			'ajax' => true
		],
	]) ?>

<!-- attribute teaser_widget_json -->
			<?php echo $form->field($model, 'teaser_widget_json')->widget(\beowulfenator\JsonEditor\JsonEditorWidget::class, [
		'id' => 'teaser_widget_jsonEditor',
		'schema' =>$model->teaser_widget_schema,
		'enableSelectize' => true,
		'clientOptions' => [
			'theme' => 'bootstrap3',
			'disable_collapse' => true,
			'disable_properties' => true,
            'keep_oneof_values' => false,
			'ajax' => true
		],
	]) ?>

<!-- attribute title -->
			<?php echo $form->field($model, 'title'); ?>
        </p>
        <?php $this->endBlock(); ?>

        <?php echo
Tabs::widget(
	[
		'encodeLabels' => false,
		'items' => [
			[
				'label'   => Yii::t('publication', 'PublicationItemTranslation'),
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
	($model->isNewRecord ? Yii::t('publication', 'Create') : Yii::t('publication', 'Save')),
	[
		'id' => 'save-' . $model->formName(),
		'class' => 'btn btn-success'
	]
);
?>

        <?php ActiveForm::end(); ?>

    </div>

</div>
