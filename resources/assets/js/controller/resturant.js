/**
 * Created by JaskaranSingh on 04-10-2016.
 */
angular.module('rsw.controller', [])
    .controller('master', ['$scope', '$http', function($scope, $http){
        $http.get("./info.json").then(function(response) {
            $scope.resturant = response.data.records;
            $scope.resturants = response.data.records;
            $scope.resturantc = response.data.records;
        });
        $http.get("./review.json").then(function(response) {
            $scope.reviews = response.data.reviews;
            $scope.reviewss = response.data.reviews;
            $scope.reviewsc = response.data.reviews;
        });
        $scope.filterl=["Delhi","Rajpura","Chandigarh","Mohali"]
        $scope.filterc=["North Indian","South Indian","Chinese","Coffee"]
        $scope.updC= function() {
            $scope.form = {filterl : $scope.filterl[0].value};
        }
        $scope.updL= function() {
            $scope.form = {filterc : $scope.filterc[0].value};
        }
        $scope.onChangeFL = function()
        {
            $scope.filterTypeL=$scope.form.filterl
            $scope.filterTypeC=null
            angular.element(document.querySelector("#rest-list-f")).removeClass("offVal");
            angular.element(document.querySelector("#rest-list")).addClass("offVal");
            angular.element(document.querySelector("#rest-list-c")).addClass("offVal");
        }
        $scope.onChangeFC = function()
        {
            $scope.filterTypeC=$scope.form.filterc
            $scope.filterTypeL=null
            angular.element(document.querySelector("#rest-list-f")).addClass("offVal");
            angular.element(document.querySelector("#rest-list-c")).removeClass("offVal");
            angular.element(document.querySelector("#rest-list")).addClass("offVal");
        }
        $scope.user=[]
        $scope.form = {filterl : $scope.filterl[0].value};
        $scope.form = {filterc : $scope.filterc[0].value};
        $scope.empty=function () {
            $scope.user=[]
        }
        $scope.validate=function (userInfo) {
            $scope.user.push({
                Reviewer: userInfo.name,
                Comments: userInfo.gList,
                Date: "6th Oct, 2016",
                Rating: userInfo.rate
            });
            notifyBrowser("New Review Added By",userInfo.name);
        }
    }]);