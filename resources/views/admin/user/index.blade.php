@extends('admin.layouts.admin')

@section('table')
        <index-user :users="{{json_encode($users)}}"></index-user>
@endsection

<style></style>
