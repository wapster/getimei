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
			if ($model->validate()) {
				$user_query = $model->tac;
				$result = $model->find()->asArray()->where(['like', 'tac', $user_query])->all();
				
				if (is_array($result)) {
					Yii::$app->session->setFlash('success', 'TAC: ' . $model->tac);
					return $this->render('result', compact('result'));
				}
			} else {
				Yii::$app->session->setFlash('error', 'Ошибка. Покажите ее адмнистратору.');
				exit;
			}
		}

		return $this->render('index', compact('model'));
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
				Yii::$app->session->setFlash('error', 'Ошибка. Покажите ее адмнистратору.');
			}
		}
		
		return $this->render('add', compact('model'));
	}


	public function actionDelete($id = false)
    {
        if (isset($id)) {
            if (Tac::deleteAll(['in', 'id', $id])) {
                $this->redirect(['index']);
            }
        } else {
            $this->redirect(['index']);
        }
    }

	


	public function actionEdit($tac)
	{
		$tac = '86463804';
		return $this->render('edit', compact('tac'));
	}

}
