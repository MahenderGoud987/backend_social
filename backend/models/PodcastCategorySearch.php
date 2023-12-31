<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PodcastCategory;

class PodcastCategorySearch extends PodcastCategory
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['id'], 'integer'],
            [['name','parent_id'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
          return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = PodcastCategory::find()
        ->where(['level'=>PodcastCategory::LEVEL_MAIN])
        ->andWhere(['<>','status',PodcastCategory::STATUS_DELETED]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
       /* $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'created_at' => $this->created_at,
        ]);
        */
        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }

    public function searchSubCategory($params)
    {
        $query = PodcastCategory::find()
        ->where(['level'=>PodcastCategory::LEVEL_SUB])
        ->andWhere(['<>','status',PodcastCategory::STATUS_DELETED]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'parent_id' => $this->parent_id
       
        ]);
       
        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
