<?php

namespace app\widgets;

use Yii;
use yii\base\Widget;
use app\modules\bloodstorage\models\BloodStorage;
use app\modules\catalog\models\Catalog;
use app\modules\organization\models\Organization;

class Move extends Widget
{

    public function run()
    {
        $bsModel = new BloodStorage;
        return $this->render('move', [
            'typesSend' => $bsModel->getTypesSend(),
            'departments' => Catalog::getAllForLists(10, Yii::$app->getRequest()->getCookies()->getValue('organizationId')),
            'defects' => Catalog::getAllForLists(5),
            'organizations' => Organization::getAllForLists(),
        ]);
    }

} 