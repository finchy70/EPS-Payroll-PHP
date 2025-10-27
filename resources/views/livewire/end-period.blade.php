<div>
    <div class="mb-16 row flex justify-between items-center">
        <div class="text-3xl font-bold text-gray-600">EPS Payroll - End Period</div>
        <div><img src="{{asset('images/LOGOtransSmall.png')}}" alt=""/></div>
    </div>
    <div class="flex row justify-center items-center">
        <div>Current Period</div>
        <input type="text" class="ml-4 p-1 bg-white border border-gray-300 rounded text-center font-bold" readonly value="{{$period}}"/>
    </div>
    <div class="text-gray-900 font-bold text-center mt-12">Please ensure all data for the current period has been entered correctly.</div>
    <div class="mt-8 row flex justify-end space-x-4" style="width: 95%">
        <flux:button size="sm" href="{{route('setup.menu')}}" class="text-sm px-2 py-1 bg-gray-700 text-gray-100 rounded" variant="primary">Back</flux::button>
        <flux:button size="sm" type="button" wire:click="endPeriod" class="text-sm px-2 py-1 bg-gray-700 text-gray-100 rounded">End Period</flux::button>
    </div>



    <flux:modal name="end-period-modal" class="text-sm md:w-96 p-4">
        <form wire:submit.prevent="saveNewPeriod">
            <div class="space-y-4">
                <div>
                    <flux:heading size="sm">End Period {{$period}}</flux:heading>
                    <flux:text class="mt-2 text-xs" size="xs">Are you sure all period data is correct?</flux:text>
                </div>

                <flux:select wire:model.live='numberOfWeeks' label="Number of weeks in next period?">
                    <flux:select.option value="{{null}}">Please Select...</flux:select.option>
                    <flux:select.option value="4">4</flux:select.option>
                    <flux:select.option value="5">5</flux:select.option>
                </flux:select>
                @if($numberOfWeeks != null)
                    <flux:label class="!font-bold">Week Ending List</flux:label>
                <div class="grid grid-cols-2 gap-4">
                    <div class="text-xs text-right !font-bold text-gray-900">Week 1</div>
                    <div class="text-xs !font-bold text-gray-900">{{Carbon\Carbon::parse($this->weekEnding1)->format('d-m-Y')}}</div>
                    <div class="text-xs text-right !font-bold text-gray-900">Week 2</div>
                    <div class="text-xs !font-bold text-gray-900">{{Carbon\Carbon::parse($this->weekEnding2)->format('d-m-Y')}}</div>
                    <div class="text-xs text-right !font-bold text-gray-900">Week 3</div>
                    <div class="text-xs !font-bold text-gray-900">{{Carbon\Carbon::parse($this->weekEnding3)->format('d-m-Y')}}</div>
                    <div class="text-xs text-right !font-bold text-gray-900">Week 4</div>
                    <div class="text-xs !font-bold text-gray-900">{{Carbon\Carbon::parse($this->weekEnding4)->format('d-m-Y')}}</div>
                    @if($weekEnding5 != null)
                        <div class="text-xs text-right !font-bold text-gray-900">Week 5</div>
                        <div class="text-xs !font-bold text-gray-900">{{Carbon\Carbon::parse($this->weekEnding5)->format('d-m-Y')}}</div>
                    @endif
                @endif
                <div class="flex space-x-2">
                    <flux:spacer />
                    <div class="row flex justify-end">
                        <flux:button x-on:click="$flux.modal('end-period-modal').close()" size='sm' class="text-xs" variant="primary">Cancel</flux:button>
                        <flux:button type="submit" size='sm' class="ml-2 text-xs" variant="outline">End Period</flux:button>
                    </div>
                </div>
            </div>
        </form>
    </flux:modal>
</div>
