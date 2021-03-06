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
					if (!empty($result)) {
						Yii::$app->session->setFlash('success', 'TAC: ' . $model->tac);
						return $this->render('result', compact('result'));
					} else {
						Yii::$app->session->setFlash('success', 'TAC: ' . $model->tac);
						$result[] = $model->tac;
						return $this->render('null-result', compact('result'));
					}
				}
			} else {
				Yii::$app->session->setFlash('error', 'Ошибка поиска. Сообщите администратору.');
				exit;
			}
		}

		return $this->render('index', compact('model'));
	}



	public function actionPhoneModel()
	{
		$model = new Tac();

		if ( $model->load(Yii::$app->request->post()) ) 
		{
			if ($model->validate(['model_xinit'])) {
				$user_query = $model->model_xinit;
				$result = $model->find()->asArray()->where(['like', 'model_xinit', $user_query])->all();
				
				if (is_array($result)) {
					Yii::$app->session->setFlash('success', 'Запрос: ' . $model->model_xinit);
					return $this->render('result-phone-model', compact('result'));
				}
			} else {
				Yii::$app->session->setFlash('error', 'Ошибка поиска. Сообщите администратору.');
				exit;
			}
		}

		return $this->render('phone-model', compact('model'));
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

				// request to database
				// запросы к БД
				$data['not_in_db'] = [];
				$data['false_imeis'] = $result['false_imeis'];
				foreach ($result['true_imeis'] as $tac) {
					$request = $model->find()->asArray()->where(['like', 'tac', $tac])->all();
					if (count($request) > 0) {
						$data['true_result'][$tac] = $request;
					} else {
						$data['not_in_db'][] = $tac;
					}
				}

				return $this->render('result-mass-check', compact('data'));

			} else {
				Yii::$app->session->setFlash('error', 'Ошибка массовой проверки IMEI.<br> Сообщите администратору.');
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
				Yii::$app->session->setFlash('error', 'Ошибка. Сообщите администратору.');
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
				Yii::$app->session->setFlash('error', 'Ошибка. Сообщите администратору.');
			}
		}
		return $this->render('edit', compact('model'));
	}

}
