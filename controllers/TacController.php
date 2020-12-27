<?php

namespace app\controllers;
use Yii;

use yii\web\Controller;
use app\models\Tac;


class TacController extends Controller
{
	public function actionIndex()
	{
		$model = new Tac();

		if ( $model->load(Yii::$app->request->post()) ) 
		{
			if ($model->validate(['tac'])) {
				$user_query = $model->tac;
				$result = $model->find()->asArray()->where(['like', 'tac', $user_query])->all();
				
				if (is_array($result)) {
					Yii::$app->session->setFlash('success', 'TAC: ' . $model->tac);
					return $this->render('result', compact('result'));
				}
			} else {
				Yii::$app->session->setFlash('error', 'Ошибка поиска. Сообщите адмнистратору.');
				exit;
			}
		}

		return $this->render('index', compact('model'));
	}


	/* Поиск сразу нескольких IMEI */
	public function actionMassCheck()
	{
		$model = new Tac();

		if ( $model->load(Yii::$app->request->post()) ) 
		{
			if ($model->validate(['imeis'])) {

				$imeis = explode(PHP_EOL, $model->imeis);

				// формируем массив с 8-значными значениями IMEI
				$false_imeis = [];
				$true_imeis  = [];
				
				foreach ($imeis as $imei) {

					$imei = str_replace(" ", '', $imei);

					// проверка длины строки
					$len = strlen($imei);
					
					if ($len < 8) {
						$false_imeis[] = trim($imei);
					}
					
					if ($len >= 8) {
						$tac = substr($imei, 0, 8);
						$true_imeis[] = $tac;
					}
				}
				$false_imeis = array_diff($false_imeis, ['']);
				$result['false_imeis'] = $false_imeis;
				$result['true_imeis'] = $true_imeis;

				return $this->render('result-mass-check', compact('result'));

			} else {
				Yii::$app->session->setFlash('error', 'Ошибка массовой проверки IMEI.<br> Сообщите адмнистратору.');
				exit;
			}
		}
		return $this->render('masscheck', compact('model'));
	}



	public function actionAdd() 
	{
		$model = new Tac();
		
		if ( $model->load(Yii::$app->request->post()) ) 
		{
			if ($model->save()) {
				// debug($model); exit;
				Yii::$app->session->setFlash('success', 'Данные успешно добавлены');
				return $this->refresh();
			} else {
				Yii::$app->session->setFlash('error', 'Ошибка. Сообщите адмнистратору.');
			}
		}
		
		return $this->render('add', compact('model'));
	}


	public function actionDelete($id = false)
    {
        if (isset($id)) {
            if (Tac::deleteAll(['in', 'id', $id])) {
				$this->redirect(['index']);
				// return $this->refresh();
            }
        } else {
            $this->redirect(['index']);
        }
    }

	


	public function actionEdit($id)
	{
		// $model = Tac::find()->asArray()->where( ['id' => $id] )->one();
		$model = Tac::findOne($id);
		if ( $model->load(Yii::$app->request->post()) ) { 
			if ($model->save()) {
				Yii::$app->session->setFlash('success', 'Данные успешно обновлены');
				return $this->refresh();
			} else {
				Yii::$app->session->setFlash('error', 'Ошибка. Сообщите адмнистратору.');
			}
		}
		return $this->render('edit', compact('model'));
	}

}
