<?php

namespace App;

use Illuminate\Database\Eloquent\{Model, Relations\belongsToMany};

class Tag extends Model
{
    protected string $table = 'tag';

    protected array $fillable = ['name'];

    public function contacts(): belongsToMany
    {
        return $this->belongsToMany(Contact::class);
    }
}
