// define angular module/app
angular.module('dnd.controllers', ['dnd.services', 'ui.bootstrap']);

angular.module('dnd.controllers').controller("CharacterCtrl", function($scope) {
    var vm = this;
    var data = {
        races: [
            {
                id: 1,
                name: 'Dwarf',
                abilityScoreIncrease: {constitution: 2},
                age: "Dwarves mature at the same rate as humans, but they're considered young until they reach the age of 50. On average, they live about 350 years.",
                alignment: "Most dwarves are lawful, believing firmly in the benefits of a well-ordered society. They tend toward good as well, with a strong sense of fair play and a belief that everyone deserves to share in the benefits of a just order.",
                size: "Dwarves stand between 4 and 5 feet tall and average about 150 pounds. Your size is Medium.",
                speed: 25,
                proficiencies: ['Battleaxe', 'Handaxe', 'Throwing Hammer', 'Warhammer'],
                languages: ['Common', 'Dwarvish'],
                subRaces: [
                    {
                        id: 2,
                        name: 'Hill Dwarf',
                        abilityScoreIncrease: {wisdom: 1},
                        proficiencies: ['Battleaxe', 'Handaxe', 'Throwing Hammer', 'Warhammer'],
                        traits: [
                            {
                                id: 7,
                                name: 'Dwarven Toughness',
                                details: "Your hit point maximum increases by 1, and it increases by 1 every time you gain a level.",
                                showInFeatures: 0
                            }
                        ]
                    },
                    {
                        id: 3,
                        name: 'Mountain Dwarf',
                        proficiencies: ['Light Armor', 'Medium Armor'],
                        abilityScoreIncrease: {strength: 2},
                        traits: [
                            {
                                id: 8,
                                name: 'Dwarven Armor Training',
                                details: "You have proficiency with light and medium armor.",
                                showInFeatures: 0,
                            }
                        ]
                    }
                ],
                traits: [
                    {
                        id: 1,
                        name: 'Dwarven Toughness',
                        details: "Speed is not reduced by wearing heavy armor",
                        showInFeatures: 1
                    },
                    {
                        id: 2,
                        name: 'Darkvision',
                        showInFeatures: 1,
                        details: "Accustomed to life underground, you have superior vision in dark and dim conditions. You can see in dim light within 60 feet of you as if it were bright light, and in darkness as if it were dim light. You can't discern color in darkness, only shades of gray."
                    },
                    {
                        id: 3,
                        name: 'Dwarven Resilience',
                        showInFeatures: 1,
                        details: "You have advantage on saving throws against poison, and you have resistance against poison damage."
                    },
                    {
                        id: 4,
                        name: 'Dwarven Combat Training',
                        showInFeatures: 0,
                        details: "You have proficiency with the battleaxe, handaxe, throwing hammer, and warhammer.",
                    },
                    {
                        id: 5,
                        name: 'Tool Proficiency',
                        showInFeatures: 0,
                        details: "You gain proficiency with the artisan's tools of your choice: smith's tools, brewer's supplies, or mason's tools."
                    },
                    {
                        id: 6,
                        name: 'Stonecunning',
                        showInFeatures: 1,
                        details: "Whenever you make an Intelligence (History) check related to the origin of stonework, you are considered proficient in the History skill and add double your proficiency bonus to the check, instead of your normal proficiency bonus."
                    }

                ],
                options: [
                    {
                        details: 'You gain proficiency with the artisan\'s tools of your choice',
                        options: ['Smith\'s Tools', 'Brewer\'s Supplies', 'Mason\'s Tools'],
                        key: 'proficiencies'
                    }
                ]
            },
            {
                id: 4,
                name: 'Elf',
                abilityScoreIncrease: {dexterity: 2},
                age: "Although elves reach physical maturity at about the same age as humans, the elven understanding of adulthood goes beyond physical growth to encompass worldly experience. An elf typically claims adulthood and an adult name around the age of 100 and can live to be 750 years old.",
                alignment: "Elves love freedom , variety, and selfexpression, so they lean strongly toward the gentler aspects of chaos. They value and protect others' freedom as well as their own, and they are more often good than not.The drow are an exception; their exile into the Underdark has made them vicious and dangerous. Drow are more often evil than not.",
                size: "Elves range from under 5 to over 6 feet tall and have slender builds. Your size is Medium.",
                speed: 30,
                languages: ['Common', 'Elvish'],
                proficiencies: [],
                subRaces: [
                    {
                        id: 5,
                        name: 'High Elf',
                        abilityScoreIncrease: {intelligence: 1},
                        proficiencies: ['Longsword', 'Shortsword', 'Shortbow', 'Longbow'],
                        traits: [
                            {
                                id: 12,
                                name: 'Elf Weapon Training',
                                details: "You have proficiency with the longsword, shortsword, shortbow, and longbow.",
                                showInFeatures: 0,
                            },
                            {
                                id: 13,
                                name: 'Cantrip',
                                details: "You know one cantrip of your choice from the wizard spell list. Intelligence is your spellcasting ability for it.",
                                showInFeatures: 0
                            },
                            {
                                id: 14,
                                name: 'Extra Language',
                                details: "You can speak, read, and write one extra language of your choice.",
                                showInFeatures: 0
                            }
                        ],
                        options: [
                            {
                                details: 'You know one cantrip of your choice from the wizard spell list. Intelligence is your spellcasting ability for it',
                                options: ["Acid Splash", "Blade Ward", "Chill Touch", "Dancing Lights", "Fire Bolt", "Friends", "Light", "Mage Hand", "Mending", "Message", "Minor Illusion", "Poison Spray", "Prestidigitation", "Ray of Frost", "Shocking Grasp", "True Strike"],
                                key: 'spells.cantrips'
                            },
                            {
                                details: 'You can speak, read, and write one extra language of your choice',
                                options: ["Common", "Dwarvish", "Elvish", "Giant", "Gnomish", "Goblin", "Halfling", "Orc", "Abyssal", "Celestial", "Deep Speech", "Draconic", "Infernal", "Aquan", "Auran", "Ignan", "Terran", "Sylvan", "Undercommon"],
                                key: 'languages'
                            }
                        ]
                    },
                    {
                        id: 6,
                        name: 'Wood Elf',
                        abilityScoreIncrease: {wisdom: 1},
                        proficiencies: ['Longsword', 'Shortsword', 'Shortbow', 'Longbow'],
                        traits: [
                            {
                                id: 12,
                                name: 'Elf Weapon Training',
                                details: "You have proficiency with the longsword, shortsword, shortbow, and longbow.",
                                showInFeatures: 0
                            },
                            {
                                id: 15,
                                name: 'Fleet of Foot',
                                details: "Your base walking speed increases to 35 feet.",
                                showInFeatures: 0,
                                attributes: {
                                    speed: 35
                                }
                            },
                            {
                                id: 16,
                                name: 'Mask of the Wild',
                                details: "You can attempt to hide even when you are only lightly obscured by foliage, heavy rain, falling snow, mist, and other natural phenomena.",
                                showInFeatures: 1
                            }
                        ]
                    },
                    {
                        id: 7,
                        name: 'Dark Elf (Drow)',
                        abilityScoreIncrease: {charisma: 1},
                        proficiencies: ['Rapiers', 'Shortsword', 'Hand Crossbows'],
                        traits: [
                            {
                                id: 17,
                                name: 'Superior Darkvision',
                                details: "Your darkvision has a radius of 120 feet.",
                                showInFeatures: 1
                            },
                            {
                                id: 18,
                                name: 'Sunlight Sensitivity',
                                details: "You have disadvantage on attack rolls and on Wisdom (Perception) checks that rely on sight when you, the target of your attack, or whatever you are trying to perceive is in direct sunlight.",
                                showInFeatures: 1
                            },
                            {
                                id: 19,
                                name: 'Drow Magic',
                                details: "You know the dancing lights cantrip. When you reach 3rd level, you can cast the faerie fire spell once per day. When you reach 5th level, you can also cast the darkness spell once per day. Charisma is your spellcasting ability for these spells.",
                                showInFeatures: 1,
                                attributes: {
                                    spells: {
                                        cantrips: ['Dancing Lights']
                                    }
                                }
                            },
                            {
                                id: 20,
                                name: 'Drow Weapon Training',
                                details: "You have proficiency with rapiers, shortswords, and hand crossbows.",
                                showInFeatures: 0
                            }
                        ]
                    }
                ],
                traits: [
                    {
                        id: 2,
                        name: 'Darkvision',
                        showInFeatures: 1,
                        details: "You have superior vision in dark and dim conditions. You can see in dim light within 60 feet of you as if it were bright light, and in darkness as if it were dim light. You can't discern color in darkness, only shades of gray."
                    },
                    {
                        id: 9,
                        name: 'Keen Senses',
                        showInFeatures: 0,
                        details: "You have proficiency in the Perception skill.",
                        attributes: {
                            skills: {proficiencies: ['perception']}
                        }
                    },
                    {
                        id: 10,
                        name: 'Fey Ancestry',
                        showInFeatures: 1,
                        details: "You have advantage on saving throws against being charmed, and magic can't put you to sleep."
                    },
                    {
                        id: 11,
                        name: 'Trance',
                        showInFeatures: 0,
                        details: "Elves don't need to sleep. Instead, they meditate deeply, remaining semiconscious, for 4 hours a day. (The Common word for such meditation is 'trance.') While meditating, you can dream after a fashion; such dreams are actually mental exercises that have become reflexive through years of practice. After resting in this way, you gain the same benefit that a human does from 8 hours of sleep."
                    }

                ]
            }
        ],
        classes: [
            {
                id: 1,
                name: 'Barbarian',
                hitDice: '12',
                quickBuild: "You can make a barbarian quickly by following these suggestions. First, put your highest ability score in Strength, followed by Constitution. Second, choose the outlander background.",
                proficiencies: ['Light Armor', 'Medium Armor', 'Shields', 'Simple Weapons', 'Martial Weapons'],
                savingThrowProficiencies: ['Strength', 'Constitution'],
                skillsAllowed: 2,
                skills: ['Animal Handling', 'Athletics', 'Intimidation', 'Nature', 'Perception', 'Survival'],
                selectedSkills: [],
                options: [
                    {
                        details: 'Chose a weapon',
                        options: ['Greataxe', 'Any Martial Weapon'],
                        key: 'weapons'
                    },
                    {
                        details: 'Chose a weapon',
                        options: ['Two Hand Axes', 'Any Simple Weapon'],
                        key: 'weapons'
                    }
                ],
                features: [],
                levels: {
                    1: {
                        attributes: {
                            proficiencyBonus: 2,
                            rages: 2,
                            rageDamage: 2
                        },
                        features: [
                            {
                                id: 21,
                                name: 'Rage',
                                showInFeatures: 0,
                                details: "In battle, you fight with primal ferocity. On your turn, you can enter a rage as a bonus action. While raging, you gain the following benefits if you aren't wearing heavy armor: You have advantage on Strength checks and Strength saving throws. When you make a melee weapon attack using Strength, you gain a bonus to the damage roll that increases as you gain levels as a barbarian, as shown in the Rage Damage column of the Barbarian table. You have resistance to bludgeoning, piercing, and slashing damage. If you are able to cast spells, you can't cast them or concentrate on them while raging. Your rage lasts for 1 minute. It ends early if you are knocked unconscious or if your turn ends and you haven't attacked a hostile creature since your last turn or taken damage since then. You can also end your rage on your turn as a bonus action. Once you have raged the number of times shown for your barbarian level in the Rages column of the Barbarian table, you must finish a long rest before you can rage again."
                            },
                            {
                                id: 22,
                                name: 'Unarmored Defence',
                                showInFeatures: 1,
                                details: "While you are not wearing any armor, your Armor Class equals 10 + your Dexterity modifier + your Constitution modifier. You can use a shield and still gain this benefit."
                            }
                        ]
                    },
                    2: {
                        features: [
                            {
                                id: 23,
                                name: 'Reckless Attack',
                                showInFeatures: 1,
                                details: "Starting at 2nd level, you can throw aside all concern for defense to attack with fierce desperation. When you make your first attack on your turn, you can decide to attack recklessly. Doing so gives you advantage on melee weapon attack rolls using Strength during this turn, but attack rolls against you have advantage until your next turn."
                            },
                            {
                                id: 24,
                                name: 'Danger Sense',
                                showInFeatures: 1,
                                details: "At 2nd level, you gain an uncanny sense of when things nearby aren't as they should be, giving you an edge when you dodge away from danger. You have advantage on Dexterity saving throws against effects that you can see, such as traps and spells. To gain this benefit, you can't be blinded, deafened, or incapacitated."
                            }
                        ]
                    },
                    3: {
                        attributes: {
                            rages: 3
                        }
                    }
                },
                archetype: [
                    {
                        name: 'Path of the Berserker',
                        description: "For some barbarians, rage is a means to an end-—that end being violence. The Path of the Berserker is a path of untrammeled fury, slick with blood. As you enter the berserker's rage, you thrill in the chaos of battle, heedless of your own health or well-being.",
                        level: {
                            3: {
                                attributes: {
                                    features: [
                                        {
                                            id: 25,
                                            name: 'Frenzy',
                                            showInFeatures: 1,
                                            details: "Starting when you choose this path at 3rd level, you can go into a frenzy when you rage. If you do so, for the duration of your rage you can make a single melee weapon attack as a bonus action on each of your turns after this one. When your rage ends, you suffer one level of exhaustion."
                                        }
                                    ]
                                }
                            }
                        }
                    },
                    {
                        name: 'Path of the Totem Warrior',
                        description: "The Path of the Totem W arrior is a spiritual journey, as the barbarian accepts a spirit animal as guide, protector, and inspiration. In battle, your totem spirit fills you with supernatural might, adding magical fuel to your barbarian rage. Most barbarian tribes consider a totem animal to be kin to a particular clan. In such cases, it is unusual for an individual to have more than one totem animal spirit, though exceptions exist.",
                        level: {
                            3: {
                                attributes: {
                                    features: [
                                        {
                                            id: 26,
                                            name: 'Spirit Seeker',
                                            showInFeatures: 1,
                                            details: "Yours is a path that seeks attunement with the natural world, giving you a kinship with beasts. At 3rd level when you adopt this path, you gain the ability to cast the beast sense and speak with animals spells, but only as rituals."
                                        },
                                        {
                                            id: 27,
                                            name: 'Totem Spirit',
                                            showInFeatures: 0,
                                            details: "At 3rd level, when you adopt this path, you choose a totem spirit and gain its feature. You must make or acquire a physical totem object- an amulet or similar adornment—that incorporates fur or feathers, claws, teeth, or bones of the totem animal. At your option, you also gain minor physical attributes that are reminiscent of your totem spirit. For example, if you have a bear totem spirit, you might be unusually hairy and thickskinned, or if your totem is the eagle, your eyes turn bright yellow. Your totem animal might be an animal related to those listed here but more appropriate to your homeland. For example, you could choose a hawk or vulture in place of an eagle. Bear. While raging, you have resistance to all damage except psychic damage. The spirit of the bear makes you tough enough to stand up to any punishment. Eagle. While you're raging and aren’t wearing heavy armor, other creatures have disadvantage on opportunity attack rolls against you, and you can use the Dash action as a bonus action on your turn. The spirit of the eagle makes you into a predator who can weave through the fray with ease. Wolf, While you're raging, your friends have advantage on melee attack rolls against any creature within 5 feet of you that is hostile to you. The spirit of the wolf makes you a leader of hunters."
                                        },
                                    ]
                                }
                            }
                        }
                    },
                ],
                attributes: {
                    weapons: [
                        {
                            id: 0,
                            name: 'Javelins',
                            quantity: 4
                        }
                    ],
                    equipment: [
                        {
                            name: 'Explorer Pack'
                        }
                    ]
                }
            }
        ],
        levels: ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20"],
        abilities: ['Strength', 'Dexterity', 'Constitution', 'Wisdom', 'Intelligence', 'Charisma'],
        skills: [
            { name: "Acrobatics", ability: "dexterity" },
            { name: "Animal Handling", ability: "wisdom" },
            { name: "Arcana", ability: "intelligence" },
            { name: "Athletics", ability: "strength" },
            { name: "Deception", ability: "charisma" },
            { name: "History", ability: "intelligence" },
            { name: "Insight", ability: "wisdom" },
            { name: "Intimidation", ability: "charisma" },
            { name: "Investigation", ability: "intelligence" },
            { name: "Medicine", ability: "wisdom" },
            { name: "Nature", ability: "intelligence" },
            { name: "Perception", ability: "wisdom" },
            { name: "Performance", ability: "charisma" },
            { name: "Persuasion", ability: "charisma" },
            { name: "Religion", ability: "intelligence" },
            { name: "Sleight of Hand", ability: "dexterity" },
            { name: "Stealth", ability: "dexterity" },
            { name: "Survival", ability: "wisdom" }
        ],
        shortAbilities: {
            strength: 'Str',
            dexterity: 'Dex',
            constitution: 'Con',
            wisdom: 'Wis',
            intelligence: 'Int',
            charisma: 'Cha'
        },
        alignments: [
            "Lawful good",
            "Neutral good",
            "Chaotic good",
            "Lawful neutral",
            "True neutral",
            "Chaotic neutral",
            "Lawful evil",
            "Neutral evil",
            "Chaotic evil"
        ]
    };

    var loadData = function() {
        $scope.races = data.races;
        $scope.classes = data.classes;
        $scope.levels = data.levels;
        $scope.level = "1";
        $scope.abilities = data.abilities;
        $scope.options = [];
        $scope.skills = data.skills;
        $scope.shortAbilities = data.shortAbilities;
        $scope.alignments = data.alignments;
    };
    loadData();

    var getDataById = function (data, id) {
        var data;
        angular.forEach(data, function (value) {
            if (value.id == id) {
                data = value;
                return false;
            }
        });

        return data;
    };

    /**
     * To generate stats we roll 4d6 and remove the lowest number, this function does this 6 times to generate 6 stat
     * rolls
     */
    $scope.rollDice = function() {
        var rolls = [];
        for (var i = 0; i < 6; i++) {
            var lowestRoll = 6;
            var total = 0;
            for (var a = 0; a < 4; a++) {
                var roll = Math.round(Math.random() * 6);
                if (roll < lowestRoll) {
                    lowestRoll = roll;
                }
                total += roll;
            }

            rolls.push({value: (total - lowestRoll), ability: $scope.abilities[i]});
        }

        $scope.abilityRolls = rolls;
        $scope.updateAbilities();
    };

    $scope.skillDisabled = function(skill) {
        return $scope.character.proficientSkills.indexOf(skill) == -1
            && $scope.character.proficientSkills.length >= $scope.class.skillsAllowed;
    };


    $scope.getName = function(data, id) {
        return getDataById(data, id).name;
    };

    $scope.getFeatureString = function () {
        var featureString = '';
        $scope.character.features.forEach(function(feature) {
            featureString += feature.name + ' - ' + feature.details + "\n\n";
        });

        return featureString;
    };

    $scope.getProficienciesString = function () {
        var string = '';
        if ($scope.character.languages.length) {
            string += 'Languages: ' + $scope.character.languages.join(', ') + "\n\n"
        }
        if ($scope.character.proficiencies.length) {
            string += 'Proficiencies: ' + $scope.character.proficiencies.join(', ')
        }

        return string;
    };

    $scope.getPassivePerception = function () {
        return 10 + parseInt($scope.getSkillModifier({name: 'Perception', ability: 'wisdom'}));
    };

    $scope.getHitDice = function () {
        var classData = vm.getClass();

        if (classData) {
            return '1d' + vm.getClass().hitDice;
        }

        return '';
    };

    $scope.getAbilityScoreIncrease = function(ability) {
        ability = ability.toLowerCase();
        var race = vm.getRace();
        var subRace = vm.getSubRace();
        var value = 0;

        if (race && race.abilityScoreIncrease[ability]) {
            value += race.abilityScoreIncrease[ability];
        }

        if (subRace && subRace.abilityScoreIncrease[ability]) {
            value += subRace.abilityScoreIncrease[ability];
        }

        return value;
    };

    $scope.getAbilityModifier = function (value) {
        return Math.floor((value - 10) / 2);
    };

    $scope.getSavingThrowModifier = function (ability) {
        var value = $scope.getAbilityModifier($scope.character[ability.toLowerCase()]);

        if ($scope.character.savingThrowProficiencies.indexOf(ability) > -1) {
            value += $scope.character.proficiencyBonus;
        }

        return (value > 0? '+' : '') + value;
    };

    $scope.getSkillModifier = function (skill) {
        var value = $scope.getAbilityModifier($scope.character[skill.ability]);

        if ($scope.character.proficientSkills.indexOf(skill.name) > -1) {
            value += $scope.character.proficiencyBonus;
        }

        return (value > 0? '+' : '') + value;
    };

    $scope.updateRace = function () {
        $scope.character.race.id = $scope.raceId;
        var race = vm.getRace();
        $scope.character.race.subRaceId = 0;
        $scope.character.speed = race.speed;

        $scope.subRaces = getDataById(data.races, $scope.raceId).subRaces;
        vm.generateCharacter();
    };

    $scope.updateSubRace = function () {
        $scope.character.race.subRaceId = $scope.subRaceId;
        vm.generateCharacter();
    };

    $scope.updateClass = function () {
        $scope.character.class.id = $scope.classId;
        var classData = vm.getClass();

        $scope.class = {
            skills: classData.skills,
            skillsAllowed: classData.skillsAllowed,

        };
        $scope.class.skills = classData.skills;
        $scope.class.skillsAllowed = classData.skillsAllowed;

        $scope.character.savingThrowProficiencies = classData.savingThrowProficiencies;
        $scope.updateLevel();

        vm.generateCharacter();
    };

    $scope.updateLevel = function() {
        var classData = vm.getClass();
        $scope.character.class.level = $scope.level;
        angular.forEach(classData.levels, function (levelData, level) {
            if ($scope.level >= level) {
                angular.forEach(levelData.attributes, function (value, attribute) {
                    $scope.character[attribute] = value;
                });
            }
        });

        vm.generateCharacter();
    };

    $scope.updateAbilities = function () {
        $scope.abilityRolls.forEach(function (ability) {
            var type = ability.ability.toLowerCase();

            if (type) {
                var value = ability.value;
                value += $scope.getAbilityScoreIncrease(type);

                $scope.character[type] = value;
            }
        });
    };

    $scope.updateSkill = function(skill) {
        var index = $scope.character.proficientSkills.indexOf(skill);
        if (index > -1) {
            $scope.character.proficientSkills.splice(index, 1);
        }
        else if ($scope.character.proficientSkills.length < $scope.class.skillsAllowed) {
            $scope.character.proficientSkills.push(skill);
        }
    };

    vm.getRace = function () {
        if ($scope.character.race.id) {
            return getDataById($scope.races, $scope.character.race.id);
        }

        return null;
    };

    vm.getSubRace = function () {
        if ($scope.character.race.subRaceId) {
            return getDataById($scope.subRaces, $scope.character.race.subRaceId);
        }

        return null;
    };

    vm.getClass = function () {
        if ($scope.character.class.id) {
            return getDataById($scope.classes, $scope.character.class.id);
        }

        return null;
    };

    vm.generateCharacter = function () {
        vm.generateProficiencies();
        vm.generateLanguages();
        vm.generateFeatures();
        vm.generateOptions();
        $scope.updateOptions();
    };

    vm.generateProficiencies = function() {
        var proficiencies = [];
        var race = vm.getRace();
        var subRace = vm.getSubRace();
        var classData = vm.getClass();


        if (classData) {
            proficiencies = proficiencies.concat(classData.proficiencies);
        }
        if (race) {
            proficiencies = proficiencies.concat(race.proficiencies);
        }
        if (subRace) {
            proficiencies = proficiencies.concat(subRace.proficiencies);
        }

        $scope.character.proficiencies = proficiencies;
    };

    vm.generateLanguages = function () {
        var languages = [];
        var race = vm.getRace();

        if (race) {
            languages = languages.concat(race.languages);
        }

        $scope.character.languages = languages;
    };

    vm.generateFeatures = function () {
        var features = [];
        var race = vm.getRace();
        var subRace = vm.getSubRace();
        var classData = vm.getClass();

        if (race) {
            race.traits.forEach(function (trait) {
                if (trait.showInFeatures) {
                    features.push(trait);
                }
            });
        }

        if (subRace) {
            subRace.traits.forEach(function (trait) {
                if (trait.showInFeatures) {
                    features.push(trait);
                }
            });
        }

        if (classData && $scope.character.class.level) {
            angular.forEach(classData.levels, function (levelData, level) {
                if (level <= $scope.character.class.level) {
                    levelData.features.forEach(function(feature) {
                        if (feature.showInFeatures) {
                            features.push(feature);
                        }
                    });
                }
            });
        }

        $scope.character.features = features;
    };

    /* Todo: Handle spells key */
    $scope.updateOptions = function () {
        $scope.options.forEach(function (option) {
            if (option.value != undefined) {
                $scope.character[option.key] = $scope.character[option.key].concat([option.options[option.value]]);
            }
        });
    };

    vm.generateOptions = function () {
        var options = [];

        var race = vm.getRace();
        var subRace = vm.getSubRace();
        var classData = vm.getClass();

        if (race && race.options) {
            race.options.forEach(function (option) {
                option.value = vm.findOptionValue(option);
                options.push(option);
            })
        }

        if (subRace && subRace.options) {
            subRace.options.forEach(function (option) {
                option.value = vm.findOptionValue(option);
                options.push(option);
            })
        }

        if (classData && classData.options) {
            classData.options.forEach(function (option) {
                option.value = vm.findOptionValue(option);
                options.push(option);
            })
        }

        $scope.options = options;
    };

    vm.findOptionValue = function (option) {
        var value = null
        $scope.options.forEach(function (currentOption) {
            if (currentOption.details == option.details
                && JSON.stringify(currentOption.options) == JSON.stringify(option.options))
            {
                value = currentOption.value;
            }
        });

        return value;
    };


    // $scope.character = {
    //     name: '',
    //     race: {
    //         id: 0,
    //         name: '',
    //         subRace: {},
    //         traits: []
    //     },
    //     class: {
    //         id: 0,
    //         name: '',
    //         features: [],
    //         proficiencies: [],
    //         selectedSkills: []
    //     },
    //     level: 0,
    //     background: {
    //         id: 0,
    //         personalityTrait: 0,
    //         ideals: 0,
    //         bonds: 0,
    //         flaws: 0,
    //         equipment: [],
    //         features: []
    //     },
    //     playerName: '',
    //     alignment: '',
    //     strength: 0,
    //     dexterity: 0,
    //     constitution: 0,
    //     intelligence: 0,
    //     wisdom: 0,
    //     charisma: 0,
    //     proficiencyBonus: 0,
    //     savingThrowsProficiencies: [],
    //     skills: {
    //         strength: {
    //             athletics: 0
    //         },
    //         dexterity: {
    //             acrobatics: 0,
    //             sleightOfHand: 0,
    //             stealth: 0
    //         },
    //         intelligence: {
    //             arcana: 0,
    //             history: 0,
    //             investigation: 0,
    //             nature: 0,
    //             religion: 0
    //         },
    //         wisdom: {
    //             animalHandling: 0,
    //             insight: 0,
    //             medicine: 0,
    //             perception: 0,
    //             survival: 0
    //         },
    //         charisma: {
    //             deception: 0,
    //             intimidation: 0,
    //             perception: 0,
    //             persuasion: 0
    //         }
    //     },
    //     skillsProficiencies: [],
    //     ac: 0,
    //     speed: 0,
    //     hpMax: 0,
    //     hitDice: '',
    //     languages: [],
    //     proficiencies: [],
    //     weapons: [
    //         {
    //             id: 0,
    //             name: '',
    //             attackBonus: 0,
    //             damage: '',
    //             damageBonus: 0,
    //             damageType: '',
    //             special: ''
    //         }
    //     ],
    //     equipment: [
    //         {
    //             name: '',
    //             special: ''
    //         }
    //     ],
    //     traits: [],
    //     features: [],
    //     additionalFeatures: [],
    //     spells: {
    //         cantrips: []
    //     }
    // };
    $scope.character = {
        characterName: '',
        race: {
            id: 0,
            subRaceId: 0
        },
        class: {
            id: 0,
            level: 1,
            archetypeId: 0
        },
        background: {
            id: 0,
            personalityTrait: 0,
            ideals: 0,
            bonds: 0,
            flaws: 0
        },
        playerName: '',
        alignment: '',
        strength: 0,
        dexterity: 0,
        constitution: 0,
        intelligence: 0,
        wisdom: 0,
        charisma: 0,
        proficiencyBonus: 0,
        savingThrowProficiencies: [],
        proficientSkills: [],
        ac: 0,
        speed: 0,
        hpMax: 0,
        languages: [],
        proficiencies: [],
        weapons: [
            {
                id: 0,
                name: '',
                attackBonus: 0,
                damage: '',
                damageBonus: 0,
                damageType: '',
                special: ''
            }
        ],
        equipment: [
            {
                name: '',
                special: ''
            }
        ],
        features: [],
        'spells.cantrips': []
    };

    // $scope.raceId = 1;
    // $scope.classId = 1;
    // $scope.updateRace();
    // $scope.updateClass();
});