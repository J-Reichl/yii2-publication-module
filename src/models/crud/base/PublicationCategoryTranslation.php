<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace dmstr\modules\publication\models\crud\base;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base-model class for table "{{%dmstr_publication_category_translation}}".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $language_code
 * @property string $title
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property \dmstr\modules\publication\models\crud\PublicationCategory $category
 * @property \dmstr\modules\publication\models\crud\PublicationItemTranslation[] $publicationItemTranslations
 * @property string $aliasModel
 */
abstract class PublicationCategoryTranslation extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%dmstr_publication_category_translation}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'language_code'], 'required'],
            [['category_id'], 'integer'],
            [['language_code'], 'string', 'max' => 8],
            [['title'], 'string', 'max' => 80],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => \dmstr\modules\publication\models\crud\PublicationCategory::className(), 'targetAttribute' => ['category_id' => 'id']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('models', 'ID'),
            'category_id' => Yii::t('models', 'Category ID'),
            'language_code' => Yii::t('models', 'Language Code'),
            'title' => Yii::t('models', 'Title'),
            'created_at' => Yii::t('models', 'Created At'),
            'updated_at' => Yii::t('models', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(\dmstr\modules\publication\models\crud\PublicationCategory::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublicationItemTranslations()
    {
        return $this->hasMany(\dmstr\modules\publication\models\crud\PublicationItemTranslation::className(), ['publication_category_id' => 'id']);
    }


    
    /**
     * @inheritdoc
     * @return \dmstr\modules\publication\models\crud\query\PublicationCategoryTranslationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \dmstr\modules\publication\models\crud\query\PublicationCategoryTranslationQuery(get_called_class());
    }


}