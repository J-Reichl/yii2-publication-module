<?php

namespace dmstr\modules\publication\models\crud;

use Yii;
use \dmstr\modules\publication\models\crud\base\PublicationItemTranslation as BasePublicationItemTranslation;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%dmstr_publication_item_translation}}".
 */
class PublicationItemTranslation extends BasePublicationItemTranslation
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%dmstr_publication_item_translation}}';
    }
    /**
     * @return string
     */
    public function getLanguage()
    {
        return Yii::$app->language;
    }

}
