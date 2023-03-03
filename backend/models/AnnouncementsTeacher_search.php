<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AnnouncementsTeacher;

/**
 * AnnouncementsTeacher_search represents the model behind the search form about `backend\models\AnnouncementsTeacher`.
 */
class AnnouncementsTeacher_search extends AnnouncementsTeacher
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'updated_time'], 'integer'],
            [['anouncement_title', 'anouncement_description', 'announcements_to', 'announcements_from', 'status', 'created_time'], 'safe'],
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
        $query = AnnouncementsTeacher::find();
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
            'updated_time' => $this->updated_time,
        ]);

        $query->andFilterWhere(['like', 'anouncement_title', $this->anouncement_title])
            ->andFilterWhere(['like', 'anouncement_description', $this->anouncement_description])
            ->andFilterWhere(['like', 'announcements_to', $this->announcements_to])
            ->andFilterWhere(['like', 'announcements_from', $this->announcements_from])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'created_time', $this->created_time]);

        return $dataProvider;
    }
}