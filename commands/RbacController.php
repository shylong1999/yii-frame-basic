<?php


namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit(){
        $auth = Yii::$app->authManager;
        $auth->removeAll();

        // add "createPost" permission
        $createPost = $auth->createPermission('createPost');
        $createPost->description = 'Create a post';
        $auth->add($createPost);

        // add "updatePost" permission
        $updatePost = $auth->createPermission('updatePost');
        $updatePost->description = 'Update post';
        $auth->add($updatePost);

        // add "user" role and give this role the "createPost" permission
        $user = $auth->createRole('user');
        $auth->add($user);
        $auth->addChild($user, $createPost);

        // add "admin" role and give this role the "updatePost" permission
        // as well as the permissions of the "user" role
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $updatePost);
        $auth->addChild($admin, $user);

        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
        $auth->assign($user, 2);
        $auth->assign($admin, 1);
    }
}