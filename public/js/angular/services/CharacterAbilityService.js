angular.module('dnd.controllers').factory('CharacterAbilityService', function() {
    var service = { scope: {} };

    service.abilities = ['Strength', 'Dexterity', 'Constitution', 'Wisdom', 'Intelligence', 'Charisma'];


    /**
     * To generate stats we roll 4d6 and remove the lowest number, this function does this 6 times to generate 6 stat
     * rolls
     */
    service.scope.rollDice = function() {
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

            rolls.push({value: (total - lowestRoll), ability: ''});
        }

        service.scope.abilityRolls = rolls;
    };
    
    return service;
});