<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model 
{
     /**
     * @var string
     */
    protected $table = 'contact';

    /**
     * @var array
     */
    protected $fillable = ['email', 'profile_image'];
    
    public function addTelephoneNumber(TelephoneNumber $number): void
    {
        $this->telephoneNumbers()->save($number);
    }
    
    private function deleteTels(array $ids): void 
    {
        $this->telephoneNumbers()->whereNotIn('id', $ids)->delete();
    }
    
    public function updateTels(array $numbers): void
    {
        if(!empty($numbers)){
            foreach($numbers as $k=>$v){
                $telephoneNumber = TelephoneNumber::findOrFail($k);
                $this->telephoneNumbers()->where('id',$telephoneNumber->id)->update(['number' => $v]); 
                $ids[] = [$telephoneNumber->id];
            }
            $this->deleteTels($ids);    
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function tags()
    {      
        return $this->belongsToMany(Tag::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function telephoneNumbers()
    {      
        return $this->hasMany(TelephoneNumber::class);
    }
}