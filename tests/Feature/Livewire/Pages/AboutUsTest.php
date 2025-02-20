<?php

namespace Tests\Feature\Livewire\Pages;

use App\Livewire\Pages\AboutUs;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class AboutUsTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(AboutUs::class)
            ->assertStatus(200);
    }
}
