<?php

namespace App\Livewire;

use App\Models\Employee;
use App\Models\Hours;
use App\Models\Period;
use App\Traits\PeriodFunctionsTrait;
use App\Traits\ProjectHoursTrait;
use Carbon\Carbon;
use Flux\Flux;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Application;
use Livewire\Component;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx as WriteExcel;

class ProjectHoursEmployee extends Component
{
    public array $periods = [];
    public ?Period $period = null;
    public ?Employee $worker = null;
    public ?int $selectedPeriod = null;
    public ?int $selectedEmployee = null;
    public ?string $selectedWeek = null;
    public ?string $title = null;
    public array $weeks = [];
    public array $employees = [];
    public array $projectHours = [];
    public bool $showProjectHours = false;


    use ProjectHoursTrait;
    use PeriodFunctionsTrait;

    public function mount(): void{
        $this->employees = Employee::query()->where('current', true)->where('emp_no', '!=', null)->orderby('name')->get()->toArray();
        $this->periods = Period::query()->where('current', false)->orderby('id', 'desc')->get()->toArray();
    }

    public function updatedSelectedPeriod($id): void
    {
        $this->weeks = [];
        $this->period = Period::query()->where('id', $id)->first();
        $this->weeks = $this->setPeriod($this->period);
    }

    public function exportPeriod(): void{
        $hours = null;
        $this->validate([
            'selectedPeriod' => 'numeric|required',
            'selectedWeek' => 'required',
            'selectedEmployee' => 'numeric|required',
        ],
            [
                'selectedPeriod' => 'Please select a period.',
                'selectedWeek' => 'Please select a week.',
            ]);
        $this->worker = Employee::query()->where('emp_no', $this->selectedEmployee)->first();
        if($this->selectedWeek == "AllWeeks")
        {
            $this->title = "All Weeks Period ".$this->period->month."-".$this->period->year;
            $hours = $this->getPeriod($this->selectedEmployee);
        } else {
            $this->title = "Weekending ".Carbon::parse($this->selectedWeek)->format('d-m-Y')." - Period ".$this->period->month."-".$this->period->year;
            $hours = $this->getWeek($this->selectedEmployee);
        }
        $projectHours = $this->getProjectHours($hours);

        $this->createProjectHours($projectHours);
    }

    public function createProjectHours($projectHours): void
    {
//        $templatePath = storage_path('project_hours.xlsx');
//        $reader = IOFactory::createReader(IOFactory::identify($templatePath));
//        $reader->setLoadAllSheets();
//        $import = $reader->load($templatePath);
//        $sheet = $import->setActiveSheetIndexByName('Project Hours');
        $this->projectHours = $projectHours;
        Flux::modal('project-hours')->show();
    }

    public function exportToExcel(): void
    {
        $templatePath = storage_path('SingleEmployeeProjectHours.xlsx');
        $reader = IOFactory::createReader(IOFactory::identify($templatePath));
        $reader->setLoadAllSheets();
        $import = $reader->load($templatePath);
        $sheet = $import->setActiveSheetIndexByName('Sheet1');
        $sheet->setCellValue("E1", $this->worker->name);
        $sheet->setCellValue("E2", $this->title);
        $sheet->setCellValue("B6", 'Job Number');
        $sheet->getStyle('B6')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('B6')
            ->getBorders()
            ->getOutline()
            ->setBorderStyle(Border::BORDER_THIN)
            ->setColor(new Color(Color::COLOR_BLACK));
        $sheet->setCellValue("C6", 'Hours');
        $sheet->getStyle('C6')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('C6')
            ->getBorders()
            ->getOutline()
            ->setBorderStyle(Border::BORDER_THIN)
            ->setColor(new Color(Color::COLOR_BLACK));
        $i = 6;
        foreach($this->projectHours as $key => $hours)
        {
            $i = $i + 1;
            $sheet->setCellValue("B".$i, $key);
            $sheet->getStyle("B".$i)
            ->getBorders()
            ->getOutline()
            ->setBorderStyle(Border::BORDER_THIN)
            ->setColor(new Color(Color::COLOR_BLACK));
            $sheet->setCellValue("C".$i, $hours);
            $sheet->getStyle("C".$i)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_THIN)
                ->setColor(new Color(Color::COLOR_BLACK));
        }
        if(!file_exists("C:/EPS Payroll/"))
        {
            mkdir("C:/EPS Payroll/", 0777, true);
        }
        $filename = "C:/EPS Payroll/".$this->worker->name." - ".$this->title.'.xlsx';
        $import->getProperties()->setCreator('EPS Payroll')->setLastModifiedBy('EPS Payroll');
        $writer = new WriteExcel($import);
        try {
            $writer->save($filename);
            flash()->option('position', 'bottom-right')->success("File output to $filename.");
        } catch(\Exception $e) {
            flash()->option('position', 'bottom-right')->warning("An open file with the same name already exists.");
        }
    }

    public function getPeriod($employeeId): array|Collection
    {
        $weeks = $this->setPeriod($this->period);
        return Hours::query()->whereIn('week_ending', $weeks)->where('emp_no', $employeeId)->get();
    }

    public function getWeek($employeeId): array|Collection
    {
        return Hours::query()->where('week_ending', $this->selectedWeek)->where('emp_no', $employeeId)->get();

    }

    public function render(): View|Application|\Illuminate\View\View
    {
        return view('livewire.project-hours-employee');
    }
}
