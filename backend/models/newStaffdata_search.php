<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\newStaffdata;
use backend\models\UserCustom;
use yii\db\Expression;
/**
 * newStaffdata_search represents the model behind the search form about `backend\models\newStaffdata`.
 */
class newStaffdata_search extends newStaffdata
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['fname', 'lname'], 'safe'],
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
		
        $query = newStaffdata::find();
				
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
        ]);
		
		if (!empty($this->user_id)):
			if(Yii::$app->user->identity->role_id == 1) {
			$tag_ids = UserCustom::find()->where(['=', 'role_id', $this->user_id])->andFilterWhere(['=', 'school_id', Yii::$app->user->getId()])->all();
			}
			else{
			$tag_ids = UserCustom::find()->where(['=', 'role_id', $this->user_id])->andFilterWhere(['=', 'school_id', Yii::$app->user->identity->school_id])->all();	
			}
		if(!empty($tag_ids)){
			foreach($tag_ids as $midsfg){
				$query->orFilterWhere(['=', 'user_id', $midsfg->id]);
			}
		}
		else{
			$query->andFilterWhere(['=', 'id', '0']);
		}
        endif;
        $query->andFilterWhere(['like', 'fname', $this->fname])
            ->orFilterWhere(['like', 'lname', $this->fname]);
			if(Yii::$app->user->identity->role_id == 1) {
			$query->andFilterWhere(['=', 'school_id', Yii::$app->user->getId()]);
			}else{
			$query->andFilterWhere(['=', 'school_id', Yii::$app->user->identity->school_id]);
		} 
        return $dataProvider;
    }
}