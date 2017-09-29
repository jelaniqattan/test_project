<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SumAddress;

/**
 * SumAddressSearch represents the model behind the search form about `app\models\SumAddress`.
 */
class SumAddressSearch extends SumAddress
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['shop_address', 'customer_address', 'create_time', 'update_time', 'arrive'], 'safe'],
            [['sum_km'], 'number'],
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
        $query = SumAddress::find();

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
            'sum_km' => $this->sum_km,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
            'arrive' => $this->arrive,
        ]);

        $query->andFilterWhere(['like', 'shop_address', $this->shop_address])
            ->andFilterWhere(['like', 'customer_address', $this->customer_address]);

        return $dataProvider;
    }
}
