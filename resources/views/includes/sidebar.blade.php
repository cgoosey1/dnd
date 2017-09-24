
<div class="col-sm-3 col-md-2 sidebar navmenu navmenu-default">
    @if (isset($details))
        <h4>{{ $details->name }}</h4>
        @if ($details instanceof \App\Location && $locations->count())
            <a class="navmenu-brand nav-sidebar" href="#" style="margin:0;padding-left:0;">Locations</a>

            <ul class="nav navmenu-nav nav-sidebar">
                @foreach($locations as $location)
                    <li>
                        <a href="/location/{{ $location->id }}">{{ $location->name }}</a>
                    </li>
                @endforeach
            </ul>
        @endif
        @if ($details Instanceof \App\Location)
            @php ($buildings = $details->buildings)
            @if ($buildings->count())
            <a class="navmenu-brand nav-sidebar" href="#" style="margin:0;padding-left:0;">Buildings</a>

            <ul class="nav navmenu-nav nav-sidebar">
                @foreach($buildings as $building)
                    <li>
                        <a href="/building/{{ $building->id }}">{{ $building->name }}</a>
                    </li>
                @endforeach
            </ul>
            @endif
        @endif
    @endif

    @if (isset($quests))
        <a class="navmenu-brand nav-sidebar" href="#" style="margin:0;padding-left:0;">Quests</a>
        <ul class="nav navmenu-nav nav-sidebar">
            @foreach($quests as $quest)
                <li>
                    <a href="/quest/{{ $quest->id }}">{{ $quest->name }}</a>
                </li>
            @endforeach
        </ul>
    @endif
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
