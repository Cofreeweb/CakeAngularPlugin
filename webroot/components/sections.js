/**
*  sections Module
*
* Description
*/

(function(){
  'use_strict';

  angular.module( 'sections', ['slugifier'])

  /**
   * SectionsCtrl
   */
    .controller( 'SectionsCtrl', ['$rootScope', '$scope', '$http', 'CKEDITOR_CONFIG',
      function( $rootScope, $scope, $http, CKEDITOR_CONFIG){

        $scope.sortableOptions = {
          stop: function () {

          }
        };

        $scope.editorOptions = {
            width: '100%',
            height: '400px',
            toolbar: CKEDITOR_CONFIG.toolbar
        };
      }
    ])


    /**
   * SectionAdd
   * @param  {[type]} $modal [description]
   * @return {[type]}        [description]
   */
    .directive( 'sectionAdd', ['$modal', function( $modal){
      return {
        restrict: 'A',
        link: function( scope, element, attrs){
          var ModalInstanceCtrl = function ($scope, $modalInstance) {
            $scope.menu = attrs.sectionAdd;
            $scope.ok = function () {
              $http.post( attrs.url, {id: attrs.confirmDelete}).success(function( data){
                $modalInstance.dismiss('cancel');
                angular.element( '#delete-block-' + attrs.confirmDelete).remove();
              })
            };

            $scope.cancel = function () {
              $modalInstance.dismiss('cancel');
            };
          };

          element.click(function(){
            $modal.open({
              templateUrl: '/angular/template?t=Section.sections/_admin_add',
              controller: ModalInstanceCtrl
            })
          })
        }
      }
    }])


  ;

})(window);