@extends('admin.layouts.admin')

@section('form')

    <div id="app">
        <edit-user :user="{{json_encode($user)}}"></edit-user>
    </div>

@endsection


