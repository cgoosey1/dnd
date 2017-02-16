@extends('layouts.default')
@section('content')

    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <div class="row">
            <button type="button" class="btn btn-default btn-sm pull-right characterModalBtn" data-toggle="modal" data-target="#characterModal">
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span> Add Character
            </button>
            <button type="button" class="btn btn-default btn-sm pull-right" data-toggle="modal" data-target="#trapModal">
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span> Add Trap
            </button>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Notes</h3>
                    </div>
                    <div class="panel-body">
                        <textarea class="form-control" id="mainNotes" rows="7">{{ file_exists(storage_path() . '/notes.txt')? file_get_contents(storage_path() . '/notes.txt') : '' }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-9">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                        <span class="glyphicon glyphicon-pencil description-edit" aria-hidden="true"></span> Details</h3>
                    </div>
                    <form method="post" action="{{ Request::url() }}">
                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                    <div class="panel-body">
                        <div class="description">{!! $details->description !!}</div>
                        <div class="description-form">
                            <textarea name="description" class="form-control" id="description-textarea">{!! $details->description !!}</textarea>
                            <input type="submit" class="btn btn-default btn-xs pull-right" value="Save">
                        </div>
                    </div>
                    </form>
                </div>
            </div>

            @if ($screens->count())
                <div class="col-sm-3">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Screens</h3>
                        </div>
                        <div class="panel-body">
                            @foreach ($screens as $screen)
                                <span class="text-muted screen">{{ $screen->name }}</span>
                                <span class="glyphicon glyphicon-blackboard screen" data-id="{{ $screen->id }}" aria-hidden="true"></span><br>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            @if ($details->traps->count())
                <div class="col-sm-3" ng-controller="TrapCtrl">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Traps</h3>
                        </div>
                        <div class="panel-body">
                            @foreach ($details->traps as $trap)
                                <span class="text-muted screen">{{ $trap->name }}</span>
                                <a href="/trap/delete/{{ $trap->id }}"><span class="glyphicon glyphicon-remove pull-right" aria-hidden="true"></span></a>
                                <span class="glyphicon glyphicon-pencil pull-right" role="button" ng-click="editTrap({{ $trap->id }})" data-toggle="modal" data-target="#trapModal" aria-hidden="true"></span>
                                <br>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>

        @if ($details->people()->count())
        <div class="row">
            <div class="col-sm-9">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Associated People</h3>
                    </div>
                    <div class="panel-body">
                        @foreach ($details->people as $people)
                            <div class="row">
                                <div class="col-sm-12">
                                    <small><span class="glyphicon glyphicon-pencil character-edit" data-id="{{ $people->id }}"></span></small>
                                    <b id="characterName{{ $people->id }}">{{ $people->name }}</b> - (<span id="characterRace{{ $people->id }}">{{ ucfirst($people->race) }}</span>)<br>
                                    <span id="characterDescription{{ $people->id }}">{!! $people->description !!}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if ($details->monsters()->count())
            <div class="row">
                <div class="col-sm-9">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Associated Monsters</h3>
                        </div>
                        <div class="panel-body">
                            @foreach ($details->monsters as $monster)
                                @php ($class = $monster->classes)
                                <div class="row">
                                    <div class="col-sm-12">
                                        <b>{{ $monster->name }}</b> {{ $class->name != $monster->name? '(' . $class->name . ')' : '' }}
                                        <span class="glyphicon glyphicon-plus monsterExpand" aria-hidden="true" data-monster-id="{{ $monster->id }}"></span><br>
                                        <span>{!! $monster->description !!}</span>
                                        <div class="well hidden" id="monster{{ $monster->id }}">
                                            <label for="hpModifer" class="control-label"><b>HP:</b></label>
                                            <span id="hp{{ $monster->id }}">{{ $monster->hp }}</span>
                                            <span class="col-sm-3 input-group pull-right">
                                                <div class="input-group-addon">-</div>
                                                <input type="number" name="hpModifer" data-monster-id="{{ $monster->id }}" class="form-control input-sm hpModifer">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-default btn-sm hpReset" data-monster-id="{{ $monster->id }}">
                                                        <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
                                                    </button>
                                                </span>
                                            </span>
                                            <br>
                                            <b>Armour Class:</b> {{ $class->ac }}<br>
                                            <b>Speed:</b> {{ $class->speed }}ft<br>
                                            <div class="row">
                                                <div class="col-sm-2 bold">STR</div>
                                                <div class="col-sm-2 bold">DEX</div>
                                                <div class="col-sm-2 bold">CON</div>
                                                <div class="col-sm-2 bold">WIS</div>
                                                <div class="col-sm-2 bold">INT</div>
                                                <div class="col-sm-2 bold">CHA</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-2">{{ $class->str }} ({{ floor(($class->str - 10)/2) }})</div>
                                                <div class="col-sm-2">{{ $class->dex }} ({{ floor(($class->dex - 10)/2) }})</div>
                                                <div class="col-sm-2">{{ $class->con }} ({{ floor(($class->con - 10)/2) }})</div>
                                                <div class="col-sm-2">{{ $class->wis }} ({{ floor(($class->wis - 10)/2) }})</div>
                                                <div class="col-sm-2">{{ $class->int }} ({{ floor(($class->int - 10)/2) }})</div>
                                                <div class="col-sm-2">{{ $class->cha }} ({{ floor(($class->cha - 10)/2) }})</div>
                                            </div>
                                            {!! $class->skills? '<b>Skills: </b>' . $class->skills . '<br>' : '' !!}
                                            {!! $class->damageVulnerabilities? '<b>Damage Vulnerabilities: </b>' . $class->damageVulnerabilities . '<br>' : '' !!}
                                            {!! $class->damageResistances? '<b>Damage Resistances: </b>' . $class->damageResistances . '<br>' : '' !!}
                                            {!! $class->damageImmunities? '<b>Damage Immunities: </b>' . $class->damageImmunities . '<br>' : '' !!}
                                            {!! $class->damageImmunities? '<b>Damage Immunities: </b>' . $class->damageImmunities . '<br>' : '' !!}
                                            {!! $class->conditionImmunities? '<b>Conditional Immunities: </b>' . $class->conditionImmunities . '<br>' : '' !!}
                                            {!! $class->senses? '<b>Senses: </b>' . $class->senses . '<br>' : '' !!}
                                            {!! $class->languages? '<b>Languages: </b>' . $class->languages . '<br>' : '' !!}
                                            {!! $class->challenge? '<b>Challenge: </b>' . $class->challenge . '<br>' : '' !!}
                                            {!! $class->abilities? '<b>Abilities</b><br>' . nl2br($class->abilities) . '<br>' : '' !!}
                                            {!! $class->action? '<b>Actions</b><br>' . nl2br($class->action) . '<br>' : '' !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    @include('includes.cast')
    <script type="text/javascript">
    $(document).ready(function() {
        $('#mainNotes').keyup(function() {
            $.post('/notes', {'notes': $(this).val(), "_token": "{{ Session::token() }}"});
        });

        $('.screen').click(function () {
            $.get('/ajax/screen/' + $(this).data('id'), function (data) {
                selectMedia(data.audio, data.pic, data.title, data.html);
                loadMedia();
            });
        });

        $('.description-form').hide();
        $('.description-edit').click(function () {
            $('.description').toggle();
            $('.description-form').toggle();
        });
        $('#description-textarea').wysihtml5({toolbar: {
            "size": "sm" //Button to insert an image. Default true
        }});

        $('.character-edit').click(function() {
            var id = $(this).data('id');
            $('#characterId').val(id);
            $('#characterName').val($('#characterName' + id).text());
            $('#characterDescription').val($('#characterDescription' + id).html());
            $('#characterModal').modal('show')
        });
        $('.characterModalBtn').click(function() {
            $('#characterId').val('');
            $('#characterName').val('');
            $('#characterDescription').val('');
        });

        $('.monsterExpand').click(function() {
            var monsterId = $(this).data('monster-id');
            if ($(this).hasClass('glyphicon-plus')) {
                $(this).removeClass('glyphicon-plus');
                $(this).addClass('glyphicon-minus');
                $('#monster' + monsterId).removeClass('hidden');
            } else {
                $(this).removeClass('glyphicon-minus');
                $(this).addClass('glyphicon-plus');
                $('#monster' + monsterId).addClass('hidden');
            }
        });

        $('.hpModifer').keyup(function(e){
            if(e.keyCode == 13)
            {
                var monsterId = $(this).data('monster-id');
                var hp = $('#hp' + monsterId).text() - $(this).val();
                $(this).val('');
                $('#hp' + monsterId).html(hp);
                $.get('/monster/' + monsterId + '/hp/' + hp);
            }
        });
        $('.hpReset').click(function() {
            var monsterId = $(this).data('monster-id');
            $.getJSON('/monster/' + monsterId + '/hp/reset', function(data) {
                if (data.status == 'success') {
                    $('#hp' + monsterId).html(data.hp);
                }
            });
        });
    });
    </script>

    @include('modals.character')
    @include('modals.trap')
@stop