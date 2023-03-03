<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ClassInfo;

/**
 * Classinfo_search represents the model behind the search form about `backend\models\ClassInfo`.
 */
class ClassInfo_search extends ClassInfo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['class_section', 'class_name', 'class_description'], 'safe'],
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
        $query = ClassInfo::find();
		if(Yii::$app->user->identity->role_id == 1) {
			$query->andFilterWhere(['=', 'school_id', Yii::$app->user->getId()]);
		}else {
			$query->andFilterWhere(['=', 'school_id', Yii::$app->user->identity->school_id]);
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

        $query->andFilterWhere(['like', 'class_section', $this->class_section])
            ->andFilterWhere(['like', 'class_name', $this->class_name])
            ->andFilterWhere(['like', 'class_description', $this->class_description]);

        return $dataProvider;
    }
}