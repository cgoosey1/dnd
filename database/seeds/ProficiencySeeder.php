<?php

use App\Proficiency;
use Illuminate\Database\Seeder;

class ProficiencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->proficiencies as $proficiency) {
            Proficiency::create(['name' => $proficiency]);
        }
    }

    protected $proficiencies = [
        'Light Armor',
        'Medium Armor',
        'Shields',
        'Simple Weapons',
        'Martial Weapons',
        'Longbow',
        'Longsword',
        'Shortsword',
        'Shortbow',
        'Battleaxe',
        'Handaxe',
        'Throwing Hammer',
        'Warhammer',
        'Smith\'s Tools',
        'Brewer\'s Supplies',
        'Mason\'s Tools',
        'Rapiers',
        'Hand Crossbows'
    ];
}