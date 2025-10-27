@extends('layouts.master')
@section('content')
    <div>
        <div class="mb-6 row flex justify-between items-center">
            <div class="text-2xl font-bold text-gray-600">EPS Payroll - Setup</div>
            <div><img src="{{asset('images/LOGOtransSmall.png')}}" alt=""/></div>
        </div>
        <div class="space-y-4">
            <div class="row justify-center flex">
                <a href="{{route('setup.new-starter')}}" class="px-4 py-2 w-96 rounded-xl text-center text-white bg-gray-400">Create New Starter</a>
            </div>
            <div class="row justify-center flex">
                <a href="{{route('setup.leaver')}}" class="px-4 py-2 w-96 rounded-xl text-center text-white bg-gray-400">Create Leaver</a>
            </div>
            <div class="row justify-center flex">
                <a href="{{route('setup.end-period')}}" class="px-4 py-2 w-96 rounded-xl text-center text-white bg-gray-400">End Period</a>
            </div>
            <div class="row justify-center flex">
                <a href="/" class="px-4 py-2 w-96 rounded-xl text-center text-white bg-gray-400">Main Menu</a>
            </div>
        </div>
    </div>
@endsection
