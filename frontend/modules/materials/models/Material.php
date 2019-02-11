<?php

namespace frontend\modules\materials\models;

use Yii;

/**
 * This is the model class for table "{{%material}}".
 *
 * @property int $id
 * @property string $file_name
 * @property string $title
 * @property string $description
 * @property string $type
 * @property string $mime_type
 */
class Material extends \yii\db\ActiveRecord
{
    const TYPE_VIDEO = 'video';
    const TYPE_AUDIO = 'audio';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%material}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['file_name', 'title', 'type', 'mime_type'], 'required'],
            [['file_name'], 'string', 'max' => 20],
            [['title'], 'string', 'max' => 50],
            [['description', 'type'], 'string', 'max' => 255],
            [['mime_type'], 'string', 'max' => 7],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'file_name' => 'File Name',
            'title' => 'Title',
            'description' => 'Description',
            'type' => 'Type',
            'mime_type' => 'Mime Type',
        ];
    }

    /**
     * {@inheritdoc}
     * @return MaterialQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MaterialQuery(get_called_class());
    }

    /**
     * Hide Model name
     * @return string
     */
    public function formName()
    {
        return '';
    }
}
