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

    private function deleteTels(array $ids): void
    {
        $this->telephoneNumbers()->whereNotIn('id', $ids)->delete();
    }

    public function updateTels(array $numbers): void
    {
        if(!empty($numbers)){
            foreach($numbers as $k=>$v){
                $telephoneNumber = TelephoneNumber::findOrFail($k);
                $this->telephoneNumbers()->where('id', $telephoneNumber->id)->update(['number' => $v]);
                $ids[] = [$telephoneNumber->id];
            }
            $this->deleteTels($ids);
        }
    }

    public function addTel(Contact $contact, array $tels = null): void
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

    public function scopeGetContacts(): Collection
    {
        return $this::leftJoin('telephone_number', 'telephone_number.contact_id', '=', 'contact.id')
            ->select('contact.id', 'contact.profile_image', 'contact.email')
            ->groupBy('contact.id')
            ->orderBy('contact.id', 'desc')
            ->get();
    }
}
