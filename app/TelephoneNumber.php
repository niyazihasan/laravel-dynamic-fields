<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TelephoneNumber extends Model 
{
    /**
     * @var string
     */
    protected $table = 'telephone_number';

    /**
     * @var array
     */
    protected $fillable = ['number', 'contact_id'];
    

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function contact()
    {      
        return $this->belongsTo(Contact::class);
    }
}