<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.head')
</head>
<body ng-app="dnd.controllers" ng-controller="HomeCtrl">
<div class="container" style="padding-left: 0;padding-right:0;margin-right:0;">

        @include('includes.header')

    <div class="container-fluid">
        <div class="row">
            @include('includes.sidebar')

            @yield('content')

        </div>
    </div>
</div>
</body>
</html>