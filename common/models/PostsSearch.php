<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Posts;

/**
 * PostsSearch represents the model behind the search form about `app\models\Posts`.
 */
class PostsSearch extends Posts
{
    public $username;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_user', 'created_at', 'updated_at', 'deleted_at', 'visible'], 'integer'],
            [['title', 'text', 'username'], 'safe'],
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
        $query = Posts::find()->with(['user']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'title',
                'created_at',
                'visible',
                'username' => [
                    'asc' => ['user.username' => SORT_ASC],
                    'desc' => ['user.username' => SORT_DESC],
                    'label' => 'Username'
                ]
            ]
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
            'id_user' => $this->id_user,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
            'visible' => $this->visible,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'text', $this->text]);
        
        $query->joinWith(['user' => function ($q) {
            $q->where("{{%user}}.username LIKE '%{$this->username}%'");
        }]);
        
        return $dataProvider;
    }
}
