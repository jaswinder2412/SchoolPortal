<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\FinalExam;

/**
 * FinalExam_search represents the model behind the search form about `backend\models\FinalExam`.
 */
class FinalExam_search extends FinalExam
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['exam_id', 'class_id', 'section_id', 'subject_id'], 'safe'],
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
        $query = FinalExam::find();
		if(Yii::$app->user->identity->role_id == 1) {
			$query->andFilterWhere(['=', 'school_id', Yii::$app->user->getId()])->groupBy(['exam_id']);
		}else{
			$query->andFilterWhere(['=', 'school_id', Yii::$app->user->identity->school_id])->groupBy(['exam_id']);
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

        $query->andFilterWhere(['like', 'exam_id', $this->exam_id])
            ->andFilterWhere(['like', 'class_id', $this->class_id])
            ->andFilterWhere(['like', 'section_id', $this->section_id])
            ->andFilterWhere(['like', 'subject_id', $this->subject_id]);

        return $dataProvider;
    }
}
