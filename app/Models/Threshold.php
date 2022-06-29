<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Threshold extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'threshold';
    protected $fillable = [
        'stasiun_id',
        'rc_batasatas_suspect_kelembapan',
        'rc_batasbawah_suspect_kelembapan',
        'rc_batasatas_error_kelembapan',
        'rc_batasbawah_error_kelembapan',
        'rc_batasatas_suspect_suhu',
        'rc_batasbawah_suspect_suhu',
        'rc_batasatas_error_suhu',
        'rc_batasbawah_error_suhu',
        'rc_batasatas_suspect_tekanan',
        'rc_batasbawah_suspect_tekanan',
        'rc_batasatas_error_tekanan',
        'rc_batasbawah_error_tekanan',
        'sc_batasatas_suspect_kelembapan',
        'sc_batasbawah_suspect_kelembapan',
        'sc_batasatas_suspect_suhu',
        'sc_batasbawah_suspect_suhu',
        'sc_batasatas_suspect_tekanan',
        'sc_batasbawah_suspect_tekanan',
    ];
}
