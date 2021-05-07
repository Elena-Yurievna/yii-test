<?php
namespace frontend\models;

use common\models\User;
use Yii;
use yii\base\BaseObject;
use yii\base\Model;
use yii\helpers\ArrayHelper;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;

    const ROLE_PROVIDER = 'provider';
    const ROLE_CUSTOMER = 'customer';

    public $roles;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['roles', 'safe'],
            ['roles', 'required'],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();

        $user->roles = $this->roles;
        $auth = Yii::$app->authManager;

        if ($user->save() && $this->sendEmail($user)) {
            if(!empty($this->roles)){
                if (is_array($user->roles)) {
                    foreach ($user->roles as $roleName) {
                        if ($role = $auth->getRole($roleName)) {
                            $userId = $user->id;
                            $auth->assign($role, $userId);
                        }
                    }
                }
            }
        }
        return $user;
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }

    /**
     * @return array
     */
    public function getRolesDropdown()
    {
        return [
            self::ROLE_PROVIDER => 'Provider',
            self::ROLE_CUSTOMER => 'Customer',
        ];
    }
}
