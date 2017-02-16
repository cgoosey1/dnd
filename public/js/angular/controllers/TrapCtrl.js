angular.module('dnd.controllers').controller("TrapCtrl", function($scope, $http, $uibModal, TrapService) {
    var vm = this;

    $scope.trap = TrapService.getTrap();

    $scope.fillSpellId = function(scope) {
        $scope.trap.spellId = scope.search.id;
        scope.search.value = scope.search.oldValue;
    };

    $scope.editTrap = TrapService.editTrap;

    $scope.cleanForm = function() {
        $scope.trap = TrapService.baseTrap;
    };

    $scope.updateDC = function() {
        TrapService.updateDC($scope.trap);
    };

    $scope.$watch(TrapService.getTrap, function () {
        $scope.trap = TrapService.getTrap();
    })
});