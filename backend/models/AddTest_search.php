<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AddTest;

/**
 * AddTest_search represents the model behind the search form about `backend\models\AddTest`.
 */
class AddTest_search extends AddTest
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['test_name', 'school_id', 'created_by', 'created', 'updated'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = AddTest::find();
		if(Yii::$app->user->identity->role_id == 1) {
			$query->andFilterWhere(['=', 'school_id', Yii::$app->user->getId()]);
		}else{
			$query->andFilterWhere(['=', 'school_id', Yii::$app->user->identity->school_id])->andFilterWhere(['=', 'created_by', Yii::$app->user->getId()]);
		}
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
			'sort'=> ['defaultOrder' => ['id' => SORT_DESC]],
			'pagination' => [ 'pageSize' => 20 ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'test_name', $this->test_name])
            ->andFilterWhere(['like', 'school_id', $this->school_id])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'created', $this->created])
            ->andFilterWhere(['like', 'updated', $this->updated]);

        return $dataProvider;
    }
}
