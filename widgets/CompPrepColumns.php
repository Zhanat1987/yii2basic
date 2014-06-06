<?php

namespace app\widgets;

use Yii;
use yii\base\Widget;

class CompPrepColumns extends Widget
{

    public $grid;

    public function run()
    {
        /**
         * в пар-х виджета передаются страница (какие поля можно настраивать в модальном окне)
         * ID-ники grid'ов КК и ПК (после настройки и сохранения полей будет происходить событие изменения
         * в фильтре grid'а и соответственно будет обновляться страница с новыми значениями полей)
         * ajax-запрос на изменение полей будет уходить на '/user/deny/comp-prep-columns'
         */
        $js = '';
        $module = Yii::$app->controller->module->id;
        if (($columns = unserialize(Yii::$app->getRequest()->getCookies()->getValue('columns'))) !== false) {
            if ($module != 'bloodstorage') {
                $js .= "$('.bs').remove();";
            }
            switch ($module) {
                case 'bloodstorage' :
                    $columns = isset($columns['kkpk']['bloodstorage']) ?
                        (strpos($columns['kkpk']['bloodstorage'], ',') !== false ?
                        explode(',', $columns['kkpk']['bloodstorage']) :
                            [$columns['kkpk']['bloodstorage']]) : null;
                    break;
                case 'recipient' :
                    $columns = isset($columns['kkpk']['recipient']) ?
                        (strpos($columns['kkpk']['recipient'], ',') !== false ?
                            explode(',', $columns['kkpk']['recipient']) :
                            [$columns['kkpk']['recipient']]) : null;
                    break;
            }
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
        return $this->render('comp-prep-columns', [
            'js' => $js,
            'module' => $module,
            'grid' => $this->grid,
        ]);
    }

}

/**
кк
1 - Код записи
2 - Дата регистрации
3 - Наименование
4 - Группа крови
5 - Объём
6 - Регистрационный №
7 - Дата заготовки
8 - Срок годности
9 - Отправлен (бк)
10 - Дата отправки
11 - Отделение
12 - Номер накладной или акта
13 - № истории болезни
14 - Донор
15 - фио реципиента (бк)
пк
16 - Код записи
17 - Дата регистрации
18 - Наименование
19 - Группа крови
20 - Объём
21 - Серия
22 - Дата заготовки
23 - Срок годности
24 - Отправлен (бк)
25 - Дата отправки
26 - Отделение
27 - Номер накладной или акта
28 - № истории болезни
29 - фио реципиента (бк)

30 - резус-фактор (кк)
31 - резус-фактор (пк)
*/