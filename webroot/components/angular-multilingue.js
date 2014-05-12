angular.module( 'multilingue', [])
  .directive( 'multilingue', function( $timeout, $location) {
    return {
        restrict: 'E',
        link: function( scope, element, attrs){
          scope.$watch( attrs.model, function( newValue, oldValue){
            if( newValue) {
              console.log( newValue);
              for (var i=0; i < newValue.length; i++) {
                newValue[i]
              };
              
              return $(element).html( 'leches')
            }
          })
        }
    }
  });