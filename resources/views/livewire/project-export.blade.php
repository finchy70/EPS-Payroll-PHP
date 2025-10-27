<div>
    <div class="mb-16 row flex justify-between items-center">
        <div class="text-2xl font-bold text-gray-600">EPS Payroll - Project Export</div>
        <div><img src="{{asset('images/LOGOtransSmall.png')}}" alt=""/></div>
    </div>
    <form wire:submit.prevent="exportPeriod">
        <div class="max-w-xl mx-auto">
            <flux:select wire:model.live="selectedPeriod" label="Period">
                <option value="{{null}}">Please Select a Period...</option>
                @foreach($periods as $period)
                    <option value="{{$period['id']}}">{{$period['month']}} - {{$period['year']}}</option>
                @endforeach
            </flux:select>
            <div class="mt-6"></div>
            @if($selectedPeriod != null)
                <flux:select wire:model="selectedWeek" label="Week Ending">
                    <option value="{{null}}">Please Select Week Ending...</option>
                    @foreach($weeks as $week)
                        <option value="{{$week}}">Wk{{$loop->iteration}}: {{Carbon\Carbon::parse($week)->format('d-m-Y')}}</option>
                    @endforeach
                    <option value="AllWeeks">All Weeks (Period)</option>
                </flux:select>
            @endif
            <div class="mt-8 row flex justify-end space-x-4" style="width: 95%">
                <flux:button size="sm" type="button" href="{{route('project-hours')}}" class="text-sm px-2 py-1 bg-gray-700 text-gray-100 rounded" variant="primary">Back</flux::button>
                <flux:button size="sm" type="submit" class="text-sm px-2 py-1 bg-gray-700 text-gray-100 rounded">Export</flux::button>
            </div>
        </div>
    </form>
</div>
