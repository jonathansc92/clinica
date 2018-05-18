<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest {

    public function all() {
        $data = parent::all();

        //question's field
        if (isset($data['inclusao'])) {
            $date = ($data['inclusao']) ? $data['inclusao'] : Carbon::today()->format('d/m/Y');
            $data['inclusao'] = Carbon::createFromFormat('d/m/Y', $date)
                    ->hour(0)->minute(0)->second(0)
                    ->toDateTimeString();
        }

        //question's field
        if (isset($data['publicacao'])) {
            $date = ($data['publicacao']) ? $data['publicacao'] : Carbon::today()->addWeek()->format('d/m/Y');
            $data['publicacao'] = Carbon::createFromFormat('d/m/Y', $date)
                    ->hour(0)->minute(0)->second(0)
                    ->toDateTimeString();
        }

        return $data;
    }

}
