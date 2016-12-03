<html>
    <head>
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" ></link>
    </head>
    <body>
        <div><h1 style="text-align: center">Pomiar Temperatury</h1></div>
        <div id="measures"></div>
        <script>
            function load_measure() {
                 $.get("api.php", function( measure ) {
                    var data = JSON.parse(measure);
                    $('#measures').html('');
                        if(data && Array === data.constructor) {
                                var active_sensors = $.grep(data, function(a){
                                    return a.active === true
                                })
                                if(active_sensors.length > 0) {
                                    $.each(active_sensors, function(key,val) {
                                        var opacity = Math.abs(val.last_measure)/45;
                                        var color = 'rgba(255,0,0,' + opacity + ')';
                                        if(val.last_measure<0) {
                                            color = 'rgba(0,0,255,' + opacity + ')';
                                        }
                                        $('#measures').append('<div class=\"col-xs-6 col-sm-4 col-md-3\"><div class=\"thumbnail\" style=\"background-color: ' + color + '\">' +
                                                    '<div class=\"caption\"><h3 style = "text-align: center">' + val.last_measure + '</h3>' +
                                                    '<p>' + val.sensor_name + '</p></div></div></div>');
                                    });
                                } else {
                                    $('#measures').html('<div style="margin-top : 20%; text-align: center"><h3>Podłącz czujniki</h3></div>');
                                }
                        }
                 });
             }
             load_measure();
             setInterval(load_measure, 5000);
        </script>
    </body>
</html>
