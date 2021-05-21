<?php

namespace frontend\controllers;

use frontend\models\RequestLog;
use Yii;
use yii\web\Controller;

/**
 * Site controller
 */
class BaseController extends Controller {
    /**
     * @var mixed
     */
    private $requestBody;
    /**
     * @var mixed
     */
    private $logId;

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [];
    }

    /**
     * @throws \yii\web\BadRequestHttpException
     * @throws \yii\mongodb\Exception
     */
    public function beforeAction($action): bool
    {
        Yii::$app->controller->enableCsrfValidation = false;

        $requestBody = $this->getRequestBody();

        $logData = [
            'raw_request_headers' => json_encode(Yii::$app->request->headers->toArray()),
            'raw_request_body' => $requestBody ? json_encode($requestBody) : json_encode($_REQUEST),
            'path' => Yii::$app->request->pathInfo
        ];

        if (isset($requestBody['order_id'])) {
            $logData['order_id'] = $requestBody['order_id'];
        }

        $this->logId = RequestLog::add($logData);

        return parent::beforeAction($action);
    }

    protected function getRequestBody() {
        return Yii::$app->request->post();
    }
}
