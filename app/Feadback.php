<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feadback extends Model
{

    protected $fillable = [
        "not","commant","title","comand_num","is_private","exp_date_start","exp_date_fin"];

    /**
     * Get the user that owns the feadback.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
