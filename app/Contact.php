<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{belongsToMany, hasMany};

class Contact extends Model
{
    protected string $table = 'contact';

    protected array $fillable = ['email', 'profile_image'];

    public function addTelephoneNumber(TelephoneNumber $number): void
    {
        $this->telephoneNumbers()->save($number);
    }

    public function updateTels(Contact $contact, array $numbers): void
    {
        if(!empty($numbers)){
            foreach($this->telephoneNumbers as $number){
                $number->delete();
            }
            $this->addTel($contact, $numbers);
        }
    }

    public function addTel(Contact $contact, $tels = null): void
    {
        if (!empty($tels)) {
            foreach ($tels as $value) {
                $contact->addTelephoneNumber(new TelephoneNumber(['number' => $value]));
            }
        }
    }

    public function tags(): belongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function telephoneNumbers(): hasMany
    {
        return $this->hasMany(TelephoneNumber::class);
    }

    public static function generateUniqueImageName(): string
    {
        return md5(uniqid());
    }

    public function scopeGetContacts($query): Collection
    {
        return $query->leftJoin('telephone_number', 'telephone_number.contact_id', '=', 'contact.id')
            ->select('contact.id', 'contact.profile_image', 'contact.email')
            ->groupBy('contact.id')
            ->orderBy('contact.id', 'desc')
            ->get();
    }

    public function getTelephoneNumbers(): string
    {
        return $this->telephoneNumbers->implode('number',', ');
    }

    public function getTags(): string
    {
        return $this->tags->implode('name',', ');
    }

    public function scopeSort($query, $column, $sort): Collection
    {
        return $query->orderBy($column, $sort)->get();
    }
}
