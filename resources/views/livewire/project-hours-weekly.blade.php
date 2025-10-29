<div>
    <div class="mb-16 row flex justify-between items-center">
        <div class="text-2xl font-bold text-gray-600">EPS Payroll - Project Export Weekly</div>
        <div><img src="{{asset('images/LOGOtransSmall.png')}}" alt=""/></div>
    </div>
    <form wire:submit.prevent="exportWeek">
        <div class="max-w-xl mx-auto">
            <flux:select wire:model.live="selectedPeriod" label="Period">
                <option value="{{null}}">Please Select a Period...</option>
                @foreach($periods as $period)
                    <option value="{{$period['id']}}">{{$period['month']}} - {{$period['year']}}</option>
                @endforeach
            </flux:select>
            <div class="mt-6"></div>
            <flux:select wire:model.live="selectedWeek" label="Week Ending">
                <option value="{{null}}">Please Select a Week Ending...</option>
                @foreach($weeks as $week)
                    <option value="{{$week}}">{{\Carbon\Carbon::parse($week)->format('d-m-Y')}}</option>
                @endforeach
            </flux:select>

            <div class="mt-8 row flex justify-end space-x-4" style="width: 95%">
                <flux:button size="sm" type="button" href="{{route('project-hours')}}" class="text-sm px-2 py-1 bg-gray-700 text-gray-100 rounded" variant="primary">Back</flux::button>
                <flux:button size="sm" type="submit" class="text-sm px-2 py-1 bg-gray-700 text-gray-100 rounded">Export</flux::button>
            </div>
        </div>
    </form>
    {{-- Nothing in the world is as soft and yielding as water. --}}
</div>
