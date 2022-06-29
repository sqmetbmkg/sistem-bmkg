<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InputData extends Model
{
    use HasFactory;

    protected $table = 'data';
    public $timestamps = false;
    protected $fillable = [
        'stasiun_id',
        'waktu',
        'data_suhu',
        'data_kelembapan',
        'data_tekanan',
        'hasil_rc_suhu',
        'hasil_rc_kelembapan',
        'hasil_rc_tekanan',
        'hasil_sc_suhu',
        'hasil_sc_kelembapan',
        'hasil_sc_tekanan',
    ];
}
