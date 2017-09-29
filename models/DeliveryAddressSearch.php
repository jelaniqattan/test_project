<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DeliveryAddress;

/**
 * DeliveryAddressSearch represents the model behind the search form about `app\models\DeliveryAddress`.
 */
class DeliveryAddressSearch extends DeliveryAddress
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'zipcode'], 'integer'],
            [['city', 'country', 'note', 'create_time', 'update_time', 'arrive_time'], 'safe'],
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
        $query = DeliveryAddress::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'zipcode' => $this->zipcode,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
            'arrive_time' => $this->arrive_time,
        ]);

        $query->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
