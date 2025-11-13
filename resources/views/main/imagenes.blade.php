@extends('template.base')

@section('content')

<div class="row">
<p>publica</p>
<img src="{{ url('storage/images/image.jpg') }}" style="width: 200px;">
</div>

<div class="row">
<p>private</p>
<img src="{{ route('privada') }}" style="width: 200px;">
</div>

<div class="row">
<p>private php</p>
<img src="{{ route('privadaPhp') }}" style="width: 200px;">
</div>

@endsection