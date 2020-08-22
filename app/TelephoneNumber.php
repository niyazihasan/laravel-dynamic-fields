<?php

namespace App;

use Illuminate\Database\Eloquent\{Model,Relations\belongsTo};

class TelephoneNumber extends Model
{
    protected string $table = 'telephone_number';

    protected array $fillable = ['number', 'contact_id'];

    public function contact(): belongsTo
    {
        return $this->belongsTo(Contact::class);
    }
}
