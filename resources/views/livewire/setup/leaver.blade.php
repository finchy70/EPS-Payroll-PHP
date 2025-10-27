<div>
    <div class="mb-16 row flex justify-between items-center">
        <div class="text-2xl font-bold text-gray-600">EPS Payroll - Create Leaver</div>
        <div><img src="{{asset('images/LOGOtransSmall.png')}}" alt=""/></div>
    </div>
    <div class="max-w-xl mx-auto">
        <flux:select wire:model="selectedLeaver" label="Name">
            <option value="{{null}}">Please Select Leaver...</option>
            @foreach($employees as $employee)
                <option value="{{$employee['id']}}">{{$employee['name']}}</option>
            @endforeach
        </flux:select>

    </div>
    <div class="mt-16 max-w-xl mx-auto row flex justify-end space-x-4">
        <flux:button type="button" wire:click="back()" variant="primary">Cancel</flux:button>
        <flux:button type="button" wire:click="save()">Save</flux:button>
    </div>
    <flux:modal name="leaver-modal" class="text-sm md:w-96 p-4">
        <div class="space-y-4">
            <div>
                <flux:heading size="sm">Confirm Leaver</flux:heading>
                <flux:text class="mt-4 text-xs text-center" size="xs">Are you sure you want to make {{$leaver?->name}} a leaver?<br><span class="text-xs italic text-red-500">You will no longer be able to process any hours for them.</span></flux:text>
            </div>

            <div class="flex space-x-2">
                <flux:spacer />
                <flux:button variant='primary' x-on:click="$flux.modal('leaver-modal').close()" size='sm' class="text-xs">Cancel</flux:button>
                <flux:button wire:click="confirm()" size='sm' class="text-xs" variant="outline">Confirm</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
