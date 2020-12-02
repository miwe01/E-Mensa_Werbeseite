<!DOCTYPE html>
<html>
<head>
    <title>{{$title}}</title>
</head>
<body>
{{--
@if(isset($_GET["no"]) && $_GET["no"] == "1")
    @include('examples.m4_6d_layout', ['title' => "Layout1"])
@else
    @include('examples.m4_6d_layout', ['title' => "Layout2"])
@endif
--}}

@section('header')
    Header1 <br>
@show

@section('main')
    Main1 <br>
@show

@section('footer')
    Footer1 <br>
@show
</body>
</html>
