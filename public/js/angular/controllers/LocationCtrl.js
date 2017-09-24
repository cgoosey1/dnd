angular.module('dnd.controllers').controller("LocationCtrl", function($scope, $http, $uibModal, TrapService) {
    var vm = this;

    $scope.fillParent = function(scope) {
        $scope.parent = scope.search.id;
        scope.search.value = scope.search.oldValue;
    };
});