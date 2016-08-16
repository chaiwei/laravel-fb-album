@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">Facebook Album - {{ $post->album_name }}</div>
        <div class="panel-body">
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('custom_js')
<script>
  (function(d, s, id){
   var js, fjs = d.getElementsByTagName(s)[0];
   if (d.getElementById(id)) {return;}
   js = d.createElement(s); js.id = id;
   js.src = "//connect.facebook.net/en_US/sdk.js";
   fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  window.fbAsyncInit = function() {
    FB.init({
      appId      : '756838244435787',
      xfbml      : true,
      version    : 'v2.3'
    });
    FB.getLoginStatus(function(response) {
      if (response.status === 'connected') {
        // the user is logged in and has authenticated your
        // app, and response.authResponse supplies
        // the user's ID, a valid access token, a signed
        // request, and the time the access token
        // and signed request each expire
        var uid = response.authResponse.userID;
        var accessToken = response.authResponse.accessToken;
        load_photos();
      } else if (response.status === 'not_authorized') {
        // the user is logged in to Facebook,
        // but has not authenticated your app

      } else {
        // the user isn't logged in to Facebook.
      }
     });
  };
  load_photos();
  function load_photos(){
    FB.api(
        "/{{ $post->album_id }}?fields=photos{link,images},link",
        function (response) {
          if (response && !response.error) {
            /* handle the result */
            var photos = response.photos.data;
            for(x in photos){
              $('.panel-body').append('<img src="'+photos[x].images[5].source+'" />');
            }
          }
        }
    );
  }
</script>
@endsection
