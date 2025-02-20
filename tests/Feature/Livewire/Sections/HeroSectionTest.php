<?php

namespace Tests\Feature\Livewire\Sections;

use App\Livewire\Sections\HeroSection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class HeroSectionTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(HeroSection::class)
            ->assertStatus(200);
    }
}
