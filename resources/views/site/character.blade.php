@extends('layouts.default')
@section('controller', 'CharacterCtrl')

@section('head')
    @parent
    <link href="/css/character.css" rel="stylesheet">
    <script src="/js/angular/controllers/CharacterCtrl.js"></script>
@stop

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

        Players Name: <input type="text" ng-model="character.playerName"><br>
        Characters Name: <input type="text" ng-model="character.name"><br>
        Race: <select ng-model="raceId" ng-change="updateRace()">
            <option ng-repeat="race in races" value="@{{ race.id }}">@{{ race.name }}</option>
        </select><br>
        <div ng-show="subRaces">
            Sub Race: <select ng-model="subRaceId" ng-change="updateSubRace()" >
                <option ng-repeat="race in subRaces" value="@{{ race.id }}">@{{ race.name }}</option>
            </select><br>
        </div>
        Class: <select ng-model="classId" ng-change="updateClass()">
            <option ng-repeat="class in classes" value="@{{ class.id }}">@{{ class.name }}</option>
        </select><br>
        <div ng-show="classId">
            Level: <select ng-model="level" ng-change="updateLevel()">
                <option ng-repeat="number in levels" ng-value="number" >@{{ number }}</option>
            </select><br>
        </div>
        Alignment: <select ng-model="character.alignment">
            <option ng-repeat="alignment in alignments" value="@{{ alignment }}">@{{ alignment }}</option>
        </select><br>


        <div ng-show="options.length">
            Options<br>
            <div ng-repeat="(index, choice) in options">
                @{{ choice.details }}:<br>
                <span ng-repeat="(optionIndex, option) in choice.options">
                    @{{ option }} <input type="radio" ng-change="updateOptions()" ng-value="optionIndex" name="option@{{ index }}" ng-model="options[index].value"><br>
                </span><br><br>
            </div>
        </div>
        <div ng-show="class.skills">
            Skill choices (choose @{{ class.skillsAllowed }}):<br>
            <span ng-repeat="(index, skill) in class.skills">
                 <input type="checkbox" ng-disabled="skillDisabled(skill)" ng-click="updateSkill(skill)" ng-value="skill" name="selectedSkills[]"> @{{ skill }}<br>
            </span>
        </div>

        <button ng-click="rollDice()">Roll Dice</button>
        <div ng-repeat="roll in abilityRolls track by $index">
            <select ng-model="abilityRolls[$index].ability" ng-change="updateAbilities()">
                <option ng-repeat="(index, ability) in abilities" value="@{{ ability }}" >@{{ ability + (getAbilityScoreIncrease(ability)? ' (+' + getAbilityScoreIncrease(ability) + ')' : '') }}</option>
            </select>
            : <input type="number" ng-value="roll.value" ng-model="abilityRolls[$index].value" ng-change="updateAbilities()"> (@{{ (abilityRolls[$index].value > 11? '+' : '') + getAbilityModifier(abilityRolls[$index].value) }})
        </div>
        <br><br>



        <form class="charsheet">
            <header>
                <section class="charname">
                    <label for="charname">Character Name</label><input ng-model="character.name" />
                </section>
                <section class="misc">
                    <ul>
                        <li>
                            <label for="classlevel">Class & Level</label><input ng-value="character.class.id? getName(classes, character.class.id) + ' Lvl ' + character.class.level : ''"/>
                        </li>
                        <li>
                            <label for="background">Background</label><input name="background" />
                        </li>
                        <li>
                            <label for="playername">Player Name</label><input ng-model="character.playerName">
                        </li>
                        <li>
                            <label for="race">Race</label><input ng-value="character.race.id? getName(races, character.race.id) + (character.race.subRaceId? ' (' + getName(subRaces, character.race.subRaceId) + ')' : '') : ''" />
                        </li>
                        <li>
                            <label for="alignment">Alignment</label><input name="alignment" ng-model="character.alignment" />
                        </li>
                        <li>
                            <label for="experiencepoints">Experience Points</label><input name="experiencepoints" />
                        </li>
                    </ul>
                </section>
            </header>
            <main>
                <section>
                    <section class="attributes">
                        <div class="scores">
                            <ul>
                                <li ng-repeat="ability in abilities">
                                    <div class="score">
                                        <label for="@{{ ability }}score">@{{ ability }}</label><input name="@{{ ability }}score" ng-model="character[ability.toLowerCase()]" class="stat"/>
                                    </div>
                                    <div class="modifier">
                                        <input name="@{{ ability }}mod" ng-value="(character[ability.toLowerCase()] > 11? '+' : '') + getAbilityModifier(character[ability.toLowerCase()])" class="statmod"/>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="attr-applications">
                            <div class="inspiration box">
                                <div class="label-container">
                                    <label for="inspiration">Inspiration</label>
                                </div>
                                <input name="inspiration" type="checkbox" />
                            </div>
                            <div class="proficiencybonus box">
                                <div class="label-container">
                                    <label for="proficiencybonus">Proficiency Bonus</label>
                                </div>
                                <input name="proficiencybonus" ng-model="character.proficiencyBonus" />
                            </div>
                            <div class="saves list-section box">
                                <ul>
                                    <li ng-repeat="ability in abilities">
                                        <label for="@{{ ability }}-save">@{{ ability }}</label>
                                        <input name="@{{ ability }}-save" type="text" ng-value="getSavingThrowModifier(ability)" />
                                        <input name="@{{ ability }}-save-prof" type="checkbox" ng-checked="character.savingThrowProficiencies.indexOf(ability) > -1" />
                                    </li>
                                </ul>
                                <div class="label">
                                    Saving Throws
                                </div>
                            </div>
                            <div class="skills list-section box">
                                <ul>
                                    <li ng-repeat="skill in skills">
                                        <label for="@{{ skill.name }}">@{{ skill.name }} <span class="skill">(@{{ shortAbilities[skill.ability] }})</span></label>
                                        <input name="@{{ skill.name }}" ng-value="getSkillModifier(skill)" type="text" />
                                        <input name="@{{ skill.name }}-prof" type="checkbox" ng-checked="character.proficientSkills.indexOf(skill.name) > -1" />
                                    </li>
                                </ul>
                                <div class="label">
                                    Skills
                                </div>
                            </div>
                        </div>
                    </section>
                    <div class="passive-perception box">
                        <div class="label-container">
                            <label for="passiveperception">Passive Wisdom (Perception)</label>
                        </div>
                        <input name="passiveperception" ng-value="getPassivePerception()" />
                    </div>
                    <div class="otherprofs box textblock">
                        <label for="otherprofs">Other Proficiencies and Languages</label>
                        <textarea name="otherprofs">@{{ getProficienciesString() }}</textarea>
                    </div>
                </section>
                <section>
                    <section class="combat">
                        <div class="armorclass">
                            <div>
                                <label for="ac">Armor Class</label><input name="ac" ng-model="character.ac" type="text" />
                            </div>
                        </div>
                        <div class="initiative">
                            <div>
                                <label for="initiative">Initiative</label><input name="initiative" ng-value="(character['dexterity'] > 11? '+' : '') + getAbilityModifier(character['dexterity'])" type="text" />
                            </div>
                        </div>
                        <div class="speed">
                            <div>
                                <label for="speed">Speed</label><input name="speed" ng-model="character.speed" type="text" />
                            </div>
                        </div>
                        <div class="hp">
                            <div class="regular">
                                <div class="max">
                                    <label for="maxhp">Hit Point Maximum</label><input name="maxhp" ng-model="character.hpMax" type="text" />
                                </div>
                                <div class="current">
                                    <label for="currenthp">Current Hit Points</label><input name="currenthp" type="text" />
                                </div>
                            </div>
                            <div class="temporary">
                                <label for="temphp">Temporary Hit Points</label><input name="temphp" type="text" />
                            </div>
                        </div>
                        <div class="hitdice">
                            <div>
                                <div class="total">
                                    <label onclick="totalhd_clicked()" for="totalhd">Total</label><input name="totalhd" type="text" />
                                </div>
                                <div class="remaining">
                                    <label for="remaininghd">Hit Dice</label><input name="remaininghd" ng-value="getHitDice()" type="text" />
                                </div>
                            </div>
                        </div>
                        <div class="deathsaves">
                            <div>
                                <div class="label">
                                    <label>Death Saves</label>
                                </div>
                                <div class="marks">
                                    <div class="deathsuccesses">
                                        <label>Successes</label>
                                        <div class="bubbles">
                                            <input name="deathsuccess1" type="checkbox" />
                                            <input name="deathsuccess2" type="checkbox" />
                                            <input name="deathsuccess3" type="checkbox" />
                                        </div>
                                    </div>
                                    <div class="deathfails">
                                        <label>Failures</label>
                                        <div class="bubbles">
                                            <input name="deathfail1" type="checkbox" />
                                            <input name="deathfail2" type="checkbox" />
                                            <input name="deathfail3" type="checkbox" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="attacksandspellcasting">
                        <div>
                            <label>Attacks & Spellcasting</label>
                            <table>
                                <thead>
                                <tr>
                                    <th>
                                        Name
                                    </th>
                                    <th>
                                        Atk Bonus
                                    </th>
                                    <th>
                                        Damage/Type
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <input name="atkname1" type="text" />
                                    </td>
                                    <td>
                                        <input name="atkbonus1" type="text" />
                                    </td>
                                    <td>
                                        <input name="atkdamage1" type="text" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input name="atkname2" type="text" />
                                    </td>
                                    <td>
                                        <input name="atkbonus2" type="text" />
                                    </td>
                                    <td>
                                        <input name="atkdamage2" type="text" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input name="atkname3" type="text" />
                                    </td>
                                    <td>
                                        <input name="atkbonus3" type="text" />
                                    </td>
                                    <td>
                                        <input name="atkdamage3" type="text" />
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <textarea></textarea>
                        </div>
                    </section>
                    <section class="equipment">
                        <div>
                            <label>Equipment</label>
                            <div class="money">
                                <ul>
                                    <li>
                                        <label for="cp">cp</label><input name="cp" />
                                    </li>
                                    <li>
                                        <label for="sp">sp</label><input name="sp" />
                                    </li>
                                    <li>
                                        <label for="ep">ep</label><input name="ep" />
                                    </li>
                                    <li>
                                        <label for="gp">gp</label><input name="gp" />
                                    </li>
                                    <li>
                                        <label for="pp">pp</label><input name="pp" />
                                    </li>
                                </ul>
                            </div>
                            <textarea placeholder="Equipment list here"></textarea>
                        </div>
                    </section>
                </section>
                <section>
                    <section class="flavor">
                        <div class="personality">
                            <label for="personality">Personality</label><textarea name="personality"></textarea>
                        </div>
                        <div class="ideals">
                            <label for="ideals">Ideals</label><textarea name="ideals"></textarea>
                        </div>
                        <div class="bonds">
                            <label for="bonds">Bonds</label><textarea name="bonds"></textarea>
                        </div>
                        <div class="flaws">
                            <label for="flaws">Flaws</label><textarea name="flaws"></textarea>
                        </div>
                    </section>
                    <section class="features">
                        <div>
                            <label for="features">Features & Traits</label>
                            <textarea name="features">@{{ getFeatureString() }}</textarea>
                        </div>
                    </section>
                </section>
            </main>
        </form>

    </div>
@stop