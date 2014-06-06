<?php

namespace app\widgets;

use Yii;
use yii\base\Widget;

class RecipientColumns extends Widget
{

    public $grid;

    public function run()
    {
        $js = '';
        if (($columns = unserialize(Yii::$app->getRequest()->getCookies()->getValue('columns'))) !== false) {
            $columns = isset($columns['recipient']) ?
                (strpos($columns['recipient'], ',') !== false ?
                    explode(',', $columns['recipient']) :
                    [$columns['recipient']]) : null;
            if ($columns) {
                $js .= "$('.columnsM input[type=checkbox]').prop('checked', false);";
                foreach ($columns as $column) {
                    $js .= "$('.columnsM input[type=checkbox][value=" .
                        $column . "]').prop('checked', true);";
                }
            } else {
                $js .= "$('.columnsM input[type=checkbox]').prop('checked', true);";
            }
        } else {
            $js .= "$('.columnsM input[type=checkbox]').prop('checked', true);";
        }
        return $this->render('recipient-columns', [
            'js' => $js,
            'grid' => $this->grid,
        ]);
    }

}

/**
1 - Код записи
2 - Дата создания
3 - Имя
4 - Фамилия
5 - Отчество
6 - Дата рождения
*/