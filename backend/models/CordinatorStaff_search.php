<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\CordinatorStaff;

/**
 * CordinatorStaff_search represents the model behind the search form about `backend\models\CordinatorStaff`.
 */
class CordinatorStaff_search extends CordinatorStaff
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['fname', 'lname', 'dob', 'gender', 'date_of_joining', 'qualification', 'image', 'co_ordinator_id', 'school_id', 'created', 'updated', 'phone_number', 'blood_group', 'address', 'emergency_contact', 'specializatin', 'status', 'last_updated_by'], 'safe'],
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
        $query = CordinatorStaff::find();
		$query->andFilterWhere(['=', 'co_ordinator_id', Yii::$app->user->getId()]);
        // add conditions that should always apply here

            $dataProvider = new ActiveDataProvider([
            'query' => $query,
			'pagination' => [ 'pageSize' => 20 ],
			
			'sort' => ['attributes' => [
                   'fname',
                   'user_id',
                   'id' => [
                        'defaultOrder' => SORT_DESC
                   ],
				],
			  'defaultOrder' => ['id' => SORT_DESC],
			  ],
			
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
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'fname', $this->fname])
            ->andFilterWhere(['like', 'lname', $this->lname])
            ->andFilterWhere(['like', 'dob', $this->dob])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'date_of_joining', $this->date_of_joining])
            ->andFilterWhere(['like', 'qualification', $this->qualification])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'co_ordinator_id', $this->co_ordinator_id])
            ->andFilterWhere(['like', 'school_id', $this->school_id])
            ->andFilterWhere(['like', 'created', $this->created])
            ->andFilterWhere(['like', 'updated', $this->updated])
            ->andFilterWhere(['like', 'phone_number', $this->phone_number])
            ->andFilterWhere(['like', 'blood_group', $this->blood_group])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'emergency_contact', $this->emergency_contact])
            ->andFilterWhere(['like', 'specializatin', $this->specializatin])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'last_updated_by', $this->last_updated_by]);

        return $dataProvider;
    }
}
