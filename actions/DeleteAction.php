<?php
/**
 * @copyright Copyright (c) 2014 2amigOS! Consulting Group LLC
 * @link http://2amigos.us
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
namespace app\actions;

use Yii;
use yii\base\Action;
use yii\base\InvalidConfigException;
use yii\web\Response;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;

/**
 * Class DeleteAction
 * @package app\actions
 */
class DeleteAction extends Action
{

    /**
     * @var string the class name of the model.
     */
    public $modelClass;

    /**
     * @inheritdoc
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {
        if ($this->modelClass === null) {
            throw new InvalidConfigException(Yii::t('common', '"modelClass" не может быть пустым.'));
        }
        parent::init();
    }

    /**
     * @inheritdoc
     * @throws \yii\web\BadRequestHttpException
     */
    public function run($id)
    {
        if (Yii::$app->request->isAjax) {
            $model = $this->findModel($id);
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($model->delete()) {
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