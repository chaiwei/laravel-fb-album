@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">

                    <div class="row">
                      <form class="form-horizontal" role="form" method="GET" action="">
                        {!! csrf_field() !!}
                        <div class="col-md-11 form-group">
                        </div>
                        <div class="col-md-1 form-group text-right">
                            <a href="{{ url('album/create')}}" class="right btn btn-primary">
                                New
                            </a>
                        </div>
                      </form>
                    </div>
                  <table class="table table-bordered table-hover table-condensed">
                    <thead>
                      <tr>
                        <th>Album Name</th>
                        <th>FB Album ID</th>
                        <th>Options</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($tbl_records as $record)
                        <tr>
                          <td><a href="{{ url('album/'.$record->id) }}">{{ $record->album_name }}</a></td>
                          <td>{{ $record->album_id }}</td>
                          <td>
                            <a class="btn btn-primary" href="{{ url('album/'.$record->id.'/edit') }}">Edit</a>
                            <form action="{{ url('album/'.$record->id) }}"" method="post">
                              {{ method_field('DELETE') }}
                              {{ csrf_field() }}
                              <input type="submit" class="btn btn-danger" value="Delete">
                            </form>
                          </td>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
