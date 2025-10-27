<?php

namespace App\Livewire;

use App\Models\Employee;
use App\Models\Hours;
use App\Models\Period;
use App\Traits\PeriodFunctionsTrait;
use App\Traits\ProjectHoursTrait;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Application;
use Livewire\Component;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx as WriteExcel;

class ProjectExport extends Component
{
    public array $periods = [];
    public ?Period $period = null;
    public ?int $selectedPeriod = null;
    public ?string $selectedWeek = null;
    public ?string $title = null;
    public array $weeks = [];

    use ProjectHoursTrait;
    use PeriodFunctionsTrait;

    public function mount(): void{
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
        ],
        [
            'selectedPeriod' => 'Please select a period.',
            'selectedWeek' => 'Please select a week.',
        ]);
        if($this->selectedWeek == "AllWeeks")
        {
            $this->title = "All Weeks - Period ".$this->period->month."-".$this->period->year;
            $allHours = $this->getPeriod();
        } else {
            $this->title = "Weekending ".Carbon::parse($this->selectedWeek)->format('d-m-Y')." - Period ".$this->period->month."-".$this->period->year;
            $allHours = $this->getWeek();
        }
        $allHours = $allHours->groupBy('emp_no');
        $templatePath = storage_path('project_hours.xlsx');
        $reader = IOFactory::createReader(IOFactory::identify($templatePath));
        $reader->setLoadAllSheets();
        $import = $reader->load($templatePath);
        $sheet = $import->setActiveSheetIndexByName('Project Hours');
        $sheet->setCellValue("F1", $this->title);
        $sheet->getStyle('F1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $i = 6;
        foreach($allHours as $key => $hours)
        {
            $name = Employee::query()->where('emp_no', $key)->first()->name;
            $sheet->setCellValue("B".$i-1, $name);
            $sheet->getStyle('B'.$i-1)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('B'.$i-1)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_THIN)
                ->setColor(new Color(Color::COLOR_BLACK));

            $sheet->setCellValue("B".$i, 'Job Number');
            $sheet->getStyle('B'.$i)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('B'.$i)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_THIN)
                ->setColor(new Color(Color::COLOR_BLACK));
            $sheet->setCellValue("C".$i, 'Hours');
            $sheet->getStyle('C'.$i)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('C'.$i)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_THIN)
                ->setColor(new Color(Color::COLOR_BLACK));
            $projectHours = $this->getProjectHours($hours);
            foreach($projectHours as $key => $hour)
            {
                $i = $i + 1;
                $sheet->setCellValue("B".$i, $key);
                $sheet->getStyle('B'.$i)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('B'.$i)
                    ->getBorders()
                    ->getOutline()
                    ->setBorderStyle(Border::BORDER_THIN)
                    ->setColor(new Color(Color::COLOR_BLACK));
                $sheet->setCellValue("C".$i, $hour);
                $sheet->getStyle('C'.$i)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('C'.$i)
                    ->getBorders()
                    ->getOutline()
                    ->setBorderStyle(Border::BORDER_THIN)
                    ->setColor(new Color(Color::COLOR_BLACK));
            }
            $i = $i + 4;
        }
        if(!file_exists("C:/EPS Payroll/"))
        {
            mkdir("C:/EPS Payroll/", 0777, true);
        }
        $filename = "C:/EPS Payroll/All Employees - ".$this->title.'.xlsx';
        $import->getProperties()->setCreator('EPS Payroll')->setLastModifiedBy('EPS Payroll');
        $writer = new WriteExcel($import);
        try {
            $writer->save($filename);
            flash()->option('position', 'bottom-right')->success("File output to $filename.");
        } catch(\Exception $e) {
            flash()->option('position', 'bottom-right')->warning("File not created. An open file with the same name already exists.");
        }
    }

    public function createProjectHours($projectHours, $title)
    {

    }



    public function getWeek(): array|Collection
    {
        return Hours::query()->where('week_ending', $this->selectedWeek)->get();

    }

    public function getPeriod(): array|Collection
    {
        $weeks = [];
        $weeks[] = $this->period->we1;
        $weeks[] = $this->period->we2;
        $weeks[] = $this->period->we3;
        $weeks[] = $this->period->we4;
        if($this->period->we5 != null)
        {
            $weeks[] = $this->period->we5;
        }
        return Hours::query()->whereIn('week_ending', $weeks)->get();

    }


    public function render(): View|Application|\Illuminate\View\View
    {
        return view('livewire.project-export');
    }
}
