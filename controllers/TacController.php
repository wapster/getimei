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
		return $this->render('masscheck', ['dsfjsdkfj' => '33333333']);
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
