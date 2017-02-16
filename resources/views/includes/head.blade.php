
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<meta name="description" content="">
<meta name="author" content="">

<title>Dashboard Template for Bootstrap</title>

<!-- Bootstrap core CSS -->
<link href="/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="/css/jasny-bootstrap.min.css">
<link rel="stylesheet" href="/css/bootstrap3-wysihtml5.min.css">

<!-- Custom styles for this template -->
<link href="/css/dashboard.css" rel="stylesheet">
<style>
    .bold {font-weight:700;}
    .search li {
        transition: background-color 0.3s ease;
        background-color: #fff;
    }

    .search li:hover {
        background-color: #eee;
        cursor: pointer;
    }

    .search-container {
        position: relative;
    }

    .search-list {
        transition: display 0.3s ease;
        position: absolute;
        top: 100%;
        left: 0;
        z-index: 1000;
        float: left;
        border: 1px solid #ddd;
        border-top:0;
    }
    .m-b-none {margin-bottom:0}
    .m-t-m {margin-top:15px}


    .dropdown-submenu {
        position: relative;
    }

    .sidebar .nav>li>a {
        padding-top: 0;
        padding-bottom: 0;
    }

    .dropdown-submenu>.dropdown-menu {
        top: 0;
        left: 100%;
        margin-top: -6px;
        margin-left: -1px;
        -webkit-border-radius: 0 6px 6px 6px;
        -moz-border-radius: 0 6px 6px;
        border-radius: 0 6px 6px 6px;
    }

    .dropdown-submenu:hover>.dropdown-menu {
        display: block;
    }

    .dropdown-submenu>a:after {
        display: block;
        content: " ";
        float: right;
        width: 0;
        height: 0;
        border-color: transparent;
        border-style: solid;
        border-width: 5px 0 5px 5px;
        border-left-color: #ccc;
        margin-top: 5px;
        margin-right: -10px;
    }

    .dropdown-submenu:hover>a:after {
        border-left-color: #fff;
    }

    .dropdown-submenu.pull-left {
        float: none;
    }

    .dropdown-submenu.pull-left>.dropdown-menu {
        left: -100%;
        margin-left: 10px;
        -webkit-border-radius: 6px 0 6px 6px;
        -moz-border-radius: 6px 0 6px 6px;
        border-radius: 6px 0 6px 6px;
    }
    .nav>li.dropdown>a {
        display: inline-block;
        padding-right: 5px;
    }
    .nav>li.dropdown>span.caret {
        height: 10px;
        cursor: pointer;
        vertical-align: -webkit-baseline-middle;
        margin-right: 15px;
    }
    .dropdown .multi-level {
        right: inherit;
    }
</style>

<script src="/js/jquery.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/jasny-bootstrap.min.js"></script>
<script src="/js/bootstrap3-wysihtml5.all.min.js"></script>
<script src="/js/angular.min.js"></script>
<script src="/js/ui-bootstrap-tpls-2.2.0.min.js"></script>
<script src="/js/angular/directives.js"></script>
<script src="/js/angular/controllers/HomeCtrl.js"></script>