<div>
    <form wire:submit.prevent="save()">
        <div class="mb-16 row flex justify-between items-center">
            <div class="text-2xl font-bold text-gray-600">EPS Payroll - New Starter</div>
            <div><img src="{{asset('images/LOGOtransSmall.png')}}" alt=""/></div>
        </div>
        <div class="space-y-6">
            <div class="max-w-xl mx-auto">
                <flux:input wire:model="name" label="Name"></flux:input>
            </div>

            <div class="max-w-xl mx-auto">
                <flux:select wire:model="company" label="Company" placeholder="Please Select...">
                    <option value="c">City Loo Hire</option>
                    <option value="e">EPS</option>
                </flux:select>

            </div>
            <div class="max-w-xl mx-auto">
                <flux:field>
                    <flux:label>Employee Number</flux:label>
                    <flux:description class="italic text-xs">This must match the employee number in the site managers application.</flux:description>
                    <flux:input type="number" step="1" min="1" max="9999" wire:model="employeeNumber"></flux:input>
                    <flux:error name="employeeNumber"></flux:error>
                </flux:field>

            </div>
            <div class="mt-16 max-w-xl mx-auto row flex justify-end space-x-4">
                <flux:button type="button" wire:click="back()" variant="primary">Cancel</flux:button>
                <flux:button type="submit">Save</flux:button>
            </div>
        </div>
    </form>

</div>
