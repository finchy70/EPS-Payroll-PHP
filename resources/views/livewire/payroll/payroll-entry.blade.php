<div>
    <div class="mb-4 row flex justify-between items-center">
        <div class="text-2xl font-bold text-gray-600">EPS Payroll - Hours Entry</div>
        <div><img src="{{asset('images/LOGOtransSmall.png')}}" alt=""/></div>
    </div>
    <div class="my-2 text-sm text-red-500 italic font-bold">{{$info}}</div>

    <div class="row flex justify-between items-center">
        <div class="flex items-center">
            <div class="text-xs">Employee</div>
            <input class="ml-2 p-1 text-xs border border-gray-700 bg-white text-center" type="text" readonly value="{{$employeeName}}"/>
        </div>
        <div class="flex items-center">
            <div class="text-xs">Week Ending</div>
            <input class="ml-2 p-1 text-xs border border-gray-700 bg-white text-center" type="text" readonly value="{{$weekEnding}}"/>
        </div>
        <div class="flex items-center">
            <div class="text-xs">Week Number</div>
            <input class="ml-2 p-1 text-xs border border-gray-700 bg-white text-center" type="text" readonly value="{{$weekNumber}}"/>
        </div>
    </div>

    <form wire:submit.prevent="save">
        <div class="mt-4 grid grid-cols-12 gap-0.5 text-xs items-center">
            <div class="col-span-1">

            </div>
            <div class="col-span-1">
                Hours
            </div>

            <div class="col-span-1">
                Job Number
            </div>

            <div class="col-span-5">
                Site
            </div>
            <div class="col-span-2">
                Total Hours - Break
            </div>
            <div class="col-span-2">
                Total
            </div>
            <div class="col-span-1">
                Monday
            </div>
            <div class="col-span-1">
                <input type="number" class="p-1 bg-white text-xs border border-gray-700 w-full" step="0.25" min="0.00" wire:model.blur="hoursMon1"/>
            </div>
            <div class="col-span-1">
                <input type="number" step="1" min="1000" class="p-1 bg-white text-xs border border-gray-700 w-full" wire:model.blur="jobMon1"/>
            </div>
            <div class="col-span-5">
                <input type="text" readonly class="p-1 bg-gray-200 text-xs border border-gray-700 w-full" wire:model="siteMon1"/>
            </div>
            <div class="col-span-2">
                <input type="text" readonly class="p-1 bg-white text-xs border border-gray-700 w-full" value="{{$totalHoursBreakMon}}"/>
            </div>
            <div class="col-span-2">
                <input type="number" readonly class="p-1 bg-white text-xs border border-gray-700 w-full" step="0.25" min="0.00" value="{{$monTotal}}"/>
            </div>
            <div class="col-span-1">

            </div>
            <div class="col-span-1">
                <input type="number" class="p-1 bg-white text-xs border border-gray-700 w-full" step="0.25" min="0.00" wire:model.blur="hoursMon2"/>
            </div>
            <div class="col-span-1">
                <input type="number" step="1" class="p-1 bg-white text-xs border border-gray-700 w-full" min="1000" wire:model.blur="jobMon2"/>
            </div>
            <div class="col-span-5">
                <input type="text" readonly class="p-1 bg-gray-200 text-xs border border-gray-700 w-full" wire:model="siteMon2"/>
            </div>
            <div class="col-span-2">
                <input type="number" readonly class="p-1 bg-white text-xs border border-gray-700 w-full" step="0.25" min="0.00" value="{{$totalHoursMon2}}"/>
            </div>
            <div class="col-span-1 text-right">
                Overnight?
            </div>
            <div class="col-span-1">
                <select class="ml-2 bg-white border-1 rounded-lg p-1" wire:model.boolean="monOvernight">
                    <option value="false">No</option>
                    <option value="true">Yes</option>
                </select>
            </div>

            <div class="col-span-1">

            </div>
            <div class="col-span-1">
                <input type="number" class="p-1 bg-white text-xs border border-gray-700 w-full" step="0.25" min="0.00" wire:model.blur="hoursMon3"/>
            </div>
            <div class="col-span-1">
                <input type="number" class="p-1 bg-white text-xs border border-gray-700 w-full" step="1" min="1000" wire:model.blur="jobMon3"/>
            </div>
            <div class="col-span-5">
                <input type="text" readonly class="p-1 bg-gray-200 text-xs border border-gray-700 w-full" wire:model="siteMon3"/>
            </div>
            <div class="col-span-2">
                <input type="number" readonly class="p-1 bg-white text-xs border border-gray-700 w-full" step="0.25" min="0.00" value="{{$totalHoursMon3}}"/>
            </div>
            <div class="col-span-2">

            </div>
            <div class="col-span-1 mt-1">
                Tuesday
            </div>
            <div class="col-span-1">
                <input type="number" class="p-1 bg-white text-xs border border-gray-700 w-full" step="0.25" min="0.00" wire:model.blur="hoursTues1"/>
            </div>
            <div class="col-span-1">
                <input type="number" class="p-1 bg-white text-xs border border-gray-700 w-full" step="1" min="1000" wire:model.blur="jobTues1"/>
            </div>
            <div class="col-span-5">
                <input type="text" readonly class="p-1 bg-gray-200 text-xs border border-gray-700 w-full" wire:model="siteTues1"/>
            </div>
            <div class="col-span-2">
                <input type="number" readonly class="p-1 bg-white text-xs border border-gray-700 w-full" step="0.25" min="0.00" value="{{$totalHoursBreakTues}}"/>
            </div>
            <div class="col-span-2">
                <input type="number" readonly class="p-1 bg-white text-xs border border-gray-700 w-full" step="0.25" min="0.00" value="{{$tuesTotal}}"/>
            </div>
            <div class="col-span-1">

            </div>
            <div class="col-span-1">
                <input type="number" class="p-1 bg-white text-xs border border-gray-700 w-full" step="0.25" min="0.00" wire:model.blur="hoursTues2"/>
            </div>
            <div class="col-span-1">
                <input type="number" class="p-1 bg-white text-xs border border-gray-700 w-full" step="1" min="1000" wire:model.blur="jobTues2"/>
            </div>
            <div class="col-span-5">
                <input type="text" readonly class="p-1 bg-gray-200 text-xs border border-gray-700 w-full" wire:model="siteTues2"/>
            </div>
            <div class="col-span-2">
                <input type="number" readonly class="p-1 bg-white text-xs border border-gray-700 w-full" step="0.25" min="0.00" value="{{$totalHoursTues2}}"/>
            </div>
            <div class="col-span-1 text-right">
                Overnight?
            </div>
            <div class="col-span-1">
                <select class="ml-2 bg-white border-1 rounded-lg p-1" wire:model.boolean="tueOvernight">
                    <option value="false">No</option>
                    <option value="true">Yes</option>
                </select>
            </div>
            <div class="col-span-1">

            </div>
            <div class="col-span-1">
                <input type="number" class="p-1 bg-white text-xs border border-gray-700 w-full" step="0.25" min="0.00" wire:model.blur="hoursTues3"/>
            </div>
            <div class="col-span-1">
                <input type="number" class="p-1 bg-white text-xs border border-gray-700 w-full" step="1" min="1000" wire:model.blur="jobTues3"/>
            </div>
            <div class="col-span-5">
                <input type="text" readonly class="p-1 bg-gray-200 text-xs border border-gray-700 w-full" wire:model="siteTues3"/>
            </div>
            <div class="col-span-2">
                <input type="number" readonly class="p-1 bg-white text-xs border border-gray-700 w-full" step="0.25" min="0.00" value="{{$totalHoursTues3}}"/>
            </div>
            <div class="col-span-2">

            </div>
            <div class="col-span-1 mt-1">
                Wednesday
            </div>
            <div class="col-span-1">
                <input type="number" class="p-1 bg-white text-xs border border-gray-700 w-full" step="0.25" min="0.00" wire:model.blur="hoursWed1"/>
            </div>
            <div class="col-span-1">
                <input type="number" class="p-1 bg-white text-xs border border-gray-700 w-full" step="1" min="1000" wire:model.blur="jobWed1"/>
            </div>
            <div class="col-span-5">
                <input type="text" readonly class="p-1 bg-gray-200 text-xs border border-gray-700 w-full" wire:model="siteWed1"/>
            </div>
            <div class="col-span-2">
                <input type="number" readonly class="p-1 bg-white text-xs border border-gray-700 w-full" step="0.25" min="0.00" value="{{$totalHoursBreakWed}}"/>
            </div>
            <div class="col-span-2">
                <input type="number" readonly class="p-1 bg-white text-xs border border-gray-700 w-full" step="0.25" min="0.00" value="{{$wedTotal}}"/>
            </div>
            <div class="col-span-1">

            </div>
            <div class="col-span-1">
                <input type="number" class="p-1 bg-white text-xs border border-gray-700 w-full" step="0.25" min="0.00" wire:model.blur="hoursWed2"/>
            </div>
            <div class="col-span-1">
                <input type="number" class="p-1 bg-white text-xs border border-gray-700 w-full" step="1" min="1000" wire:model.blur="jobWed2"/>
            </div>
            <div class="col-span-5">
                <input type="text" readonly class="p-1 bg-gray-200 text-xs border border-gray-700 w-full" wire:model="siteWed2"/>
            </div>
            <div class="col-span-2">
                <input type="number" readonly class="p-1 bg-white text-xs border border-gray-700 w-full" step="0.25" min="0.00" value="{{$totalHoursWed2}}"/>
            </div>
            <div class="col-span-1 text-right">
                Overnight?
            </div>
            <div class="col-span-1">
                <select class="ml-2 bg-white border-1 rounded-lg p-1" wire:model.boolean="wedOvernight">
                    <option value="false">No</option>
                    <option value="true">Yes</option>
                </select>
            </div>
            <div class="col-span-1">

            </div>
            <div class="col-span-1">
                <input type="number" class="p-1 bg-white text-xs border border-gray-700 w-full" step="0.25" min="0.00" wire:model.blur="hoursWed3"/>
            </div>
            <div class="col-span-1">
                <input type="number" class="p-1 bg-white text-xs border border-gray-700 w-full" step="1" min="1000" wire:model.blur="jobWed3"/>
            </div>
            <div class="col-span-5">
                <input type="text" readonly class="p-1 bg-gray-200 text-xs border border-gray-700 w-full" wire:model="siteWed3"/>
            </div>
            <div class="col-span-2">
                <input type="number" readonly class="p-1 bg-white text-xs border border-gray-700 w-full" step="0.25" min="0.00" value="{{$totalHoursWed3}}"/>
            </div>
            <div class="col-span-2">

            </div>
            <div class="col-span-1 mt-1">
                Thursday
            </div>
            <div class="col-span-1">
                <input type="number" class="p-1 bg-white text-xs border border-gray-700 w-full" step="0.25" min="0.00" wire:model.blur="hoursThurs1"/>
            </div>
            <div class="col-span-1">
                <input type="number" class="p-1 bg-white text-xs border border-gray-700 w-full" step="1" min="1000" wire:model.blur="jobThurs1"/>
            </div>
            <div class="col-span-5">
                <input type="text" readonly class="p-1 bg-gray-200 text-xs border border-gray-700 w-full" wire:model="siteThurs1"/>
            </div>
            <div class="col-span-2">
                <input type="number" readonly class="p-1 bg-white text-xs border border-gray-700 w-full" step="0.25" min="0.00" value="{{$totalHoursBreakThurs}}"/>
            </div>
            <div class="col-span-2">
                <input type="number" readonly class="p-1 bg-white text-xs border border-gray-700 w-full" step="0.25" min="0.00" value="{{$thursTotal}}"/>
            </div>
            <div class="col-span-1">

            </div>
            <div class="col-span-1">
                <input type="number" class="p-1 bg-white text-xs border border-gray-700 w-full" step="0.25" min="0.00" wire:model.blur="hoursThurs2"/>
            </div>
            <div class="col-span-1">
                <input type="number" class="p-1 bg-white text-xs border border-gray-700 w-full" step="1" min="1000" wire:model.blur="jobThurs2"/>
            </div>
            <div class="col-span-5">
                <input type="text" readonly class="p-1 bg-gray-200 text-xs border border-gray-700 w-full" wire:model="siteThurs2"/>
            </div>
            <div class="col-span-2">
                <input type="number" readonly class="p-1 bg-white text-xs border border-gray-700 w-full" step="0.25" min="0.00" value="{{$totalHoursThurs2}}"/>
            </div>
            <div class="col-span-1 text-right">
                Overnight?
            </div>
            <div class="col-span-1">
                <select class="ml-2 bg-white border-1 rounded-lg p-1" wire:model.boolean="thuOvernight">
                    <option value="false">No</option>
                    <option value="true">Yes</option>
                </select>
            </div>
            <div class="col-span-1">

            </div>
            <div class="col-span-1">
                <input type="number" class="p-1 bg-white text-xs border border-gray-700 w-full" step="0.25" min="0.00" wire:model.blur="hoursThurs3"/>
            </div>
            <div class="col-span-1">
                <input type="number" class="p-1 bg-white text-xs border border-gray-700 w-full" step="1" min="1000" wire:model.blur="jobThurs3"/>
            </div>
            <div class="col-span-5">
                <input type="text" readonly class="p-1 bg-gray-200 text-xs border border-gray-700 w-full" wire:model="siteThurs3"/>
            </div>
            <div class="col-span-2">
                <input type="number" readonly class="p-1 bg-white text-xs border border-gray-700 w-full" step="0.25" min="0.00" value="{{$totalHoursThurs3}}"/>
            </div>
            <div class="col-span-2">

            </div>
            <div class="col-span-1 mt-1">
                Friday
            </div>
            <div class="col-span-1">
                <input type="number" class="p-1 bg-white text-xs border border-gray-700 w-full" step="0.25" min="0.00" wire:model.blur="hoursFri1"/>
            </div>
            <div class="col-span-1">
                <input type="number" class="p-1 bg-white text-xs border border-gray-700 w-full" step="1" min="1000" wire:model.blur="jobFri1"/>
            </div>
            <div class="col-span-5">
                <input type="text" readonly class="p-1 bg-gray-200 text-xs border border-gray-700 w-full" wire:model="siteFri1"/>
            </div>
            <div class="col-span-2">
                <input type="number" readonly class="p-1 bg-white text-xs border border-gray-700 w-full" step="0.25" min="0.00" value="{{$totalHoursBreakFri}}"/>
            </div>
            <div class="col-span-2">
                <input type="number" readonly class="p-1 bg-white text-xs border border-gray-700 w-full" step="0.25" min="0.00" value="{{$friTotal}}"/>
            </div>
            <div class="col-span-1">

            </div>
            <div class="col-span-1">
                <input type="number" class="p-1 bg-white text-xs border border-gray-700 w-full" step="0.25" min="0.00" wire:model.blur="hoursFri2"/>
            </div>
            <div class="col-span-1">
                <input type="number" class="p-1 bg-white text-xs border border-gray-700 w-full" step="1" min="1000" wire:model.blur="jobFri2"/>
            </div>
            <div class="col-span-5">
                <input type="text" readonly class="p-1 bg-gray-200 text-xs border border-gray-700 w-full" wire:model="siteFri2"/>
            </div>
            <div class="col-span-2">
                <input type="number" readonly class="p-1 bg-white text-xs border border-gray-700 w-full" step="0.25" min="0.00" value="{{$totalHoursFri2}}"/>
            </div>
            <div class="col-span-1 text-right">
                Overnight?
            </div>
            <div class="col-span-1">
                <select class="ml-2 bg-white border-1 rounded-lg p-1" wire:model.boolean="friOvernight">
                    <option value="false">No</option>
                    <option value="true">Yes</option>
                </select>
            </div>
            <div class="col-span-1">

            </div>
            <div class="col-span-1">
                <input type="number" class="p-1 bg-white text-xs border border-gray-700 w-full" step="0.25" min="0.00" wire:model.blur="hoursFri3"/>
            </div>
            <div class="col-span-1">
                <input type="number" class="p-1 bg-white text-xs border border-gray-700 w-full" step="1" min="1000" wire:model.blur="jobFri3"/>
            </div>
            <div class="col-span-5">
                <input type="text" readonly class="p-1 bg-gray-200 text-xs border border-gray-700 w-full" wire:model="siteFri3"/>
            </div>
            <div class="col-span-2">
                <input type="number" readonly class="p-1 bg-white text-xs border border-gray-700 w-full" step="0.25" min="0.00" value="{{$totalHoursFri3}}"/>
            </div>
            <div class="col-span-2">

            </div>
            <div class="col-span-1 mt-1">
                Saturday
            </div>
            <div class="col-span-1">
                <input type="number" class="p-1 bg-white text-xs border border-gray-700 w-full" step="0.25" min="0.00" wire:model.blur="hoursSat1"/>
            </div>
            <div class="col-span-1">
                <input type="number" class="p-1 bg-white text-xs border border-gray-700 w-full" step="1" min="1000" wire:model.blur="jobSat1"/>
            </div>
            <div class="col-span-5">
                <input type="text" readonly class="p-1 bg-gray-200 text-xs border border-gray-700 w-full" wire:model="siteSat1"/>
            </div>
            <div class="col-span-2">
                <input type="number" readonly class="p-1 bg-white text-xs border border-gray-700 w-full" step="0.25" min="0.00" value="{{$totalHoursBreakSat}}"/>
            </div>
            <div class="col-span-2">
                <input type="number" readonly class="p-1 bg-white text-xs border border-gray-700 w-full" step="0.25" min="0.00" value="{{$satTotal}}"/>
            </div>
            <div class="col-span-1">

            </div>
            <div class="col-span-1">
                <input type="number" class="p-1 bg-white text-xs border border-gray-700 w-full" step="0.25" min="0.00" wire:model.blur="hoursSat2"/>
            </div>
            <div class="col-span-1">
                <input type="number" class="p-1 bg-white text-xs border border-gray-700 w-full" step="1" min="1000" wire:model.blur="jobSat2"/>
            </div>
            <div class="col-span-5">
                <input type="text" readonly class="p-1 bg-gray-200 text-xs border border-gray-700 w-full" wire:model="siteSat2"/>
            </div>
            <div class="col-span-2">
                <input type="number" readonly class="p-1 bg-white text-xs border border-gray-700 w-full" step="0.25" min="0.00" value="{{$totalHoursSat2}}"/>
            </div>
            <div class="col-span-1 text-right">
                Overnight?
            </div>
            <div class="col-span-1">
                <select class="ml-2 bg-white border-1 rounded-lg p-1" wire:model.boolean="satOvernight">
                    <option value="false">No</option>
                    <option value="true">Yes</option>
                </select>
            </div>
            <div class="col-span-1">

            </div>
            <div class="col-span-1">
                <input type="number" class="p-1 bg-white text-xs border border-gray-700 w-full" step="0.25" min="0.00" wire:model.blur="hoursSat3"/>
            </div>
            <div class="col-span-1">
                <input type="number" class="p-1 bg-white text-xs border border-gray-700 w-full" step="1" min="1000" wire:model.blur="jobSat3"/>
            </div>
            <div class="col-span-5">
                <input type="text" readonly class="p-1 bg-gray-200 text-xs border border-gray-700 w-full" wire:model="siteSat3"/>
            </div>
            <div class="col-span-2">
                <input type="number" readonly class="p-1 bg-white text-xs border border-gray-700 w-full" step="0.25" min="0.00" value="{{$totalHoursSat3}}"/>
            </div>
            <div class="col-span-2">

            </div>
            <div class="col-span-1 mt-1">
                Sunday
            </div>
            <div class="col-span-1">
                <input type="number" class="p-1 bg-white text-xs border border-gray-700 w-full" step="0.25" min="0.00" wire:model.blur="hoursSun1"/>
            </div>
            <div class="col-span-1">
                <input type="number" class="p-1 bg-white text-xs border border-gray-700 w-full" step="1" min="1000" wire:model.blur="jobSun1"/>
            </div>
            <div class="col-span-5">
                <input type="text" readonly class="p-1 bg-gray-200 text-xs border border-gray-700 w-full" wire:model="siteSun1"/>
            </div>
            <div class="col-span-2">
                <input type="number" readonly class="p-1 bg-white text-xs border border-gray-700 w-full" step="0.25" min="0.00" value="{{$totalHoursBreakSun}}"/>
            </div>
            <div class="col-span-2">
                <input type="number" readonly class="p-1 bg-white text-xs border border-gray-700 w-full" step="0.25" min="0.00" value="{{$sunTotal}}"/>
            </div>
            <div class="col-span-1">

            </div>
            <div class="col-span-1">
                <input type="number" class="p-1 bg-white text-xs border border-gray-700 w-full" step="0.25" min="0.00" wire:model.blur="hoursSun2"/>
            </div>

            <div class="col-span-1">
                <input type="number" class="p-1 bg-white text-xs border border-gray-700 w-full" step="1" min="1000" wire:model.blur="jobSun2"/>
            </div>
            <div class="col-span-5">
                <input type="text" readonly class="p-1 bg-gray-200 text-xs border border-gray-700 w-full" wire:model="siteSun2"/>
            </div>
            <div class="col-span-2">
                <input type="number" readonly class="p-1 bg-white text-xs border border-gray-700 w-full" step="0.25" min="0.00" value="{{$totalHoursSun2}}"/>
            </div>
            <div class="col-span-1 text-right">
                Overnight?
            </div>
            <div class="col-span-1">
                <select class="ml-2 bg-white border-1 rounded-lg p-1" wire:model.boolean="sunOvernight">
                    <option value="false">No</option>
                    <option value="true">Yes</option>
                </select>
            </div>
            <div class="col-span-1">

            </div>
            <div class="col-span-1">
                <input type="number" class="p-1 bg-white text-xs border border-gray-700 w-full" step="0.25" min="0.00" wire:model.blur="hoursSun3"/>
            </div>
            <div class="col-span-1">
                <input type="number" class="p-1 bg-white text-xs border border-gray-700 w-full" step="1" min="1000" wire:model.blur="jobSun3"/>
            </div>
            <div class="col-span-5">
                <input type="text" readonly class="p-1 bg-gray-200 text-xs border border-gray-700 w-full" wire:model="siteSun3"/>
            </div>
            <div class="col-span-2">
                <input type="number" readonly class="p-1 bg-white text-xs border border-gray-700 w-full" step="0.25" min="0.00" value="{{$totalHoursSun3}}"/>
            </div>
            <div class="col-span-2">

            </div>
        </div>
        <div class="fixed bottom-3" style="width: 95%">
            <div class="grid grid-cols-12 gap-4 text-xs items-center">
                <div class="col-span-1 text-right">Expenses £</div>
                <div class="col-span-1"><input class="p-1 bg-white text-xs border border-gray-700 w-full" type="number" step="0.01" min="0.00" wire:model="expenses"/></div>
                <div class="col-span-1 text-right">Late Return?</div>
                <div class="col-span-1">
                    <select name="late" id="late" class="p-1 bg-white text-xs border border-gray-700 w-full" wire:model.boolean="late">
                        <option value="false">No</option>
                        <option value="true">Yes</option>
                    </select>
                </div>
                <div class="col-span-1 text-right">Bonus Hours</div>
                <div class="col-span-1"><input class="p-1 bg-white text-xs border border-gray-700 w-full" type="number" step="0.01" min="0.00" wire:model="bonusHours"/></div>
                <div class="col-span-6">
                    <div class="flex justify-end items-center w-full space-x-4">
                        <flux:button variant="primary" size="xs" wire:click="back">Back</flux:button>
                        <flux:button type="button" size="xs" wire:click="save">Save</flux:button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
