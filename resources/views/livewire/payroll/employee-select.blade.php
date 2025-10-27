<div>
    <div class="mb-24 row flex justify-between items-center">
        <div class="text-2xl font-bold text-gray-600">EPS Payroll - Employee Selection</div>
        <div><img src="{{asset('images/LOGOtransSmall.png')}}" alt=""/></div>
    </div>
    <div class="row flex justify-between">
        <flux:label class="!text-lg !text-gray-700">Week Ending</flux:label>
        <flux:select wire:model="selectedWeek" class="!w-80 !bg-white !text-black" placeholder="Please Select...">
            @foreach($weeks as $week)
                <flux:select.option value="{{$week['id']}}">{{$week['week']}}</flux:select.option>
            @endforeach
        </flux:select>
    </div>
    <div class="flex flex-col">
        <div class="mt-32 flex row justify-between">
            <flux:label class="!text-lg !text-gray-700">Employee</flux:label>
            <flux:select wire:model="selectedEmployee" class="!w-80 !bg-white !text-black" placeholder="Please Select...">
                @foreach($employees as $employee)
                    <flux:select.option value="{{$employee['emp_no']}}">{{$employee['name']}}</flux:select.option>
                @endforeach
            </flux:select>
        </div>

        <div class="fixed bottom-3" style="width: 94%">
            <div class="flex row justify-between items-center">
                <div class="flex row items-center !text-gray-700">
                    <span class="text-sm">Current Period</span>
                    <input readonly class="ml-4 px-2 py-1 text-xs rounded-lg w-32 bg-gray-400 text-white overflow-hidden text-center" value="{{$periodString}}"></input>
                </div>
                <div class="flex row items-center space-x-4">
                    <flux:button size="xs" wire:click="back">Back</flux:button>
                    <flux:button size="xs" wire:click="select({{$selectedEmployee, $selectedWeek}})">Select</flux:button>
                </div>
            </div>
        </div>
    </div>




</div>
