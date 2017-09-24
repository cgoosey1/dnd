// define angular module/app
angular.module('dnd.controllers', ['dnd.services', 'ui.bootstrap']);

angular.module('dnd.controllers').controller("HomeCtrl", function($scope, $http, $window, $uibModal) {
    var vm = this;

    $scope.searchAction = function(scope) {
        if (scope.item.type == 'Spell') {
            var modal = $uibModal.open({
                templateUrl: '/js/angular/templates/spell.html',
                scope: scope
            });
        }
        else if (scope.item.type == 'Location') {
            $window.location.href = '/location/' + scope.item.id;
        }
    };
});