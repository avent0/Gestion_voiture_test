@extends('layouts.app')

@section('title', "Add Categories")

@section('header')
    @include('includes.header')
@endsection

@section('infoMain')
    @include('includes.categorieForm')
@endsection

@section('sideBar')
    @include('includes.sideBar', ['categories' => $categories])
@endsection