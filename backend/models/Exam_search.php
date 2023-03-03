<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Exam;

/**
 * Exam_search represents the model behind the search form about `backend\models\Exam`.
 */
class Exam_search extends Exam
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['exam_name', 'marks', 'school_id', 'created_date', 'updated_date'], 'safe'],
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
        $query = Exam::find();
		if(Yii::$app->user->identity->role_id == 1) {
			$query->andFilterWhere(['=', 'school_id', Yii::$app->user->getId()]);
		}else{
			$query->andFilterWhere(['=', 'school_id', Yii::$app->user->identity->school_id]);
		}
		
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
			'sort'=> ['defaultOrder' => ['id' => SORT_DESC]],
			'pagination' => [ 'pageSize' => 10 ],
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

        $query->andFilterWhere(['like', 'exam_name', $this->exam_name])
            ->andFilterWhere(['like', 'marks', $this->marks])
            ->andFilterWhere(['like', 'school_id', $this->school_id])
            ->andFilterWhere(['like', 'created_date', $this->created_date])
            ->andFilterWhere(['like', 'updated_date', $this->updated_date]);

        return $dataProvider;
    }
}