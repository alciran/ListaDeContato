<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contact';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'international_phone'
    ];

    protected $attributes = [
        'international_phone' => false,
    ];

    public function getPhoneNumberFormatted(){
        if($this->international_phone)
            $phone = $this->phone; //internacional retorna sem mascara (verificar diferente para cada pais)            
        else{
            $phone = substr_replace( substr_replace(substr_replace($this->phone, '(', 0, 0), ')', 3, 0), ' ', 4, 0);
            strlen($phone) == 14 ? $phone = substr_replace($phone, '-', 10, 0) : $phone = substr_replace($phone, '-', 9, 0);
        }
        return $phone;
    }

}
