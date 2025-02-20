<?php

namespace Tests\Feature\Livewire\Pages;

use App\Livewire\Pages\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ContactTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(Contact::class)
            ->assertStatus(200);
    }
}
