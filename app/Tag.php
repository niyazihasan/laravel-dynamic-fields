<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model 
{
    /**
     * @var string
     */
    protected $table = 'tag';

    /**
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function contacts()
    {      
        return $this->belongsToMany(Contact::class);
    }
}