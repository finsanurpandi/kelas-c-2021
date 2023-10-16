<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <h1>Hello</h1>

    {!! $nama !!}
    <br/>
    {{ $kampus }}
    <br/>
    @foreach ($fruits as $fruit)
        {{ $fruit }} <br/>
    @endforeach

    @if($nama == null)
        Nama tidak tersedia
    @else
        {{ $nama}}
    @endif

    <form method="POST" action="#">
        @csrf
        @method('PATCH')
    </form>
    <?php

    ?>

    @php
        $value=1;
    @endphp

    {{-- <x-alert type="secondary" message="Lorem, ipsum dolor sit amet consectetur adipisicing elit." /> --}}
    <x-alert type="success">
        <x-slot:header>SUCCESS</x-slot:header>
        Lorem, ipsum dolor sit amet consectetur adipisicing elit.
    </x-alert>

<x-badge color="red">
    Ini adalah badge
</x-badge>
</body>
</html>