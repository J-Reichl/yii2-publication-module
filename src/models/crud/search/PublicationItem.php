<?php
/**
 * /app/src/../runtime/giiant/e0080b9d6ffa35acb85312bf99a557f2
 *
 * @package default
 */


namespace dmstr\modules\publication\models\crud\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use dmstr\modules\publication\models\crud\PublicationItem as PublicationItemModel;

/**
 * PublicationItem represents the model behind the search form about `dmstr\modules\publication\models\crud\PublicationItem`.
 */
class PublicationItem extends PublicationItemModel
{

	/**
	 *
	 * @inheritdoc
	 * @return unknown
	 */
	public function rules() {
		return [
			[['id', 'publication_category_id', 'created_at', 'updated_at'], 'integer'],
			[['content_widget_json', 'teaser_widget_json', 'status', 'release_date', 'end_date'], 'safe'],
		];
	}


	/**
	 *
	 * @inheritdoc
	 * @return unknown
	 */
	public function scenarios() {
		// bypass scenarios() implementation in the parent class
		return Model::scenarios();
	}


	/**
	 * Creates data provider instance with search query applied
	 *
	 *
	 * @param array   $params
	 * @return ActiveDataProvider
	 */
	public function search($params) {
		$query = PublicationItemModel::find();

		$dataProvider = new ActiveDataProvider([
				'query' => $query,
			]);

		$this->load($params);

		if (!$this->validate()) {
			// uncomment the following line if you do not want to any records when validation fails
			// $query->where('0=1');
			return $dataProvider;
		}

		$query->andFilterWhere([
				'id' => $this->id,
				'publication_category_id' => $this->publication_category_id,
				'release_date' => $this->release_date,
				'end_date' => $this->end_date,
				'created_at' => $this->created_at,
				'updated_at' => $this->updated_at,
			]);

		$query->andFilterWhere(['like', 'content_widget_json', $this->content_widget_json])
		->andFilterWhere(['like', 'teaser_widget_json', $this->teaser_widget_json])
		->andFilterWhere(['like', 'status', $this->status]);

		return $dataProvider;
	}


}