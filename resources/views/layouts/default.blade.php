<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.head')
    @yield('head')
</head>
<body ng-app="dnd.controllers" ng-controller="@yield('controller', 'HomeCtrl')">
<div class="container" style="padding-left: 0;padding-right:0;margin-right:0;">

        @include('includes.header')

    <div class="container-fluid">
        <div class="row">
            @section('sidebar')
                @include('includes.sidebar')
            @show

            @yield('content')

        </div>
    </div>
</div>
</body>
</html>