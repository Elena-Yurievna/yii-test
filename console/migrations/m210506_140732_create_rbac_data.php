<?php

use backend\models\User;
use yii\db\Migration;

/**
 * Class m210506_140732_create_rbac_data
 */
class m210506_140732_create_rbac_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        // Define permissions

        $viewComplaintsListPermission = $auth->createPermission('viewComplaintsList');
        $auth->add($viewComplaintsListPermission);

        $viewPostPermission = $auth->createPermission('viewPost');
        $auth->add($viewPostPermission);

        $deletePostPermission = $auth->createPermission('deletePost');
        $auth->add($deletePostPermission);

        $approvePostPermission = $auth->createPermission('approvePost');
        $auth->add($approvePostPermission);

        $viewUsersListPermission = $auth->createPermission('viewUsersList');
        $auth->add($viewUsersListPermission);

        $viewUserPermission = $auth->createPermission('viewUser');
        $auth->add($viewUserPermission);

        $deleteUserPermission = $auth->createPermission('deleteUser');
        $auth->add($deleteUserPermission);

        $updateUserPermission = $auth->createPermission('updateUser');
        $auth->add($updateUserPermission);

        // Define roles

        $providerRole = $auth->createRole('provider');
        $auth->add($providerRole);

        $customerRole = $auth->createRole('customer');
        $auth->add($customerRole);

        $adminRole = $auth->createRole('admin');
        $auth->add($adminRole);

        // Define roles - permissions relations

        $auth->addChild($providerRole, $viewComplaintsListPermission);
        $auth->addChild($providerRole, $viewPostPermission);
        $auth->addChild($providerRole, $deletePostPermission);
        $auth->addChild($providerRole, $approvePostPermission);
        $auth->addChild($providerRole, $viewUsersListPermission);
        $auth->addChild($providerRole, $viewUserPermission);

        $auth->addChild($adminRole, $providerRole);
        $auth->addChild($adminRole, $deleteUserPermission);
        $auth->addChild($adminRole, $updateUserPermission);

        $auth->addChild($customerRole, $viewComplaintsListPermission);
        $auth->addChild($customerRole, $viewPostPermission);
        $auth->addChild($customerRole, $deletePostPermission);
        $auth->addChild($customerRole, $approvePostPermission);
        $auth->addChild($customerRole, $viewUsersListPermission);
        $auth->addChild($customerRole, $viewUserPermission);

        // Create admin user
        $user = new User([
            'email' => 'admin@admin.com',
            'username' => 'Admin',
            'password_hash' => '$2y$13$P9.d7KUb8C6BHCvkdzMsrOi5U.vIAw01UmriB.34PiN50e8nTGFge',
        ]);
        $user->generateAuthKey();
        $user->save();

        // Add admin role to user
        $auth->assign($adminRole, $user->getId());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210506_140732_create_rbac_data cannot be reverted.\n";

        return false;
    }

    public function down()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();
    }
}
