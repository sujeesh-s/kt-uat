@extends('layouts.seller')
@section('title', 'Earnings List')
@section('page-header')
@endsection
@section('content')
<div id="pg_content">
    @include('settlement.list')
</div>
<div id="loader" class="d-none"><div class="spinner1 content-spin"><div class="double-bounce1"></div><div class="double-bounce2"></div></div></div>
@endsection