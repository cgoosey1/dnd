@extends('layouts.default')
@section('controller', 'CharacterCtrl')

@section('head')
    @parent
    <script src="/js/angular/controllers/CharacterCtrl.js"></script>
@stop

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        Players Name: <input type="text" ng-model="character.playerName"><br>
        Characters Name: <input type="text" ng-model="character.name"><br>
        Race: <select ng-model="raceId" ng-change="updateRace()">
            <option ng-repeat="race in races" value="@{{ race.id }}">@{{ race.name }}</option>
        </select><br>
        <div ng-show="character.race.subRaces">
        Sub Race: <select ng-model="character.race.subRaceId">
            <option ng-repeat="race in character.race.subRaces" value="@{{ race.id }}">@{{ race.name }}</option>
        </select><br>
        </div>
        Class: <select ng-model="classId" ng-change="updateClass()">
            <option ng-repeat="class in classes" value="@{{ class.id }}">@{{ class.name }}</option>
        </select><br>
        <div ng-show="character.class.equipmentChoices">
            Equipment choices:
            <div ng-repeat="(index, choice) in character.class.equipmentChoices">
                <span ng-repeat="(optionIndex, option) in choice.options">
                    @{{ option }} <input type="radio" ng-model="character.class.equipmentChoices[index].selected" ng-value="optionIndex" name="choice@{{ index }}">
                </span>
            </div>
        </div>
        <div ng-show="character.class.skills">
            Skill choices (choose @{{ character.class.skillCount }}):
            <span ng-repeat="(index, skill) in character.class.skills">
                @{{ skill }} <input type="checkbox" ng-model="character.class.selectedSkills[]" ng-value="skill" name="selectedSkills">
            </span>
        </div>


        <br><br><br>
        <textarea rows="20" cols="100">@{{ displayCharacter() }}</textarea>


    </div>
@stop