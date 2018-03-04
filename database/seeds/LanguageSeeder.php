<?php

use App\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->languages as $language) {
            Language::create(['name' => $language]);
        }
    }

    protected $languages = [
        "Abyssal",
        "Aquan",
        "Auran",
        "Celestial",
        "Common",
        "Deep Speech",
        "Draconic",
        "Dwarvish",
        "Elvish",
        "Giant",
        "Gnomish",
        "Goblin",
        "Halfling",
        "Ignan",
        "Infernal",
        "Orc",
        "Sylvan",
        "Terran",
        "Undercommon",
    ];
}