<!DOCTYPE html>
<html>
<head>
    <title>{{$title}}</title>
</head>
<body>
@if($layout == 1)
    @extends('examples.m4_6d_layout1')
@else
    @extends('examples.m4_6d_layout2')
@endif

</body>
</html>
