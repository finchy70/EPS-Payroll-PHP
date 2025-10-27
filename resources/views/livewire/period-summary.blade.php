<div>
    <div class="mb-16 row flex justify-between items-center">
        <div class="text-2xl font-bold text-gray-600">EPS Payroll - Period Summary</div>
        <div><img src="{{asset('images/LOGOtransSmall.png')}}" alt=""/></div>
    </div>
    <form wire:submit.prevent="selectPeriod">
        <div class="max-w-xl mx-auto">
            <flux:select wire:model="selectedPeriod" label="Period">
                <option value="{{null}}">Please Select a Period...</option>
                @foreach($periods as $period)
                    <option value="{{$period['id']}}">{{$period['month']}} - {{$period['year']}}</option>
                @endforeach
            </flux:select>
        </div>
        <div class="mt-8 max-w-xl mx-auto row flex justify-end space-x-4" style="width: 95%">
            <flux:button size="sm" type="button" href="{{route('welcome')}}" class="text-sm px-2 py-1 bg-gray-700 text-gray-100 rounded" variant="primary">Back</flux::button>
            <flux:button size="sm" type="submit" class="text-sm px-2 py-1 bg-gray-700 text-gray-100 rounded">Select</flux::button>
        </div>
    </form>
</div>
