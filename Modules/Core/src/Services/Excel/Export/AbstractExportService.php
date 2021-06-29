<?php


namespace Topdot\Core\Services\Excel\Export;


use Illuminate\Support\Facades\Storage;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

abstract class AbstractExportService
{
    protected $spreadSheet;

    protected $sheet;

    protected $path;

    public function __construct()
    {
        $this->spreadSheet = new Spreadsheet();
        $this->sheet = $this->spreadSheet->getActiveSheet();

        $this->path = 'exports';

        if ( !file_exists(storage_path('app/'.$this->path)) ){
            mkdir(storage_path('app/'.$this->path),0777,true);
        }
    }

    public abstract function handle();


    protected function download()
    {
        $excelWriter = new Xlsx($this->spreadSheet);

        $filename = md5(microtime()).".xlsx";

        $excelWriter->save(
            storage_path("app/{$this->path}/{$filename}")
        );

        return Storage::download("{$this->path}/{$filename}",$filename);
    }

    protected function setCellValue($cellRange,$value)
    {
        $this->sheet->setCellValue($cellRange,$value);

        return $this;
    }

    protected function getCellValue($cellRange,$value)
    {
        return $this->sheet->getCell($cellRange)->getValue();
    }

    protected function setColumnWidth($cell,$width)
    {
        $this->sheet->getColumnDimension($cell)->setWidth($width);

        return $this;
    }

    protected function setRowHeight($row,$value)
    {
        $this->sheet->getRowDimension($row)->setRowHeight($value);

        return $this;
    }


    protected function setTextWrap($cellRange,$wrap=true)
    {
        $this->sheet->getStyle($cellRange)->getAlignment()->setWrapText($wrap);

        return $this;
    }

    protected function setBold($cellRange,$value)
    {
        $this->sheet->getStyle($cellRange)->getFont()->setBold($value);

        return $this;
    }

    protected function setAlignment($cellRange, $alignment )
    {
        $this->sheet->getStyle($cellRange)->getAlignment()->setHorizontal($alignment);

        return $this;
    }

    protected function setBackgroundColor($cellRange,$color)
    {
        $this->sheet->getStyle($cellRange)
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor()
            ->setRGB($color);

        return $this;
    }

    protected function setFontSize($cellRange,$size)
    {
        $this->sheet->getStyle($cellRange)->getFont()->setSize($size);

        return $this;
    }

    protected function setColor($cellRange,$color)
    {
        $this->sheet->getStyle($cellRange)
            ->getFont()
            ->getColor()
            ->setRGB($color);

        return $this;
    }

    protected function mergeCells($range)
    {
        $this->sheet->mergeCells($range);

        return $this;
    }

}
