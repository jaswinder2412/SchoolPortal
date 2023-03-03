<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Assignmentclasses;

/**
 * Assignmentclasses_search represents the model behind the search form about `backend\models\Assignmentclasses`.
 */
class Assignmentclasses_search extends Assignmentclasses
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['class_id', 'section', 'Academic_year_id', 'school_id', 'student_id', 'anouncement_title', 'anouncement_description', 'status', 'created_by', 'fileupload', 'created', 'updated'], 'safe'],
			
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
        $query = Assignmentclasses::find();
		if(Yii::$app->user->identity->role_id == 1) {
			$query->andFilterWhere(['=', 'school_id', Yii::$app->user->getId()]);
		}else {
			$query->andFilterWhere(['=', 'school_id', Yii::$app->user->identity->school_id]);
		}
		$query->andFilterWhere(['=', 'created_by', Yii::$app->user->getId()]);
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

        $query->andFilterWhere(['like', 'class_id', $this->class_id])
            ->andFilterWhere(['like', 'section', $this->section])
            ->andFilterWhere(['like', 'Academic_year_id', $this->Academic_year_id])
            ->andFilterWhere(['like', 'school_id', $this->school_id])
            ->andFilterWhere(['like', 'student_id', $this->student_id])
            ->andFilterWhere(['like', 'anouncement_title', $this->anouncement_title])
            ->andFilterWhere(['like', 'anouncement_description', $this->anouncement_description])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'fileupload', $this->fileupload])
            ->andFilterWhere(['like', 'created', $this->created])
            ->andFilterWhere(['like', 'updated', $this->updated]);

        return $dataProvider;
    }
}
