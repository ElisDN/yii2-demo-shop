<?php

namespace backend\widgets\grid;

use shop\access\Rbac;
use Yii;
use yii\grid\DataColumn;
use yii\helpers\Html;
use yii\rbac\Item;

class RoleColumn extends DataColumn
{
    protected function renderDataCellContent($model, $key, $index): string
    {
        $roles = Yii::$app->authManager->getRolesByUser($model->id);
        return $roles === [] ? $this->grid->emptyCell : implode(', ', array_map(function (Item $role) {
            return $this->getRoleLabel($role);
        }, $roles));
    }

    private function getRoleLabel(Item $role): string
    {
        $class = $role->name == Rbac::ROLE_USER ? 'primary' : 'danger';
        return Html::tag('span', Html::encode($role->description), ['class' => 'label label-' . $class]);
    }
}