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
			'info_omsk' => 'Дополнительная информация',
			'model_omsk' => 'Данные из Омской базы',
			'standart' => 'Поддержка стандартов связи'
		];
	}

	public function rules ()
	{
		return [
			[ ['tac', 'model_xinit', 'model_omsk', 'info_omsk', 'sim', 'standart'], 'safe' ],

			// [ 'model_xinit', 'model_omsk', 'info_omsk', 'autocomplete' => 'off' ],
			
			// [ ['tac', 'model_xinit'], 'required' ],

			[ 'tac', 'string', 'min' => 8, 'max' => 8 ],
			// [ 'tac', 'length' => [8, 8] ],
		];
	}
}


