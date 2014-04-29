angular.module( 'multilingue', [])
  .directive( 'multilingue', function( $timeout, $location) {
    var ret = 'asdfs';
    return {
        restrict: 'A',
        replace: true,
        transclude: false,
        template: function( tElement, tAttrs) {
          return "element";
        }

    }
  });