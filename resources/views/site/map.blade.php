@extends('layouts.default')

@section('sidebar')
    <div class="col-sm-1 sidebar">
        {{--<select id="markerMode">--}}
            {{--<option value="add">Add</option>--}}
            {{--<option value="delete">Delete</option>--}}
        {{--</select>--}}

        <select id="markerSelect">
            <option value=""></option>
            <option value="star" selected>Star</option>
            <option value="empty-star">Empty Star</option>
            <option value="remove">Cross</option>
            <option value="map-marker">Marker</option>
            <option value="tint">Water</option>
            <option value="fire">Fire</option>
            <option value="leaf">Leaf</option>
            <option value="flash">Flash</option>
            <option value="tower">Tower</option>
            <option value="tent">Tent</option>
            <option value="tree-conifer">Tree 1</option>
            <option value="tree-deciduous">Tree 2</option>
            <option value="question-sign">Question</option>
            <option value="exclamation-sign">Exclamation</option>
        </select>
        <input type="text" id="markerText">
        <input type="color" id="markerColor">
        <select id="markerSize">
            <option value="12">12px</option>
            <option value="14" selected>14px</option>
            <option value="16">16px</option>
            <option value="18">18px</option>
            <option value="20">20px</option>
            <option value="22">22px</option>
            <option value="24">24px</option>
        </select>
        <input type="checkbox" id="markerBold"> <b>B</b>
        <input type="checkbox" id="markerItalic"> <i>I</i>
        <input type="checkbox" id="markerUnderline"> <u>U</u><br>
        <button id="markerCast">Cast</button>
    </div>
@stop

@section('content')

    <div class="col-sm-12 main">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Map</h3>
                    </div>
                    <div class="panel-body" id="mapPanelBody">
                        <div id="mapHolder" style="position: relative; width: 1024px; height: 768px; margin:auto;">
                            <img src="/dnd/pics/37.jpg" id="map" style="position: absolute; left: 0px; top: 0px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('includes.cast')
    <script type="text/javascript">
        var markers = [
            @foreach($markers as $marker)
                {
                    'id': {{ $marker->id }},
                    'x': {{ $marker->x }},
                    'y': {{ $marker->y }},
                    'text': "{!! $marker->text !!}",
                    'size': {{ $marker->size }},
                    'marker': "{{ $marker->marker }}",
                    'color': "{{ $marker->color }}",
                    'bold': {{ $marker->bold }},
                    'italic': {{ $marker->italic }},
                    'underline': {{ $marker->underline }}
                }{{ !$loop->last? ',' : '' }}
            @endforeach
        ];

    $(document).ready(function() {
        var add = true;
        var deleteMarker = function() {
            var marker = $(this);
            $.get('/map/delete/' + marker.data('id'), function(data) {
                if (data.status == 200) {
                    marker.remove();
                }
            })
        };

        $.each(markers, function(index, marker) {
            addMarker(marker);
        });

        $('.marker').click(deleteMarker);

        $('#map').click(function(e) {
            var marker = {
                'x': e.offsetX,
                'y': e.offsetY,
                'marker':  $('#markerSelect').val(),
                'text': $('#markerText').val(),
                'size': $('#markerSize').val(),
                'color': $('#markerColor').val(),
                'bold': $('#markerBold').is(':checked')? 1:0,
                'italic': $('#markerItalic').is(':checked')? 1:0,
                'underline': $('#markerUnderline').is(':checked')? 1:0,
                '_token': "{{ Session::token() }}"
            };

            if (add) {
                $.post('/map/add', marker, function(data) {
                    if (data.status == 200) {
                        marker.id = data.id;
                        addMarker(marker);

                        $('.marker').unbind();
                        $('.marker').click(deleteMarker);
                    }
                });
            }
        });

        function addMarker(marker) {
            var element = $('<span data-id="' + marker.id + '"></span>')
                    .addClass('marker')
                    .css('cursor', 'pointer')
                    .css('position', 'absolute')
                    .css('left', marker.x + 'px')
                    .css('top', marker.y + 'px')
                    .css('font-size', marker.size + 'px')
                    .css('color', marker.color)
                    .text(marker.text);

            if (marker.bold) {
                element.css('font-weight', 'bold');
            }
            if (marker.italic) {
                element.css('font-style', 'italic');
            }
            if (marker.underline) {
                element.css('text-decoration', 'underline');
            }

            if (marker.marker) {
                element.addClass('glyphicon')
                        .addClass('glyphicon-' + marker.marker);
            }

            if (marker.marker || marker.text) {
                $('#mapHolder').append(element);

                return true;
            }

            return false;
        }

        $('#markerMode').change(function() {
            if ($(this).val() == 'add') {
                addMarker = true;
                deleteMarker = false;
            }
            else if ($(this).val() == 'delete') {
                deleteMarker = true;
                addMarker = false;
            }
        });

        $('#markerCast').click(function() {
            selectMedia('/dnd/audio/21.mp3', '', 'Map', $('#mapPanelBody').html());
            loadMedia();
        });
    });
    </script>
@stop