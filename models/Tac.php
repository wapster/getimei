<?php

namespace app\models;
use Yii;
// use yii\base\Model;
use yii\db\ActiveRecord;

class Tac extends ActiveRecord
{

	// public $tac;
	// public $model_xinit;

	public static function tableName()
	{
		return '{{tac}}';
	}


	public function attributeLabels()
	{
		return [
			'tac' => 'TAC',
			'model_xinit' => 'Модель телефона',
			'sim' => 'Кол-во SIM карт',
			'info_omsk' => 'Доп. инф-ция (как найти 2й слот)',
			'model_omsk' => 'Данные из Омской базы',
			'standart' => 'Поддержка стандартов связи'
		];
	}

	public function rules ()
	{
		return [
			[ ['tac', 'model_xinit', 'model_omsk', 'info_omsk', 'sim', 'standart'], 'safe' ],
			
			[ ['tac', 'model_xinit', 'info_omsk', 'sim', 'standart'], 'required' ],

			[ 'tac', 'string', 'min' => 8, 'max' => 8 ],
			[ 'sim', 'integer', 'min' => 1, 'max' => 4 ],
			// [ 'tac', 'length' => [8, 8] ],
		];
	}
}


