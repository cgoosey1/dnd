
<div class="col-sm-3 col-md-2 sidebar navmenu navmenu-default">
        <a class="navmenu-brand nav-sidebar" href="#" style="margin:0;padding-left:0;">Locations</a>

        <ul class="nav navmenu-nav nav-sidebar">
            @foreach($locations as $location)
                <li class="dropdown open keep-open">
                    <a href="/location/{{ $location->id }}" class="dropdown-toggle" data-toggle="dropdown">{{ $location->name }} <b class="caret"></b></a>
                    <ul class="dropdown-menu navmenu-nav" role="menu">
                        @foreach($location->buildings as $building)
                            <li class="{{ (Request::segment(1) == 'building' && Request::segment(2) == $building->id)? 'active' : ''}}">
                                <a href="/building/{{ $building->id }}">{{ $building->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>

    <a class="navmenu-brand nav-sidebar" href="#" style="margin:0;padding-left:0;">Quests</a>
        <ul class="nav navmenu-nav nav-sidebar">
            @foreach($quests as $quest)
                <li>
                    <a href="/quest/{{ $quest->id }}">{{ $quest->name }}</a>
                    {{--<ul class="dropdown-menu navmenu-nav" role="menu">--}}
                        {{--@foreach($quest->buildings as $building)--}}
                            {{--<li class="{{ (Request::segment(1) == 'building' && Request::segment(2) == $building->id)? 'active' : ''}}">--}}
                                {{--<a href="/building/{{ $building->id }}">{{ $building->name }}</a>--}}
                            {{--</li>--}}
                        {{--@endforeach--}}
                    {{--</ul>--}}
                </li>
            @endforeach
        </ul>
</div>
<script>
    $(document).ready(function() {
        $('.keep-open').on({
            "shown.bs.dropdown": function() { $(this).attr('closable', false); },
            //"click":             function() { }, // For some reason a click() is sent when Bootstrap tries and fails hide.bs.dropdown
            "hide.bs.dropdown":  function() { return $(this).attr('closable') == 'true'; }
        });

        $('.keep-open').children().first().on({
            "click": function() {
                $(this).parent().attr('closable', true );
            }
        })
    });
</script>
