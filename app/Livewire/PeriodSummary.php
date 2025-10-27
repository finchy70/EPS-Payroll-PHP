<?php

namespace App\Livewire;

use App\Models\Hours;
use App\Models\Period;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx as WriteExcel;

class PeriodSummary extends Component
{
    public array $periods = [];
    public ?int $selectedPeriod = null;
    public float $totalStandard = 0;
    public float $totalSat = 0;
    public float $totalSun = 0;
    public float $totalExpenses = 0;

    public function selectPeriod(): void
    {
        $this->validate(['selectedPeriod' => 'numeric|required'],
            ['selectedPeriod' => 'You must select a period.']);

        $period = Period::query()->find($this->selectedPeriod);
        $weekEndings = [$period->we1, $period->we2, $period->we3, $period->we4];
        if ($period->we5 != null) {
            $weekEndings[] = $period->we5;
        }
        $allHours = Hours::query()->whereIn('week_ending', $weekEndings)->orderBy('emp_no')->get()->groupBy('emp_no');
        $templatePath = storage_path('period_summary.xlsx');
        $reader = IOFactory::createReader(IOFactory::identify($templatePath));
        $reader->setLoadAllSheets();
        $import = $reader->load($templatePath);
        $sheet = $import->setActiveSheetIndexByName('Sheet1');
        $i = 7;

        $sheet->setCellValue("G" . 1, $period->month.' - '.$period->year);
        $sheet->getStyle('G' . 1)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('G' . 1)
            ->getBorders()
            ->getOutline()
            ->setBorderStyle(Border::BORDER_THIN)
            ->setColor(new Color(Color::COLOR_BLACK));

        foreach ($allHours as $key => $hours) {
            $name = $hours[0]->employee;
            $employeeNumber = $key;
//            $sheet->setCellValue("A" . $i, 'Name:');
//            $sheet->getStyle('A' . $i)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
//            $sheet->getStyle('A' . $i)
//                ->getBorders()
//                ->getOutline()
//                ->setBorderStyle(Border::BORDER_THIN)
//                ->setColor(new Color(Color::COLOR_BLACK));
            $sheet->setCellValue("B" . $i, $name);
            $sheet->getStyle('B' . $i)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('B' . $i)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_THIN)
                ->setColor(new Color(Color::COLOR_BLACK));
            $sheet->setCellValue("C" . $i, 'Emp Number');
            $sheet->getStyle('C' . $i)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('C' . $i)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_THIN)
                ->setColor(new Color(Color::COLOR_BLACK));
            $sheet->setCellValue("D" . $i, $employeeNumber);
            $sheet->getStyle('D' . $i)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('D' . $i)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_THIN)
                ->setColor(new Color(Color::COLOR_BLACK));
            $this->setHeader($i, $sheet);
            $weekNumber = 1;
            $hours = $hours->sortBy('week_ending');
//            if($name == 'Cameron Finch')
//            {
//                dd($hours);
//            }
            $this->totalStandard = 0;
            $this->totalSat = 0;
            $this->totalSun = 0;
            $this->totalExpenses = 0;
            foreach($hours as $week)
            {
                $this->setWeek($weekNumber, $i, $week, $sheet);
                $weekNumber++;
            }
//            $sheet->setCellValue("A" . $i + $weekNumber + 1, 'Total');
//            $sheet->getStyle('A' . $i + $weekNumber + 1)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
//            $sheet->getStyle('A' . $i + $weekNumber + 1)
//                ->getBorders()
//                ->getOutline()
//                ->setBorderStyle(Border::BORDER_THIN)
//                ->setColor(new Color(Color::COLOR_BLACK));
            $sheet->setCellValue("B" . $i + $weekNumber + 1, 'Total');
            $sheet->getStyle('B' . $i + $weekNumber + 1)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('B' . $i + $weekNumber + 1)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_THIN)
                ->setColor(new Color(Color::COLOR_BLACK));
            $sheet->setCellValue("C" . $i + $weekNumber + 1, $this->totalStandard);
            $sheet->getStyle('C' . $i + $weekNumber + 1)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('C' . $i + $weekNumber + 1)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_THIN)
                ->setColor(new Color(Color::COLOR_BLACK));

            $sheet->setCellValue("D" . $i + $weekNumber + 1, $this->totalSat);
            $sheet->getStyle('D' . $i + $weekNumber + 1)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('D' . $i + $weekNumber + 1)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_THIN)
                ->setColor(new Color(Color::COLOR_BLACK));

            $sheet->setCellValue("E" . $i + $weekNumber + 1, $this->totalSun);
            $sheet->getStyle('E' . $i + $weekNumber + 1)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('E' . $i + $weekNumber + 1)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_THIN)
                ->setColor(new Color(Color::COLOR_BLACK));

            $sheet->setCellValue("F" . $i + $weekNumber + 1, $this->totalExpenses);
            $sheet->getStyle('F' . $i + $weekNumber + 1)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('F' . $i + $weekNumber + 1)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_THIN)
                ->setColor(new Color(Color::COLOR_BLACK));

            $sheet->getStyle('G' . $i + $weekNumber + 1)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('G' . $i + $weekNumber + 1)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_THIN)
                ->setColor(new Color(Color::COLOR_BLACK));
            $i = $i +10;
        }

        if(PHP_OS == 'Darwin'){
            $filename = "/Users/paulfinch/Desktop/EPS Payroll/Period Summary - ".$period->month.' - '.$period->year.'.xlsx';
            if(!file_exists("/Users/paulfinch/Desktop/EPS Payroll/"))
            {
                mkdir("/Users/paulfinch/Desktop/EPS Payroll/", 0777, true);
            }
        } else {
            $filename = "C:/EPS Payroll/Period Summary - ".$period->month.' - '.$period->year.'.xlsx';
            if(!file_exists("C:/EPS Payroll/"))
            {
                mkdir("C:/EPS Payroll/", 0777, true);
            }
        }
        $import->getProperties()->setCreator('EPS Payroll')->setLastModifiedBy('EPS Payroll');
        $writer = new WriteExcel($import);
        try {
            $writer->save($filename);
            flash()->option('position', 'bottom-right')->success("File output to $filename.");
        } catch(\Exception $e) {
            flash()->option('position', 'bottom-right')->warning("File not created. An open file with the same name already exists.");
        }
    }

    public function setWeek($weekNumber, $i, $week, $sheet): void
    {
        $this->totalExpenses = $this->totalExpenses + $week->expenses;
//        $sheet->setCellValue("A" . $i + 1 + $weekNumber, 'Week');
//        $sheet->getStyle('A' . $i + 1 + $weekNumber)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
//        $sheet->getStyle('A' . $i + 1 + $weekNumber)
//            ->getBorders()
//            ->getOutline()
//            ->setBorderStyle(Border::BORDER_THIN)
//            ->setColor(new Color(Color::COLOR_BLACK));

        $sheet->setCellValue("B" . $i + 1 + $weekNumber, Carbon::parse($week->week_ending)->format('d-m-Y'));
        $sheet->getStyle('B' . $i + 1 + $weekNumber)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('B' . $i + 1 + $weekNumber)
            ->getBorders()
            ->getOutline()
            ->setBorderStyle(Border::BORDER_THIN)
            ->setColor(new Color(Color::COLOR_BLACK));

        $sheet->setCellValue("C" . $i + 1 + $weekNumber, $this->getStandardHours($week));
        $sheet->getStyle('C' . $i + 1 + $weekNumber)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('C' . $i + 1 + $weekNumber)
            ->getBorders()
            ->getOutline()
            ->setBorderStyle(Border::BORDER_THIN)
            ->setColor(new Color(Color::COLOR_BLACK));

        $sheet->setCellValue("D" . $i + 1 + $weekNumber, $this->getSatHours($week));
        $sheet->getStyle('D' . $i + 1 + $weekNumber)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('D' . $i + 1 + $weekNumber)
            ->getBorders()
            ->getOutline()
            ->setBorderStyle(Border::BORDER_THIN)
            ->setColor(new Color(Color::COLOR_BLACK));

        $sheet->setCellValue("E" . $i + 1 + $weekNumber, $this->getSunHours($week));
        $sheet->getStyle('E' . $i + 1 + $weekNumber)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('E' . $i + 1 + $weekNumber)
            ->getBorders()
            ->getOutline()
            ->setBorderStyle(Border::BORDER_THIN)
            ->setColor(new Color(Color::COLOR_BLACK));

        $sheet->setCellValue("F" . $i + 1 + $weekNumber, number_format($week->expenses, 2,thousands_separator: ','));
        $sheet->getStyle('F' . $i + 1 + $weekNumber)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('F' . $i + 1 + $weekNumber)
            ->getBorders()
            ->getOutline()
            ->setBorderStyle(Border::BORDER_THIN)
            ->setColor(new Color(Color::COLOR_BLACK));

        $sheet->setCellValue("G" . $i + 1 + $weekNumber, $week->late ? 'Yes' : 'No');
        $sheet->getStyle('G' . $i + 1 + $weekNumber)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('G' . $i + 1 + $weekNumber)
            ->getBorders()
            ->getOutline()
            ->setBorderStyle(Border::BORDER_THIN)
            ->setColor(new Color(Color::COLOR_BLACK));
    }


    public function getStandardHours($week): float
    {
        $monHours = $week->mon1 + $week->mon2 + $week->mon3;
        if($monHours > 6)
        {
            $monHours = $monHours - 0.5;
        }
        $tueHours = $week->tues1 + $week->tues2 + $week->tues3;
        if($tueHours > 6)
        {
            $tueHours = $tueHours - 0.5;
        }
        $wedHours = $week->wed1 + $week->wed2 + $week->wed3;
        if($wedHours > 6)
        {
            $wedHours = $wedHours - 0.5;
        }
        $thuHours = $week->thu1 + $week->thu2 + $week->thu3;
        if($thuHours > 6)
        {
            $thuHours = $thuHours - 0.5;
        }
        $friHours = $week->fri1 + $week->fri2 + $week->fri3;
        if($friHours > 6)
        {
            $friHours = $friHours - 0.5;
        }
        $this->totalStandard = $this->totalStandard + $monHours + $tueHours + $wedHours + $thuHours + $friHours;
        return $monHours + $tueHours + $wedHours + $thuHours + $friHours;
    }

    public function getSatHours($week): float
    {
        $satHours = $week->sat1 + $week->sat2 + $week->sat3;
        if($satHours > 6)
        {
            $satHours = $satHours - 0.5;
        }
        $this->totalSat = $this->totalSat + $satHours;
        return $satHours;
    }

    public function getSunHours($week): float
    {
        $sunHours = $week->sun1 + $week->sun2 + $week->sun3;
        if($sunHours > 6)
        {
            $sunHours = $sunHours - 0.5;
        }
        $this->totalSun = $this->totalSun + $sunHours;
        return $sunHours;
   }

    public function setHeader($i, $sheet): void
    {
//        $sheet->setCellValue("A" . $i + 1, 'Week');
//        $sheet->getStyle('A' . $i + 1)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
//        $sheet->getStyle('A' . $i + 1)
//            ->getBorders()
//            ->getOutline()
//            ->setBorderStyle(Border::BORDER_THIN)
//            ->setColor(new Color(Color::COLOR_BLACK));

        $sheet->setCellValue("B" . $i + 1, 'WE');
        $sheet->getStyle('B' . $i + 1)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('B' . $i + 1)
            ->getBorders()
            ->getOutline()
            ->setBorderStyle(Border::BORDER_THIN)
            ->setColor(new Color(Color::COLOR_BLACK));

        $sheet->setCellValue("C" . $i + 1, 'Hours');
        $sheet->getStyle('C' . $i + 1)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('C' . $i + 1)
            ->getBorders()
            ->getOutline()
            ->setBorderStyle(Border::BORDER_THIN)
            ->setColor(new Color(Color::COLOR_BLACK));

        $sheet->setCellValue("D" . $i + 1, 'Sat Hours');
        $sheet->getStyle('D' . $i + 1)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('D' . $i + 1)
            ->getBorders()
            ->getOutline()
            ->setBorderStyle(Border::BORDER_THIN)
            ->setColor(new Color(Color::COLOR_BLACK));

        $sheet->setCellValue("E" . $i + 1, 'Sun Hours');
        $sheet->getStyle('E' . $i + 1)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('E' . $i + 1)
            ->getBorders()
            ->getOutline()
            ->setBorderStyle(Border::BORDER_THIN)
            ->setColor(new Color(Color::COLOR_BLACK));

        $sheet->setCellValue("F" . $i + 1, 'Expenses');
        $sheet->getStyle('F' . $i + 1)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('F' . $i + 1)
            ->getBorders()
            ->getOutline()
            ->setBorderStyle(Border::BORDER_THIN)
            ->setColor(new Color(Color::COLOR_BLACK));

        $sheet->setCellValue("G" . $i + 1, 'Late?');
        $sheet->getStyle('G' . $i + 1)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('G' . $i + 1)
            ->getBorders()
            ->getOutline()
            ->setBorderStyle(Border::BORDER_THIN)
            ->setColor(new Color(Color::COLOR_BLACK));
    }

    public function render(): View|Application|\Illuminate\View\View
    {
        $this->periods = Period::orderBy('id', 'desc')->get()->toArray();
        return view('livewire.period-summary');
    }
}
