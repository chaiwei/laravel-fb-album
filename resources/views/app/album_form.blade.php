@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">Facebook Album</div>
        <div class="panel-body">
        @if(isset($post['id']))
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/album/'.$post['id']) }}">
            {{ method_field('PUT') }}
        @else
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/album') }}">
            {{ method_field('POST') }}
        @endif
            {!! csrf_field() !!}
            <div class="row">
                <div class="col-md-12 form-group">
                    <label class="col-md-2 control-label">Album ID</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="album_id" value="{{ isset($post['album_id'])?$post['album_id']:request('album_id') }}">
                        @if ($errors->has('album_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('album_id') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-12 form-group">
                    <label class="col-md-2 control-label">Album Name</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="album_name" value="{{ isset($post['album_name'])?$post['album_name']:request('album_name') }}">
                        @if ($errors->has('album_name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('album_name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-12 form-group">
                    <label class="col-md-2 control-label"></label>
                    <div class="col-md-10">
                        <input type="submit" class="btn btn-primary" name="submit" value="Save">
                    </div>
                </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
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
      version    : 'v2.7'
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

      } else if (response.status === 'not_authorized') {
        // the user is logged in to Facebook,
        // but has not authenticated your app

      } else {
        // the user isn't logged in to Facebook.
      }
     });
  };
  $('input[name=album_id]').keyup(function(){
    get_album_name();
  });

  function get_album_name(){
    FB.api(
        "/"+$('input[name=album_id]').val(),
        function (response) {
          if (response && !response.error) {
            /* handle the result */
            $('input[name=album_name]').val(response.name);
          }
        }
    );
  }
</script>
@endsection
