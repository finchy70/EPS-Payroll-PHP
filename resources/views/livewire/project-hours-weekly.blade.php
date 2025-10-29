<div>
    <div class="mb-16 row flex justify-between items-center">
        <div class="text-2xl font-bold text-gray-600">EPS Payroll - Project Export Weekly</div>
        <div><img src="{{asset('images/LOGOtransSmall.png')}}" alt=""/></div>
    </div>
    <form wire:submit.prevent="exportPeriod">
        <div class="max-w-xl mx-auto">
            <div>Page content here.</div>
            <div class="mt-8 row flex justify-end space-x-4" style="width: 95%">
                <flux:button size="sm" type="button" href="{{route('project-hours')}}" class="text-sm px-2 py-1 bg-gray-700 text-gray-100 rounded" variant="primary">Back</flux::button>
                <flux:button size="sm" type="submit" class="text-sm px-2 py-1 bg-gray-700 text-gray-100 rounded">Export</flux::button>
            </div>
        </div>
    </form>
    {{-- Nothing in the world is as soft and yielding as water. --}}
</div>
