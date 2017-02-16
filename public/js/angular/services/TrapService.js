angular.module('dnd.controllers').factory('TrapService', function(traps) {
    var service = {};

    service.baseTrap = {
        id: null,
        name: '',
        type: "1",
        difficulty: "1",
        characterLevel: "1",
        trigger: '',
        description: null,
        detectDC: 10,
        disarmDC: 10,
        saveDC: 10,
        attackMod: '+3',
        damage: '1d10',
        complex: 0,
        template: 0,
        initiative: null,
        spellId: null,
        spellcasterLevel: null
    };

    service.trap = service.baseTrap;

    service.getTrap = function() {
        return service.trap;
    };

    service.editTrap = function(id) {
        if (traps[id] != undefined) {
            service.trap = traps[id];
        }
    };

    service.updateDC = function(trap) {
        service.trap = trap;
        var mod = parseInt(trap.characterLevel);
        if (trap.difficulty == 1) {
            service.trap.detectDC = 9 + mod;
            service.trap.disarmDC = 9 + mod;
            service.trap.saveDC = 9 + mod;
            service.trap.attackMod = '+' + (2 + mod);
        }
        else if (trap.difficulty == 2) {
            service.trap.detectDC = 11 + mod;
            service.trap.disarmDC = 11 + mod;
            service.trap.saveDC = 11 + mod;
            service.trap.attackMod = '+' + (5 + mod);
        }
        else if (trap.difficulty == 3) {
            service.trap.detectDC = 15 + mod;
            service.trap.disarmDC = 15 + mod;
            service.trap.saveDC = 15 + mod;
            service.trap.attackMod = '+' + (8 + mod);
        }

        updateDamage();

        return service.trap;
    };

     function updateDamage() {
        if (service.trap.difficulty == 1) {
            if (service.trap.characterLevel == 1) {
                service.trap.damage = '1d10';
            }
            else if (service.trap.characterLevel == 2) {
                service.trap.damage = '2d10';
            }
            else if (service.trap.characterLevel == 3) {
                service.trap.damage = '4d10';
            }
            else {
                service.trap.damage = '10d10';
            }
        }
        else if (service.trap.difficulty == 2) {
            if (service.trap.characterLevel == 1) {
                service.trap.damage = '2d10';
            }
            else if (service.trap.characterLevel == 2) {
                service.trap.damage = '4d10';
            }
            else if (service.trap.characterLevel == 3) {
                service.trap.damage = '10d10';
            }
            else {
                service.trap.damage = '18d10';
            }
        }
        else if (service.trap.difficulty == 3) {
            if (service.trap.characterLevel == 1) {
                service.trap.damage = '4d10';
            }
            else if (service.trap.characterLevel == 2) {
                service.trap.damage = '10d10';
            }
            else if (service.trap.characterLevel == 3) {
                service.trap.damage = '18d10';
            }
            else {
                service.trap.damage = '24d10';
            }
        }
    }
    
    return service;
});