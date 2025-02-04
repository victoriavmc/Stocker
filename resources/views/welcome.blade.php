@extends('layouts.home')

@section('content')
    <div class="grid gap-6 lg:grid-cols-2 lg:gap-8">
        <section class="flex justify-center">
            <img class="" src="{{ asset('storage/image/web/stocker.ico') }}" alt="">
        </section>
        
        <section class="flex justify-center">
            @if (Route::has('login'))
                <div class="flex justify-center flex-col gap-4">
                    <p class="font-semibold text-xl">Lorem ipsum dolor sit amet consectetur adipisicing elit. Est eos culpa excepturi, neque deserunt facilis enim maiores natus, voluptatum, sint dolorem? Aut deserunt quos commodi, sapiente nihil quae laudantium aliquid!</p>
                    <div>
                        @auth
                            <x-primary-btn label="Dashboard" link="{{ url('/dashboard') }}"/>
                        @else
                            <x-primary-btn label="Iniciar sesion" link="{{ route('login') }}"/>
                        @endauth
                    </div>
                </div>
            @endif
        </section>
    </div>
@endsection           