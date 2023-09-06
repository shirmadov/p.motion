<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    use HasFactory;

    protected $table = 'data';
    protected $fillable = [
        'data_id',
        'title',
        'number',
        'duration',
        'price',
        'city',
    ];

    public function getData()
    {
        return Data::all();
    }

    public function create($response)
    {
        foreach ($response as $res) {
            $data = new Data;
            $data->data_id = $res['id'];
            $data->title = $res['title'];
            $data->number = '#' . $res['id'];
            $data->duration = $res['duration'];
            $data->price = $res['price'] * 100;
            $data->city = $res['cities'][0]['slug'];
            $data->save();
        }
    }

}
