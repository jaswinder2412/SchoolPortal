<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\SchoolList;
use common\models\User;

/**
 * SchoolList_search represents the model behind the search form about `backend\models\SchoolList`.
 */
class SchoolList_search extends SchoolList
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['school_name', 'school_user_id', 'school_location', 'school_logo', 'description', 'number_of_student', 'first_name', 'last_name', 'status', 'created_by', 'created_time', 'updated', 'image'], 'safe'],
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
        $query = SchoolList::find();

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

		$subQuery1 = USER::find()->Where(['LIKE', 'email', $this->school_user_id]);

        $query->andFilterWhere(['like', 'school_name', $this->school_name])
			->orFilterWhere(['like', 'school_location', $this->school_name])
            ->andFilterWhere(['like', 'school_user_id', $this->school_user_id])
            ->andFilterWhere(['like', 'school_logo', $this->school_logo])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'number_of_student', $this->number_of_student])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'created_time', $this->created_time])
            ->andFilterWhere(['like', 'updated', $this->updated])
			->andFilterWhere(['like', 'first_name', $this->first_name])
            ->orFilterWhere(['like', 'last_name', $this->first_name]);

        return $dataProvider;
    }
}
