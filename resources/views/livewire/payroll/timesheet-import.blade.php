<div>
    <div class="mb-4 row flex justify-between items-center">
        <div class="text-2xl font-bold text-gray-600">EPS Payroll - Timesheet Import</div>
        <div><img src="{{asset('images/LOGOtransSmall.png')}}" alt=""/></div>
    </div>
    <div class="mt-6 space-y-4">
        <p class="text-center text-red-500 font-bold">This will import all the timesheets for the period {{$periodString}}.</p>
        <div class="mt-16 row justify-end flex space-x-6">
            <flux:button wire:click="back" variant="primary">Back</flux:button>
            <flux:button wire:click="importAllTimesheets">Import Timesheets for {{$periodString}}</flux:button>
        </div>
    </div>


    <flux:modal name="import-timesheets" class="md:w-1/2">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Confirm Import!</flux:heading>
                <flux:text class="mt-6 text-center">Are you sure you want to import the timesheets for<br><span class="!font-bold !text-black">{{$periodString}}</span> ?</flux:text>
            </div>
            <div class="row flex justify-end space-x-4">
                <flux:button wire:click="cancelTimesheetImport()">Cancel</flux:button>
                <flux:button wire:click="confirmTimesheetImport()" variant="danger">Import</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
