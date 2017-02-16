<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/location/1">D&D</a>
            <ul class="nav navbar-nav navbar-right">
                @foreach ($topLocations as $location)
                    @if (!$location->parent)
                        <li class="dropdown">
                            <a href="/location/{{ $location->id }}">{{ $location->name }}</a>
                            <span class="caret" style="color: #fff;" data-toggle="dropdown"></span>

                            <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                                {!! subMenuNewLevel($location->children) !!}
                            </ul>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ng-search id="headerSearch" search-action="spellModal" class="navbar-form navbar-right" />
        </div>
    </div>
</nav>