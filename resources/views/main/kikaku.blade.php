@extends('layouts.app')

@section('content')

企画ページ

<form action="{{url('kikaku_done')}}" method='get'>
    {{ csrf_field() }}

    <input type="text" name="kikaku"　value="kikaku"/>
    <input type="submit" value="Submit"/>
</form>