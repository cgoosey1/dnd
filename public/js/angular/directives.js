angular.module('dnd.services', ['ui.bootstrap']);

angular.module('dnd.services').directive('ngSearch', function($http, $timeout, $uibModal) {
    return {
        restrict: 'AE',
        replace: 'true',
        scope: {
            action: '&searchAction'
        },
        templateUrl: '/js/angular/templates/search.html',
        link: function(scope, elem, attrs) {
            attrs.$observe('id', function(value) {
                scope.directiveId = value;
            });
            elem.find('#' + scope.directiveId + '-search-list').hide;

            scope.selectItem = function(item) {
                scope.item = item;
                scope.search.value = '';
                scope.search.oldValue = item.name;
                scope.search.id = item.id;
                scope.search.items = null;
                var action = scope.action();
                if (typeof action === "function") {
                    action(scope);
                }
                elem.find('.contact-list-search').focus();
            };

            scope.useCurrent = function() {
                scope.search.oldValue = scope.search.value;
                scope.search.id = scope.search.value;
                scope.search.items = null;
            };

            var inputChangedPromise;
            scope.inputChange = function() {
                if(inputChangedPromise){
                    $timeout.cancel(inputChangedPromise);
                }

                inputChangedPromise = $timeout(function() { search(scope); },500);
            }

            search = function(scope) {
                if (scope.search.value.length > 2 && scope.search.value != scope.search.oldValue)
                {
                    scope.search.id = scope.search.value;
                    $http.get('/search?keywords=' + encodeURI(scope.search.value))
                        .success(function (data, status, headers, config) {
                            scope.search.items = data;
                            elem.find('#' + scope.directiveId + '-search-list').show();
                        });
                }
            };
        }
    };
});