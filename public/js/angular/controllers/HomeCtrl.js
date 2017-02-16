// define angular module/app
angular.module('dnd.controllers', ['dnd.services', 'ui.bootstrap']);

angular.module('dnd.controllers').controller("HomeCtrl", function($scope, $http, $uibModal) {
    var vm = this;

    $scope.spellModal = function(scope) {
        var modal = $uibModal.open({
            templateUrl: '/js/angular/templates/spell.html',
            scope: scope
        });
    };
});