<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AddStudent;

/**
 * AddStudent_search represents the model behind the search form about `backend\models\AddStudent`.
 */
class AddStudent_search extends AddStudent
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['first_name', 'last_name', 'dob', 'blood_group', 'gender', 'image', 'father_name', 'mother_name', 'father_ph_no', 'mother_phone_no', 'address', 'admission_number'], 'safe'],
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
        $query = AddStudent::find();
		if(Yii::$app->user->identity->role_id == 1) {
			$query->andFilterWhere(['=', 'school_id', Yii::$app->user->getId()])->andFilterWhere(['!=','status','2']);
		}else{
			$query->andFilterWhere(['=', 'school_id', Yii::$app->user->identity->school_id])->andFilterWhere(['!=','status','2']);
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
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'first_name', $this->first_name])
            ->orFilterWhere(['like', 'last_name', $this->first_name])
            ->andFilterWhere(['like', 'dob', $this->dob])
            ->andFilterWhere(['like', 'blood_group', $this->blood_group])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'father_name', $this->father_name])
            ->andFilterWhere(['like', 'mother_name', $this->mother_name])
            ->andFilterWhere(['like', 'father_ph_no', $this->father_ph_no])
            ->andFilterWhere(['like', 'mother_phone_no', $this->mother_phone_no])
            ->andFilterWhere(['like', 'address', $this->address])
			->andFilterWhere(['like', 'admission_number', $this->admission_number]);

        return $dataProvider;
    }
}