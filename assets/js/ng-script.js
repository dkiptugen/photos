    // create the module and name it pdsApp
    var pdsApp = angular.module('pdsApp', ['ngRoute']);

    // configure our routes
    pdsApp.config(function($routeProvider) {
        $routeProvider

            // route for the home page
            .when('/', {
                templateUrl : 'pages/home.html',
                controller  : 'mainController'
            })

            // route for the magazines page
            .when('/magazines', {
                templateUrl : 'pages/magazines.html',
                controller  : 'magazinesController'
            })

            // route for the single-magazine page
            .when('/single-magazine', {
                templateUrl : 'pages/single-magazine.html',
                controller  : 'singleMagazineController'
            })

            // route for the cart page
            .when('/cart', {
                templateUrl : 'pages/cart.html',
                controller  : 'cartController'
            })

            // route for the checkout page
            .when('/checkout', {
                templateUrl : 'pages/checkout.html',
                controller  : 'checkoutController'
            });

           
    });

    // create the controller and inject Angular's $scope
    pdsApp.controller('mainController', function($scope) {
       
    });

    pdsApp.controller('magazinesController', function($scope) {
       
    });

    pdsApp.controller('singleMagazineController', function($scope) {
       
    });

    pdsApp.controller('cartController', function($scope) {
       
    });

     pdsApp.controller('checkoutController', function($scope) {
       
    });