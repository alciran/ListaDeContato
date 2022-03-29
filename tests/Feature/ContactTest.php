<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Contact;

class ContactTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function testDefaultValueInternationalPhoneAttrbute(){
        $contact = new Contact;
        $this->assertFalse($contact->international_phone);
    }

    public function testPhoneNumberIsInternational()
    {
        $contact = new Contact;
        $contact->international_phone = true;
        $this->assertTrue($contact->international_phone);
    }

    public function testGetPhoneNumberFormatted()
    {
        $contact = new Contact;
        //telefone com 8 digitos
        $contact->phone = '4299999999';
        $this->assertEquals($contact->getPhoneNumberFormatted(), '(42) 9999-9999'); 
        
        //telefone com 9 digitos
        $contact->phone = '42999999999';
        $this->assertEquals($contact->getPhoneNumberFormatted(), '(42) 99999-9999');
    }

    public function testAttributesContact()
    {
        $contact = new Contact;
        $contact->name = 'Fulano Beltrano';
        $contact->phone = '42999999999';
        $contact->email = 'fulano@email.com';

        $this->assertSame('Fulano Beltrano', $contact->name);
        $this->assertSame('42999999999', $contact->phone);
        $this->assertSame('fulano@email.com', $contact->email);
    }

}
