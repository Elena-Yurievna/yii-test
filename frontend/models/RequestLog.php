<?php

namespace frontend\models;

use Yii;

use yii\mongodb\{Collection, Query, ActiveRecord};

/**
 * This is the model class for request logs table.
 *
 * @property string $_id
 * @property string $sid
 * @property string $path
 * @property string $url
 * @property string $order_id
 * @property string $created_date
 * @property string $created_time
 * @property integer $created_timestamp
 * @property string $raw_request_headers
 * @property string $raw_request_body
 * @property string $response_headers
 * @property string $response_body
 */
class RequestLog extends ActiveRecord {

    /**
     * @return array list of attribute names.
     */
    public function attributes() {
        return [
            '_id',
            'sid',
            'path',
            'url',
            'order_id',
            'raw_request_headers',
            'raw_request_body',
            'response_headers',
            'response_body',
            'created_date',
            'created_time',
            'created_timestamp'
        ];
    }

    private static function secureSensitiveData(&$requestBody) {

        $fieldsToHide = ['currentPassword', 'newPassword', 'newPasswordRepeat'];

        if (isset($requestBody['raw_request_body']) && !empty($requestBody['raw_request_body'])) {
            if (!is_array($requestBody['raw_request_body'])) {
                $rawRequestBody = json_decode($requestBody['raw_request_body'], true);
                if (is_array($rawRequestBody)) {
                    self::hideFields($rawRequestBody, $fieldsToHide);
                }
                $requestBody['raw_request_body'] = json_encode($rawRequestBody);
            }
        }
    }

    // create method hideFields with parameters: &$requestBody and $fieldsToHide
    private static function hideFields(&$rawRequestBody, $fieldsToHide)
    {
        foreach ($rawRequestBody as $field => $value) {
            // check the value of the array or not, if so then call it again
            if (is_array($value)) {
                self::hideFields($rawRequestBody[$field], $fieldsToHide);
            } else {
                if (in_array($field, $fieldsToHide)) {
                    $rawRequestBody[$field] = str_repeat('*', strlen($value));
                }
            }
        }
    }

    /**
     * @throws \yii\mongodb\Exception
     */
    public static function add($data): \MongoDB\BSON\ObjectID
    {
        /** @var Collection $collection */

        $collection = Yii::$app->mongodb->getCollection(self::collectionName());
        $dateTime = new \DateTime('now', new \DateTimeZone('UTC'));

        $data['created_date'] = $dateTime->format('Y-m-d');
        $data['created_time'] = $dateTime->format('H:i:s:v');
        $data['created_timestamp'] = $dateTime->getTimestamp();

        foreach ($data as $key => $value) {
            if (!in_array($key, (new RequestLog)->attributes())) {
                unset($data[$key]);
            }
        }

        self::secureSensitiveData($data);

        return $collection->insert($data);
    }

    public static function edit(array $condition, array $data): bool
    {
        $query = new Query();

        $query->from(self::collectionName());
        foreach ($condition as $column => $value) {
            $query->andWhere([$column => $value]);
        }
        $result = $query->one();

        if (!empty($result)) {
            foreach ($data as $key => $value) {
                if (!in_array($key, (new RequestLog)->attributes())) {
                    unset($data[$key]);
                }
            }

            self::secureSensitiveData($data);

            $collection = Yii::$app->mongodb->getCollection(self::collectionName());
            $collection->update(['_id' => $result['_id']], $data);
        }

        return true;
    }
}
