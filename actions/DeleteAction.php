<?php

namespace app\actions;

use Yii;
use yii\base\Action;
use yii\web\Response;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;

/**
 * Class DeleteAction
 * @package app\actions
 */
class DeleteAction extends Action
{

    public $modelClass;

    /**
     * @inheritdoc
     * @throws \yii\web\BadRequestHttpException
     */
    public function run($id)
    {
        if (Yii::$app->request->isAjax && Yii::$app->request->isPost) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $model = $this->findModel($id);
//            if ($model->hasAttribute('user_id')) {
//                $model->user_id = Yii::$app->session->get('userId');
//            }
            $model->status = 0;
            if($model->save(false)) {
                return [
                    'status' => 'ok',
                    'msg' => 'Все ништяк!!!',
                ];
            }
            return [
                'status' => 'error',
                'msg' => 'Произошла ошибка!!!',
            ];
        } else {
            throw new BadRequestHttpException(Yii::t('common', "Запрос не ajax'овский!!!"));
        }
    }

    /**
     * Finds the model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return \yii\db\ActiveRecord the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        $class = $this->modelClass;
        if ($id !== null && ($model = $class::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('common', 'Запрашиваемая страница не существует.'));
        }
    }

}