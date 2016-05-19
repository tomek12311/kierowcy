@extends('app')

@section('content')


    <script>
        function mapClick(){
            console.log('funckja');
            google.maps.event.addListener(maps[0].map, "rightclick", function(event) {
                var lat = event.latLng.lat();
                var lng = event.latLng.lng();
                // populate yor box/field with lat, lng
                document.getElementById('dlugosc').value = lng;
                document.getElementById('szerokosc').value = lat;
//                                alert("Lat=" + lat + "; Lng=" + lng);
            });
        }

        function newLocation(newLat,newLng)
        {
//                            var map = maps[0];
//                            console.log(map.map);
//                            maps[0].map.setCenter(new GLatLng(newLat, newLng));

//                            map.setCenter({
//                                lat : newLat,
//                                lng : newLng
//                            });
            console.log(maps);
            var relocate = new google.maps.LatLng(newLat, newLng);
            maps[0].map.setCenter(relocate);

            //map.getBounds();
        }

        function center(lat, lgt, id){
//                            document.getElementById("test").innerHTML = id;
            newLocation(lat,lgt);
            show(id)
        }

        function show(str) {
            var xhttp;
            if (str == "") {
                document.getElementById("wsp").innerHTML = "";
                return;
            }
            xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (xhttp.readyState == 4 && xhttp.status == 200) {
                    document.getElementById("wsp").innerHTML = xhttp.responseText;
                    lista_sortowana(str);
                    pokaz_na_mapie(str);
                }
            };
            xhttp.open("GET", "destinations/"+str, true);
            xhttp.send();
        }


        function pinSymbol(color) {
            return {
                path: 'M 0,0 C -2,-20 -10,-22 -10,-30 A 10,10 0 1,1 10,-30 C 10,-22 2,-20 0,0 z M -2,-30 a 2,2 0 1,1 4,0 2,2 0 1,1 -4,0',
                fillColor: color,
                fillOpacity: 1,
                strokeColor: '#000',
                strokeWeight: 2,
                scale: 1,
            };
        }

        var temporary_markers = [];
        function pokaz_na_mapie(id) {
            usun_z_mapy()


            var xhttp;

            var ids = $("#sortable").sortable( "serialize" );

            var xhttp;

            xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (xhttp.readyState == 4 && xhttp.status == 200) {
                    var response = xhttp.responseText.split("|");
                    for (i = 0; i < response.length-1; i++) {
//                                        document.getElementById("temp").innerHTML += response[i].split(";")+"<br>";
                        var wsp = response[i].split(";");
                        var latlng = new google.maps.LatLng(wsp[1],wsp[0]);

//                                        document.getElementById("temp").innerHTML += latlng+"<br>";

                        var marker = new google.maps.Marker({
                            position: latlng,
                            label: (i+1).toString(),
                            //icon: pinSymbol("#FF1"),
                            map: maps[0].map,
                        });

                        marker.setMap(maps[0].map);
                        temporary_markers.push(marker);
                    }

                }
            };

            xhttp.open("GET", "destinations_punkty?id="+id, true);
            xhttp.send();
        }

        function usun_z_mapy(){
            for (i = 0; i < temporary_markers.length; i++) {
                temporary_markers[i].setMap(null);
            }

            temporary_markers = [];
        }

        function lista_sortowana(id) {
            $(function () {
                $("#sortable").sortable({
                    placeholder: "ui-state-highlight",
                    update: function( ) {
                        var ids = $("#sortable").sortable( "serialize" );

                        var xhttp;

                        xhttp = new XMLHttpRequest();
                        xhttp.onreadystatechange = function() {
                            if (xhttp.readyState == 4 && xhttp.status == 200) {
                                //document.getElementById("temp").innerHTML = xhttp.responseText;

                                usun_z_mapy();
                                pokaz_na_mapie(id);
                                console.log('ok');
                            }
                        };

                        xhttp.open("GET", "destinations_sort?"+ids, true);
                        xhttp.send();
                    }
                });
                $("#sortable").disableSelection();


            });
        }


    </script>

    <div class="container">

        <div class="row">
            <div class="col-xs-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Home</div>

                    <div class="panel-body">
                        {!! Mapper::render() !!}

                    </div>
                </div>
            </div>

            <div class="col-xs-3">
                {{--<div class="row">--}}

                <div class="panel panel-default">
                    <div class="panel-heading">Legenda</div>

                    <div class="panel-body">
                        <ul>
                            @foreach(App\User::where('company_id', Auth::User()->company_id)->get() as $employee)
                                {{--if $employee is employee then--}}


                                <a
                                        @if($employee -> coordinates() -> count() != 0)
                                        href="javascript:center(
                                                {!! $employee -> pozycja()['szerokosc'] !!},
                                                {!! $employee -> pozycja()['dlugosc'] !!},
                                                {!! $employee -> id !!})"
                                        @endif
                                >
                                    {{--<a href={{action('HomeController@map', $employee['id'])}}>--}}
                                    <li>
                                        <img src="http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|{!! $employee -> kolor() !!}"
                                             alt="obrazek">
                                        {!! $employee -> name!!}
                                    </li>
                                </a>
                            @endforeach

                            <li id="test"></li>
                        </ul>

                        <style>
                            #sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
                            #sortable li { margin: 0 5px 5px 5px; padding: 5px; font-size: 1.2em; height: 1.5em; }
                            html>body #sortable li { height: 1.5em; line-height: 1.2em; }
                            .ui-state-highlight { height: 1.5em; line-height: 1.2em; }
                        </style>

                    </div>
                </div>

                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading">Dodaj cel</div>
                        <div class="panel-body">

                            {!! Form::open(['method' => 'POST', 'action' => 'destinationController@store', 'files'=>true] ) !!}
                            <select name="user_id" id="user_id">
                                @foreach(App\User::all() as $employee)
                                    <option value="{!! $employee -> id !!}">{!! $employee -> name !!}</option>
                                @endforeach
                            </select><br>

                            dlugosc: <input type="text" name="dlugosc" id="dlugosc"><br>
                            szerokosc: <input type="text" name="szerokosc" id="szerokosc"><br>

                            <button type="submit">Dodaj</button>

                            {!! Form::close() !!}
                        </div>



                    </div>
                </div>

                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading">Lista</div>
                        <div class="panel-body">

                            <div class="panel-body" id="wsp">

                        </div>



                    </div>
                </div>



            </div>
        </div>


    </div>


    <div id="temp"></div>

    <div id="temp2"></div>



    </div>
@endsection