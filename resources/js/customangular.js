/* 
 * Author: Komal Kapadi
 * Date  : 4th Dec 2017
 * Custom angular file 
 */
/* JavaScript Document */
app = angular.module('inventoryApp', ['ui.router']);

/* To change the interolate provider need to change it's originonal brackets.*/
app.config(['$interpolateProvider', function($interpolateProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
}]);
app.directive('defaultPagination', function() {
    return {
        restrict: 'E',
        scope: {
            paginate: '=',
            currentpage: '=',
            range: '=',
            like: '&'
        },
        templateUrl: BASEURL + '/resources/views/pagination.html'
    };
});

/* paginator (client side) */
// app.service('Paginator', function() {
//     this.page = 0; /* current page */
//     this.rowsPerPage = 10; /* default rows per page */
//     this.itemCount = 0; /* count of total items */
//     this.currentRecord = 0; /* count of current records */
//     this.setPage = function(page) { /* to set page */
//         if (page > this.pageCount()) {
//             return;
//         }
//         this.page = page;
//     };
//     this.nextPage = function() { /* for next age click */
//         if (this.isLastPage()) {
//             return;
//         }
//         this.page++;
//     };
//     this.perviousPage = function() { /* for previous page click */
//         if (this.isFirstPage()) {
//             return;
//         }
//         this.page--;
//     };
//     this.firstPage = function() { /* to go on first page */
//         this.page = 0;
//     };
//     this.lastPage = function() { /* to go on last page */
//         this.page = this.pageCount() - 1;
//     };
//     this.isFirstPage = function() { /* check if it's first page */
//         return this.page == 0;
//     };
//     this.isLastPage = function() { /* check if it's last page */
//         return this.page == this.pageCount() - 1;
//     };
//     this.pageCount = function() { /* count total number of pages */
//         return Math.ceil(parseInt(this.itemCount) / parseInt(this.rowsPerPage));
//     };
// });