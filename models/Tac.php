<?php

namespace app\models;
use Yii;
// use yii\base\Model;
use yii\db\ActiveRecord;

class Tac extends ActiveRecord
{

	public $tac;
	public $model_xinit;

	public static function tableName()
	{
		return '{{tac}}';
	}


	public function rules ()
	{
		return [
			[ ['tac', 'model_xinit'], 'safe' ],
			// [ ['tac', 'model_xinit'], 'required' ],

			[ 'tac', 'string', 'min' => 8, 'max' => 8 ],
			// [ 'tac', 'length' => [8, 8] ],
		];
	}
}


