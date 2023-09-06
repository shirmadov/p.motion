<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DataResource;
use App\Models\Data;
use Illuminate\Http\Request;

class DataController extends Controller
{
    private $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIyIiwianRpIjoiZGQwYTY0NzcyOTE5YTRmNzA1M2ZkOWU1NTAzYmZiNGFhOGViNzVjMDQyMjFkOTZjY2ZlYjFjYTQwZTE2NDkwYWYyZjkxZTBiNzE0ZGNmZWYiLCJpYXQiOjE2OTA5ODI2NjkuNTEwNjc4LCJuYmYiOjE2OTA5ODI2NjkuNTEwNjgsImV4cCI6MTcyMjYwNTA2OS41MDA1OTgsInN1YiI6IjEiLCJzY29wZXMiOltdfQ.sgcSo0dOtYaBdyMk9bi2Ufu9ufweGa4-h3ZoWr8VE9fDFn_eJIgEFU_fDa1Jt532C4N0ULDfcypK9MhP82NGzkQQ7rE0XOdMgYLIIghS6sourQqqCsJdu10-NWBqbUK8mBEV5iZRjxLzi0j7Hm46jy3et18YDxk9pfzQ6DLr6VcO4h5I5TS3qzXupTxHpCq1f6AaoYiEJkisNQdO5Omva56eDWv5q7M5zsX3Tx18NpjN5Dgbgo7fRhvw-CJbociXUMXFiE4kyCEjhv8FQcBv_7JR_4o8X5KQksaJ49bzKFjsMi7dnfNZ3Wz3GR6Mhynv1R5SNZaooBsz-Qc1X6JHqmveTKUoH6ucrdukzGxFSs6cjNo3umJMmlSxKQ6nkg6kSNbrNpYDm7cIHluwttJ2kWkfo2B0vTbtM0mYJ-7mjMThrGFC24wP8kZBayUggciATgN4GfR8x1sTMbA7PMAfnK_mZt8ldGFUKjS_dZqRdnDknUsGJKqaVmHPMZW6VXqMnRFgShVr-O34ByR8z5Y5-G_eaCP3Z8h2T2C5fPH-zHXMq2Gal6qefCF6Tykw7by1ZZwekdhUdUugShiAUOCySNjTR9dtDhWnjBplbaaVdF7F0md3kE383AH5co_zXlVlHZq19bGKOoiVkg0Oyiv_d34D-rffDzn_xKJJIdffl38';

    CONST URL = 'https://api.dev.quizplease.ru';

    public $data = [];

    public function index(Data $data)
    {
        try {
            $path = '/api/home-game/list';
            $headers = [
                'Content-Type: application/json',
                'Authorization:'.$this->token
            ];

            $response = $this->sendRequest( $path, $headers );


            if(!is_null($response)){
                $data->create($response['data']['data']);
            }
            $result = $data->getData();
            $this->data['data'] = DataResource::collection($result);
        }catch(\Exception $e){
            $this->data['data'] = $e;
        }

        return $this->data;
    }


    protected function sendRequest( $path, $headers )
    {
        $curl = curl_init();
        curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl,CURLOPT_URL, self::URL.$path);
        curl_setopt($curl,CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl,CURLOPT_HEADER, false);
        curl_setopt($curl,CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($curl,CURLOPT_SSL_VERIFYHOST, 2);
        $output = curl_exec($curl);
        $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        return json_decode($output, true);
    }
}
