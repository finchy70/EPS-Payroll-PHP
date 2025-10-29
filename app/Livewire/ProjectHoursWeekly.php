<?php

namespace App\Livewire;

use App\Models\Employee;
use App\Models\Hours;
use App\Models\Period;
use App\Traits\PeriodFunctionsTrait;
use App\Traits\ProjectHoursTrait;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx as WriteExcel;

class ProjectHoursWeekly extends Component
{
    public array $periods = [];
    public array $weeks = [];
    public ?Period $period = null;
    public ?int $selectedPeriod;
    public ?string $selectedWeek;
    public string $title  = "";

    use PeriodFunctionsTrait;
    use ProjectHoursTrait;

    public function mount(): void
    {
        $this->periods = Period::query()->orderby('id', 'desc')->get()->toArray();
    }

    public function updatedSelectedPeriod($id): void
    {
        $this->weeks = [];
        $this->period = Period::query()->where('id', $id)->first();
        if($this->period != null){
            $this->weeks = $this->setPeriod($this->period);
        } else {
            $this->weeks = [];
        }
    }

    public function exportWeek(): void{
        $hours = null;
        $this->validate([
            'selectedPeriod' => 'numeric|required',
            'selectedWeek' => 'required',
        ],
            [
                'selectedPeriod' => 'Please select a period.',
                'selectedWeek' => 'Please select a week.',
            ]);

        $this->title = "WE ".Carbon::parse($this->selectedWeek)->format('d-m-Y');
        $hours = $this->getWeek();
        $groupedHours = $hours->groupBy('emp_no');
        $templatePath = storage_path('project_hours.xlsx');
        $reader = IOFactory::createReader(IOFactory::identify($templatePath));
        $reader->setLoadAllSheets();
        $import = $reader->load($templatePath);
        $sheet = $import->setActiveSheetIndexByName('Project Hours');
        $sheet->setCellValue("F1", $this->title);
        $sheet->getStyle('F1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $i = 6;
        foreach($groupedHours as $key => $hours)
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
        $filename = "C:/EPS Payroll/Project Weekly Hours-".$this->title.'.xlsx';
        $import->getProperties()->setCreator('EPS Payroll')->setLastModifiedBy('EPS Payroll');
        $writer = new WriteExcel($import);
        try {
            $writer->save($filename);
            flash()->option('position', 'bottom-right')->success("File output to $filename.");
        } catch(\Exception $e) {
            Log::error($e->getMessage());
            flash()->option('position', 'bottom-right')->warning("File not created. An open file with the same name already exists.");
        }


    }

    public function getWeek(): Collection
    {
        return Hours::query()->where('week_ending', $this->selectedWeek)->get();
    }
    public function render(): View|Factory|\Illuminate\View\View
    {
        return view('livewire.project-hours-weekly');
    }
}
