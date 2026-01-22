@extends('frontend.layouts.app')

@section('title') {{ __($module_title) }} @endsection

@section('content')
<div class="max-w-7xl mx-auto px-6 py-12">

    <div class="text-center mb-8">
        <h1 class="text-4xl md:text-5xl font-bold text-[#C5A059]">{{ $module_title }}</h1>
        <p class="text-gray-600 mt-2">Kelola {{ $module_title }} di sini</p>
    </div>

    {{-- Livewire Component --}}
    <umkm-product:umkm 
        :products="$products" 
        :categories="$categories"
    />

</div>
@endsection
