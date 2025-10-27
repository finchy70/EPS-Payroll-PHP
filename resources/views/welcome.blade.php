@extends('layouts.master')
@section('content')
    <div>
        <div class="mb-6 row flex justify-between items-center">
            <div class="text-2xl font-bold text-gray-600">EPS Payroll</div>
            <div><img src="{{asset('images/LOGOtransSmall.png')}}" alt=""/></div>
        </div>
        <div class="space-y-4">
            <div class="row justify-center flex">
                <a href="{{route('payroll-select')}}" class="px-4 py-2 w-96 rounded-xl text-center text-white bg-gray-400">Payroll Entry</a>
            </div>
            <div class="row justify-center flex">
                <a href="{{route('period-summary')}}" class="px-4 py-2 w-96 rounded-xl text-center text-white bg-gray-400">Period Summary</a>
            </div>
            <div class="row justify-center flex">
                <a href="{{route('project-hours')}}" class="px-4 py-2 w-96 rounded-xl text-center text-white bg-gray-400">Project Hours</a>
            </div>
            <div class="row justify-center flex">
                <a href="{{route('setup.menu')}}" class="px-4 py-2 w-96 rounded-xl text-center text-white bg-gray-400">Setup</a>
            </div>
            <div class="row justify-center flex">
                <a href="{{route('quit')}}" class="px-4 py-2 w-96 rounded-xl text-center text-white bg-gray-400">Close</a>
            </div>
        </div>
        <div class="mt-8 flex row justify-center text-sm text-gray-600 font-bold items-center">
            Current Period
            <input readonly class="ml-4 px-2 py-1 text-xs rounded-lg w-32 bg-gray-400 text-white overflow-hidden text-center" value="{{$period}}"></input>
        </div>
    </div>
@endsection
