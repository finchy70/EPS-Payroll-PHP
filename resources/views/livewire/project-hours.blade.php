<div>
    <div class="mb-16 row flex justify-between items-center">
        <div class="text-2xl font-bold text-gray-600">EPS Payroll - Project Hours</div>
        <div><img src="{{asset('images/LOGOtransSmall.png')}}" alt=""/></div>
    </div>
    <div class="space-y-4">
        <div class="row justify-center flex">
            <a href="{{route('project-hours-weekly')}}" class="px-4 py-2 w-96 rounded-xl text-center text-white bg-gray-400">Total Project Hours by Week</a>
        </div>
        <div class="row justify-center flex">
            <a href="{{route('project-export')}}" class="px-4 py-2 w-96 rounded-xl text-center text-white bg-gray-400">Total Project Hours Export</a>
        </div>
        <div class="row justify-center flex">
            <a href="{{route('project-hours-employee')}}" class="px-4 py-2 w-96 rounded-xl text-center text-white bg-gray-400">Project Hours by Employee Export</a>
        </div>
        <div class="row justify-center flex">
            <a href="{{route('welcome')}}" class="px-4 py-2 w-96 rounded-xl text-center text-white bg-gray-400">Main Menu</a>
        </div>
    </div>
</div>
