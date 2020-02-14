<?php  
use Pnlinh\GoogleDistance\Facades\GoogleDistance;


  if(isset($_GET['search'])){
    $search = $_GET['search'];
    $naplattitude = $_GET['lat'];
    $naplongitude = $_GET['long'];
  }else{
    $search = 'Cleaning Service';
    $naplattitude = 10.31672;
    $naplongitude = 123.89071;
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robot" content="index, follow">
    <meta http-equiv="Content-Language" content="en" />
    <title>411 Handson Examination</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">

    <link rel="icon" href="favicon.ico">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
 
  <style>
  #map {
  width: 100%;
  height: 500px;
}
tr td.dataTables_empty {
  display:none;
}
  </style>
 

    <script>
    var map;
    var googleService;
    var infoWindow;
    var marker;
    var getDesti = new Array();
    var getOrigin = "Cebu City";
    // Initialize 
    function initMap() {
      var nap_lattitude= <?php echo $naplattitude; ?>;
      var nap_longitude = <?php echo $naplongitude; ?>;

    
      // location of the amap
      var nap_info = {
        lat: nap_lattitude,
        lng: nap_longitude
      };
      var addressorigin = {
        lat: 10.31672,
        lng: 123.89071
      };

      var cn = '<?php echo $search; ?>';

      var request = {
        location: nap_info,
        query: cn,
        fields: ['name', 'formatted_address', 'place_id', 'geometry', 'rating'],
        radius: '48280.32', // computed miles in meters
        type: ['address']
      };

      // display map
      map = new google.maps.Map(
        document.getElementById('map'), {
          center: addressorigin,
          zoom: 12
        }
      );

      // Create Company Details popup
      infoWindow = new google.maps.InfoWindow();

      // create places service.
      googleService = new google.maps.places.PlacesService(map);

      googleService.textSearch(request, callback);

    }

    // Display Marker on every Company
    function createMarker(cn) {
    
        
    var marker = new google.maps.Marker({
      map: map,
      position: cn.geometry.location,
      title: cn.name,
      animation: google.maps.Animation.DROP
    });

    // Company Details Content
    google.maps.event.addListener(marker, 'click', function() {
      infoWindow.setContent('<div><strong>' + cn.name + '</strong>' +'<br>' +
      cn.formatted_address + '</div>');
      infoWindow.open(map, this);
    });

    // Marker Animation 
    google.maps.event.addListener(marker, 'click', function() {
      if (marker.getAnimation() !== null) {
        marker.setAnimation(null);
      } else {
        marker.setAnimation(google.maps.Animation.BOUNCE);
      }
    });
    
 function initMap() {
        
      }

      function deleteMarkers(GetMarkers) {
        for (var i = 0; i < GetMarkers.length; i++) {
          GetMarkers[i].setMap(null);
        }
        GetMarkers = [];
      }

    // Display all Company Details
    var napResults = '';
    napResults += '<tr>';
    napResults += '<td>'+cn.name+'</td>';
    napResults += '<td width="700px">'+cn.formatted_address+'</td>';
    napResults += '<td>'+getOrigin+'</td>';
    napResults += '<td>'+cn.rating+'</td>';
    napResults += '<tr>';
    
    // var getDestination(cn.formatted_address);

    //   console.log(getDestination);
    getDesti.push(cn.formatted_address);
      
    $('.table-companyname tbody').append(napResults);
    
    }
  


  
    function callback(results, status) {
      if (status == google.maps.places.PlacesServiceStatus.OK) {
        for (var i = 0; i < results.length; i++) {
          var place = results[i];
          createMarker(results[i]);
          // console.log(results[i]);
        }
      }
    }

$(document).ready(function() {
console.log(getDesti);
// $('input[name="GetDestination[]"]').val(getDesti);
// alert('hello world');

});
    </script>
    
</head>
    <body>
      <div class="container">
      <form class="form-inline" action="" method="GET">
         <div class="form-group">
          <label for="email">Company Category</label>
          <input type="text" class="form-control" id="search" name="search" placeholder="Company Category" title="Company Categort (Cleaning Service, Landscaper, Mover etc.)" value="<?php echo (isset($_GET['search'])) ? $_GET['search'] : ""; ?>">
        </div><br>
        <div class="form-group">
          <label for="pwd">Lattitude:</label>
          <input type="text" class="form-control" id="lat" name="lat" placeholder="Address Lattitude" value="<?php echo (isset($_GET['nap_lattitude'])) ? $_GET['nap_lattitude'] : ""; ?>">
        </div><br>
        <div class="form-group">
          <label for="pwd">Longitude:</label>
          <input type="text" class="form-control" id="long" name="long" placeholder="Address Longitude" value="<?php echo (isset($_GET['nap_longitude'])) ? $_GET['nap_longitude'] : ""; ?>">
        </div><br>
        <button type="submit" class="btn btn-primary mb-2">Search</button>
      </form>
      
      <br><br>

      <div id="map"></div>
      <input type="hidden" class="Destination" name="GetDestination[]"></input> 
      <table id="nap_table" class="table table-companyname table-striped table-hover table-bordered">
          <thead>
              <tr>
                  <th>Company Name</th>
                  <th>Address</th>
                  <th>Origin</th>
                  <th>Distance</th>
                  
              </tr>
          </thead>
          <tbody>
          </tbody>
      </table>
      </div>

        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
		    
    <script>
      $(document).ready( function () {
			    $('#nap_table').DataTable();
			  });
		</script>
   
   <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBqcQKuEyN-V6-OqDQ1thI7-8a8cXWC7FQ&callback=initMap&libraries=places"
  type="text/javascript"></script>
    </body>
</html>