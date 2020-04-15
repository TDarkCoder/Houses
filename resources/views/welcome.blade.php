@extends('layouts.app')

@section('content')

    <search-form maximum="{{ $maximum }}" minimum="{{ $minimum }}"></search-form>

@endsection
