<div>
    <div class="mb-16 row flex justify-between items-center">
        <div class="text-2xl font-bold text-gray-600">EPS Payroll - View Hours</div>
        <div><img src="{{asset('images/LOGOtransSmall.png')}}" alt=""/></div>
    </div>
    <form wire:submit.prevent="viewHours">
        <div class="max-w-xl mx-auto">
            <flux:select wire:model="selectedEmployee" label="Name">
                <option value="{{null}}">Please Select Employee...</option>
                @foreach($employees as $employee)
                    <option value="{{$employee['emp_no']}}">{{$employee['name']}}</option>
                @endforeach
            </flux:select>
            <div class="mt-6"></div>
            <flux:select wire:model="selectedWeekEnding" label="Week Ending">
                <option value="{{null}}">Please Select Week Ending...</option>
                @foreach($weeks as $week)
                    <option value="{{$week}}">Wk{{$loop->iteration}}: {{Carbon\Carbon::parse($week)->format('d-m-Y')}}</option>
                @endforeach
            </flux:select>
            <div class="mt-8 flex row justify-center text-sm text-gray-600 font-bold items-center">
                Current Period
                <input readonly class="ml-4 px-2 py-1 text-xs rounded-lg w-32 bg-gray-400 text-white overflow-hidden text-center" value="{{$period->month.'-'.$period->year}}"></input>
            </div>
            <div class="mt-8 row flex justify-end space-x-4" style="width: 95%">
                <flux:button size="sm" type="button" href="{{route('payroll-select')}}" class="text-sm px-2 py-1 bg-gray-700 text-gray-100 rounded" variant="primary">Back</flux::button>
                <flux:button size="sm" type="submit" class="text-sm px-2 py-1 bg-gray-700 text-gray-100 rounded">View</flux::button>
            </div>
        </div>
    </form>

</div>
