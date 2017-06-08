<!DOCTYPE html>
<?php session_start(); ?>
  <html>
    <title>Complete Profile</title>
    <head>
      <!--Import Google Icon Font-->
      <link type ="text/css" href="../css/google_font.css" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <style>
       #map {
        height: 285px;
        width: 50%;
       }
    </style>
    </head>

    <body>
      <h3><?php if(isset($_SESSION['id'])){
        $name = explode(' ',$_SESSION['displayName']);
        echo 'Hey , ' . $name[0] . '!! We are going to need a little more information from you!';} ?>
      </h3>
      <h5>Please select the days of the week you drive to school. When all of your days are filled, finish by clicking Complete Schedule</h5>
      <br>
      <div id="warn"></div>
      <br>
      <div id="days">
          <input type="checkbox" id="mon" />
          <label for="mon">Monday</label>

          <input type="checkbox" id="tues" />
          <label for="tues">Tuesday</label>

          <input type="checkbox" id="wed" />
          <label for="wed">Wednesday</label>

          <input type="checkbox" id="thurs" />
          <label for="thurs">Thursday</label>

          <input type="checkbox" id="fri" />
          <label for="fri">Friday</label>
      </div>
      <br>

    <form id="insert_data" class="form-days">
    <!--days of the week, request times-->
    <div class="cols12" id ="monday">
      <label>What time do you leave on Monday?</label>
      <div class="row">
        <div class="input-field col s6">
             <input type="time" name="mon_time">
        </div>
      </div>
    </div>

    <div class="cols12" id ="tuesday">
      <label>What time do you leave on Tuesday?</label>
      <div class="row">
        <div class="input-field col s6">
             <input type="time" name="tues_time">
        </div>
      </div>
    </div>

    <div class="cols12" id ="wednesday">
      <label>What time do you leave on Wednesday?</label>
      <div class="row">
        <div class="input-field col s6">
             <input type="time" name="wed_time">
        </div>
      </div>
    </div>

    <div class="cols12" id ="thursday">
      <label>What time do you leave on Thursday?</label>
      <div class="row">
        <div class="input-field col s6">
             <input type="time" name="thur_time" id = "thur_time">
        </div>
      </div>
    </div>

    <div class="cols12" id ="friday">
      <label>What time do you leave on Friday?</label>
      <div class="row">
        <div class="input-field col s6">
             <input type="time" name="fri_time">
        </div>
      </div>
    </div>
      <div id ='locations'><br>
        <b>Select a preferred lot location (see map below for details, selection not required)</b><br>
        <input name="loc" type="radio" value = 0 checked id="loc0" />
        <label for="loc0">None</label>

        <input name="loc" type="radio" value = 12 id="loc1" />
        <label for="loc1">Lot 12</label>

        <input name="loc" type="radio" value = 18 id="loc2" />
        <label for="loc2">Lot 18</label>

        <input name="loc" type="radio" value = 19 id="loc3" />
        <label for="loc3">Lot 19</label>

        <input name="loc" type="radio" value = 71 id="loc4" />
        <label for="loc4">Lot 71</label>

        <input name="loc" type="radio" value = 508 id="loc5" />
        <label for="loc5">Lot 508</label>

      </div>
      <br>
    <input type="button" class="btn btn-default" name="submit" id="submit" value="Complete Schedule" />
  </form>

      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
      <script>
           $(document).ready(function() {
            //hides all entry fields for days of the week
            $(".cols12").hide();
            $("#submit").hide();
            $('#locations').hide();
            $('#mon').change(function() {
                if($(this).is(":checked")) {
                    $("#monday").show();
                    $("#submit").show();
                    $("#locations").show();
                }
                else{
                  $("#monday").hide();
                }
            });

            $('#tues').change(function() {
                if($(this).is(":checked")) {
                    $("#tuesday").show();
                    $("#submit").show();
                    $("#locations").show();
                }
                else{
                  $("#tuesday").hide();
                }
            });

            $('#wed').change(function() {
                if($(this).is(":checked")) {
                    $("#wednesday").show();
                    $("#submit").show();
                    $("#locations").show();
                }
                else{
                  $("#wednesday").hide();
                }
            });

            $('#thurs').change(function() {
                if($(this).is(":checked")) {
                    $("#thursday").show();
                    $("#submit").show();
                    $("#locations").show();
                }
                else{
                  $("#thursday").hide();
                }
            });

            $('#fri').change(function() {
                if($(this).is(":checked")) {
                    $("#friday").show();
                    $("#submit").show();
                    $("#locations").show();
                }
                else{
                  $("#friday").hide();
                }
            });
        /* onClick for grabing visible data*/
            $('#submit').click(function() {
              var errorCount = 0;

              $(":input").filter(":visible").not("#submit").each(function(){
               if(!$(this).val()){
                 //console.log("error, fill out ya boxes!");
                 alert("Please make sure your times are in the correct format.");
               }
               else{
                  $.ajax({
                    url: "insert.php",
                    method: "POST",
                    data: $(":input").filter(":visible").not("#submit").serialize(),
                    success: function(data) {
                        $('form').trigger("reset");
                        $('#warn').fadeIn().html(data);
                        window.location = "index.php#zoom";
                    }
                });
              }

              });

        });
        });
      </script>
      <h4>CSUMB Parking Lots (the popular ones) </h4>
    <div id="map"></div>
    <script>
    //JS for initializing maps and points for parking spots, map printed above
      function initMap() {
        var uluru = {lat: 36.654457, lng: -121.797715};

        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 15,
          center: uluru
        });

        var uluru = {lat:36.652328 , lng:-121.798799};
        var marker = new google.maps.Marker({
          position: uluru,
          map: map,
          label:"508"
        });

        var uluru = {lat:36.652651 ,lng:-121.794561 };

        var marker2 = new google.maps.Marker({
          position: uluru,
          map: map,
          label:"19"
        });

        var uluru = {lat:36.656059 ,lng:-121.794786 };

        var marker3 = new google.maps.Marker({
          position: uluru,
          map: map,
          label:"71"
        });

        var uluru = {lat:36.654265 ,lng:-121.800741 };
        var marker4 = new google.maps.Marker({
          position: uluru,
          map: map,
          label:"18"
        });

        var uluru = {lat:36.654260 ,lng:-121.796224};
        var marker5 = new google.maps.Marker({
          position: uluru,
          map: map,
          label:"12"
        });
        /* Marker Section with onClicks */
        ///////////////////////////////////////////////////
        var contentString5 = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h4 id="firstHeading" class="firstHeading">Student Center Parking</h4>'+
            '<div id="bodyContent">'+
            '<p><b>Lot 12</b> is situated near the student center and main street, Inter-garrison road  ' +
            '</p>'+
            '</div>'+
            '</div>';
        var infowindow = new google.maps.InfoWindow({
          content: contentString5
        });

        google.maps.event.addListener(marker5, 'click', function() {
          //window.location.href = "google.com";
          infowindow.open(map, marker5);
        });
        ///////////////////////////////////////////////////////

        var contentString4 = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h3 id="firstHeading" class="firstHeading">Visitor (20 minute) Parking</h3>'+
            '<div id="bodyContent">'+
            '<p><b>Lot 18</b> is situated near the Heron Hall building and is typically only used for visitors  ' +
            '</p>'+
            '</div>'+
            '</div>';
        var infowindow4 = new google.maps.InfoWindow({
          content: contentString4
        });

        google.maps.event.addListener(marker4, 'click', function() {
          //window.location.href = "google.com";
          infowindow4.open(map, marker4);
        });
        ////////////////////////////////////////////////////
        var contentString3 = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h3 id="firstHeading" class="firstHeading">The Orientation parking lot (available for everyone)</h3>'+
            '<div id="bodyContent">'+
            '<p><b>Lot 71</b> is situated near Inter-garrison road, it is quite possibly the largest parking lot, best for finding parking ' +
            '</p>'+
            '</div>'+
            '</div>';
        var infowindow3 = new google.maps.InfoWindow({
          content: contentString3
        });

        google.maps.event.addListener(marker3, 'click', function() {
          //window.location.href = "google.com";
          infowindow3.open(map, marker3);
        });

        //////////////////////////////////////////////////////
              var contentString2 = '<div id="content">'+
                    '<div id="siteNotice">'+
                    '</div>'+
                    '<h3 id="firstHeading" class="firstHeading">Library Lot</h3>'+
                    '<div id="bodyContent">'+
                    '<p><b>Lot 19</b> is situated near the Library and Math building, great for accessing most of CSUMB' +
                    '</p>'+
                    '</div>'+
                    '</div>';
                var infowindow2 = new google.maps.InfoWindow({
                  content: contentString2
                });

                google.maps.event.addListener(marker2, 'click', function() {

                  infowindow2.open(map, marker2);
                });

        //////////////////////////////////////////////////////
                var contentString1 = '<div id="content">'+
                      '<div id="siteNotice">'+
                      '</div>'+
                      '<h3>The BIT Building lot</h3>'+
                      '<div id="bodyContent">'+
                      '<p><b>Lot 508</b> is situated near the Business Information Technology building, great for accessing western regions at CSUMB' +
                      '</p>'+
                      '</div>'+
                      '</div>';
                  var infowindow1 = new google.maps.InfoWindow({
                    content: contentString1
                  });

                  google.maps.event.addListener(marker, 'click', function() {
                    //window.location.href = "google.com";
                    infowindow1.open(map, marker);

                  });

      }
    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJsb5E1aTwOYCjtD4_p_kdlTqFmDlnnEs&callback=initMap">
    </script>
    </body>
  </html>
