<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Empresa;

/**
 * EmpresaSearch represents the model behind the search form of `app\models\Empresa`.
 */
class EmpresaSearch extends Empresa
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_ciudad', 'id_sector_empresa', 'deleted', 'id_evento', 'id_proveedor_tecnologico'], 'integer'],
            [['nombre', 'identificacion', 'direccion', 'telefono', 'telefono_extension', 'movil', 'afiliado_gremio', 'estado', 'created_at', 'modified_at', 'correo_facturacion_electronica'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Empresa::find();

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
            'id_ciudad' => $this->id_ciudad,
            'id_sector_empresa' => $this->id_sector_empresa,
            'created_at' => $this->created_at,
            'modified_at' => $this->modified_at,
            'deleted' => $this->deleted,
            'id_evento' => $this->id_evento,
            'id_proveedor_tecnologico' => $this->id_proveedor_tecnologico,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'identificacion', $this->identificacion])
            ->andFilterWhere(['like', 'direccion', $this->direccion])
            ->andFilterWhere(['like', 'telefono', $this->telefono])
            ->andFilterWhere(['like', 'telefono_extension', $this->telefono_extension])
            ->andFilterWhere(['like', 'movil', $this->movil])
            ->andFilterWhere(['like', 'afiliado_gremio', $this->afiliado_gremio])
            ->andFilterWhere(['like', 'estado', $this->estado])
            ->andFilterWhere(['like', 'correo_facturacion_electronica', $this->correo_facturacion_electronica]);

        return $dataProvider;
    }
}
