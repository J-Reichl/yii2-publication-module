<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace dmstr\modules\publication\models\crud\base;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base-model class for table "{{%dmstr_publication_category}}".
 *
 * @property integer $id
 * @property integer $content_widget_template_id
 * @property integer $teaser_widget_template_id
 * @property string $name
 * @property string $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property \dmstr\modules\publication\models\crud\HrzgWidgetTemplate $contentWidgetTemplate
 * @property \dmstr\modules\publication\models\crud\HrzgWidgetTemplate $teaserWidgetTemplate
 * @property \dmstr\modules\publication\models\crud\PublicationItem[] $publicationItems
 * @property string $aliasModel
 */
abstract class PublicationCategory extends \yii\db\ActiveRecord
{



    /**
    * ENUM field values
    */
    const STATUS_DRAFT = 'draft';
    const STATUS_PUBLISHED = 'published';
    var $enum_labels = false;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%dmstr_publication_category}}';
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
            [['content_widget_template_id', 'teaser_widget_template_id'], 'integer'],
            [['name'], 'required'],
            [['status'], 'string'],
            [['name'], 'string', 'max' => 80],
            [['name'], 'unique'],
            [['content_widget_template_id'], 'exist', 'skipOnError' => true, 'targetClass' => \dmstr\modules\publication\models\crud\HrzgWidgetTemplate::className(), 'targetAttribute' => ['content_widget_template_id' => 'id']],
            [['teaser_widget_template_id'], 'exist', 'skipOnError' => true, 'targetClass' => \dmstr\modules\publication\models\crud\HrzgWidgetTemplate::className(), 'targetAttribute' => ['teaser_widget_template_id' => 'id']],
            ['status', 'in', 'range' => [
                    self::STATUS_DRAFT,
                    self::STATUS_PUBLISHED,
                ]
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('models', 'ID'),
            'content_widget_template_id' => Yii::t('models', 'Content Widget Template ID'),
            'teaser_widget_template_id' => Yii::t('models', 'Teaser Widget Template ID'),
            'name' => Yii::t('models', 'Name'),
            'status' => Yii::t('models', 'Status'),
            'created_at' => Yii::t('models', 'Created At'),
            'updated_at' => Yii::t('models', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContentWidgetTemplate()
    {
        return $this->hasOne(\dmstr\modules\publication\models\crud\HrzgWidgetTemplate::className(), ['id' => 'content_widget_template_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeaserWidgetTemplate()
    {
        return $this->hasOne(\dmstr\modules\publication\models\crud\HrzgWidgetTemplate::className(), ['id' => 'teaser_widget_template_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublicationItems()
    {
        return $this->hasMany(\dmstr\modules\publication\models\crud\PublicationItem::className(), ['publication_category_id' => 'id']);
    }


    
    /**
     * @inheritdoc
     * @return \dmstr\modules\publication\models\crud\query\PublicationCategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \dmstr\modules\publication\models\crud\query\PublicationCategoryQuery(get_called_class());
    }


    /**
     * get column status enum value label
     * @param string $value
     * @return string
     */
    public static function getStatusValueLabel($value){
        $labels = self::optsStatus();
        if(isset($labels[$value])){
            return $labels[$value];
        }
        return $value;
    }

    /**
     * column status ENUM value labels
     * @return array
     */
    public static function optsStatus()
    {
        return [
            self::STATUS_DRAFT => Yii::t('models', self::STATUS_DRAFT),
            self::STATUS_PUBLISHED => Yii::t('models', self::STATUS_PUBLISHED),
        ];
    }

}
