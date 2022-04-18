<?php
namespace App\Http\Services;
class ResponseServise
{
    private static function responsePrams(bool $status, $errors = [], $data = [])
    {
        return [
            'status' => $status,
            'errors' => (object)$errors,
            'data' => (object)$data,
        ];
    }

    public static function sendJsonResponse(bool $status, $code = 200, $errors = [], $data = [])
    {
        return response()->json(
            self::responsePrams($status, $errors, $data),
            $code
        );
    }

    public static function success($data = [])
    {
        return self::sendJsonResponse(true, 200, [], $data);
    }

    public static function notFound($data = [])
    {
        return self::sendJsonResponse(false, 404, ['не найдено'], []);
    }

    public static function ErrorApi()
    {
        return self::sendJsonResponse(false, 500, ['ошибка'], []);
    }
}
