<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "empresas".
 *
 * @property int $id
 * @property string $nombre
 * @property string $identificacion
 * @property string $direccion
 * @property string $telefono
 * @property string $telefono_extension
 * @property string $movil
 * @property int $id_ciudad
 * @property string $afiliado_gremio
 * @property string $estado
 * @property int $id_sector_empresa
 * @property string|null $created_at
 * @property string|null $modified_at
 * @property int $deleted
 * @property int $id_evento
 * @property int|null $id_proveedor_tecnologico
 * @property string|null $correo_facturacion_electronica
 *
 * @property Contacto[] $contactos
 * @property Ciudad $ciudad
 * @property ProveedorTecnologico $proveedorTecnologico
 * @property SectoresEmpresa $sectorEmpresa
 * @property Factura[] $facturas
 * @property Inscripcione[] $inscripciones
 */
class Empresa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'empresas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'identificacion', 'direccion', 'telefono', 'telefono_extension', 'movil', 'id_ciudad', 'afiliado_gremio', 'estado', 'id_sector_empresa', 'id_evento'], 'required'],
            [['id_ciudad', 'id_sector_empresa', 'deleted', 'id_evento', 'id_proveedor_tecnologico'], 'integer'],
            [['created_at', 'modified_at'], 'safe'],
            [['nombre', 'direccion'], 'string', 'max' => 255],
            [['identificacion', 'telefono', 'telefono_extension', 'movil', 'estado'], 'string', 'max' => 20],
            [['afiliado_gremio'], 'string', 'max' => 10],
            [['correo_facturacion_electronica'], 'string', 'max' => 250],
            [['id_ciudad'], 'exist', 'skipOnError' => true, 'targetClass' => Ciudad::className(), 'targetAttribute' => ['id_ciudad' => 'id']],
            [['id_proveedor_tecnologico'], 'exist', 'skipOnError' => true, 'targetClass' => ProveedorTecnologico::className(), 'targetAttribute' => ['id_proveedor_tecnologico' => 'id']],
            [['id_sector_empresa'], 'exist', 'skipOnError' => true, 'targetClass' => SectoresEmpresa::className(), 'targetAttribute' => ['id_sector_empresa' => 'id']],
        ];
    }

    public function fields()
    {
        $fields = parent::fields();

        // remove fields that contain sensitive information
        unset($fields['created_at'], $fields['deleted'], $fields['id_proveedor_tecnologico']);

        return $fields;
    }

    public function extraFields()
    {
        return ['ciudad'];
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'identificacion' => 'Identificacion',
            'direccion' => 'Direccion',
            'telefono' => 'Telefono',
            'telefono_extension' => 'Telefono Extension',
            'movil' => 'Movil',
            'id_ciudad' => 'Id Ciudad',
            'afiliado_gremio' => 'Afiliado Gremio',
            'estado' => 'Estado',
            'id_sector_empresa' => 'Id Sector Empresa',
            'created_at' => 'Created At',
            'modified_at' => 'Modified At',
            'deleted' => 'Deleted',
            'id_evento' => 'Id Evento',
            'id_proveedor_tecnologico' => 'Id Proveedor Tecnologico',
            'correo_facturacion_electronica' => 'Correo Facturacion Electronica',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContactos()
    {
        return $this->hasMany(Contacto::className(), ['id_empresa' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCiudad()
    {
        return $this->hasOne(Ciudad::className(), ['id' => 'id_ciudad']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProveedorTecnologico()
    {
        return $this->hasOne(ProveedorTecnologico::className(), ['id' => 'id_proveedor_tecnologico']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSectorEmpresa()
    {
        return $this->hasOne(SectoresEmpresa::className(), ['id' => 'id_sector_empresa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFacturas()
    {
        return $this->hasMany(Factura::className(), ['id_empresa' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInscripciones()
    {
        return $this->hasMany(Inscripcione::className(), ['id_empresa' => 'id']);
    }
}
