<?php

namespace api\controllers\user;

use api\helpers\DateHelper;
use shop\entities\User\User;
use shop\helpers\UserHelper;
use yii\helpers\Url;
use yii\rest\Controller;

class ProfileController extends Controller
{
    /**
     * @SWG\Get(
     *     path="/user/profile",
     *     tags={"Profile"},
     *     description="Returns profile info",
     *     @SWG\Response(
     *         response=200,
     *         description="Success response",
     *         @SWG\Schema(ref="#/definitions/Profile")
     *     ),
     *     security={{"Bearer": {}, "OAuth2": {}}}
     * )
     */
    public function actionIndex(): User
    {
        return $this->serializeUser($this->findModel());
    }

    public function verbs(): array
    {
        return [
            'index' => ['get'],
        ];
    }

    private function findModel(): User
    {
        return User::findOne(\Yii::$app->user->id);
    }

    private function serializeUser(User $user): array
    {
        return [
            'id' => $user->id,
            'name' => $user->username,
            'email' => $user->email,
            'date' => [
                'created' => DateHelper::formatApi($user->created_at),
                'updated' => DateHelper::formatApi($user->updated_at),
            ],
            'status' => [
                'code' => $user->status,
                'name' => UserHelper::statusName($user->status),
            ],
        ];
    }
}

/**
 *  @SWG\Definition(
 *     definition="Profile",
 *     type="object",
 *     required={"id"},
 *     @SWG\Property(property="id", type="integer"),
 *     @SWG\Property(property="name", type="string"),
 *     @SWG\Property(property="email", type="string"),
 *     @SWG\Property(property="city", type="string"),
 *     @SWG\Property(property="role", type="string")
 * )
 */