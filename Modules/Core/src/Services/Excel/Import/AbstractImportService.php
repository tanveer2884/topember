<?php


namespace Topdot\Core\Services\Excel\Import;


use Illuminate\Http\UploadedFile;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Exception;

abstract class AbstractImportService
{
    protected $file;
    protected $fileReader;
    protected $spreadSheet;
    protected $workSheet;
    protected $noRows;
    protected $noColumns;

    /**
     * AbstractImportService constructor.
     * @param $file
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws Exception
     */
    public function __construct($file)
    {
        $this->file = $file;
        $this->fileReader = IOFactory::createReaderForFile($file);
        $this->fileReader->setReadDataOnly(true);
        $this->fileReader->setLoadSheetsOnly(0);
        $this->spreadSheet = $this->fileReader->load($this->file);
        $this->workSheet = $this->spreadSheet->getSheet(0);
        $this->noRows = $this->spreadSheet->getSheet(0)->getHighestDataRow();
        $this->noColumns = $this->spreadSheet->getSheet(0)->getHighestDataColumn();
    }

    public function getDataAsArray()
    {
        return $this->workSheet->rangeToArray(
            'A1:' . $this->noColumns . $this->noRows,
            null,
            true,
            true,
            true
        );
    }

    public function getStoragePath($filename)
    {
        return storage_path("app/excels/{$filename}");
    }

    public abstract function handle();

    public function importFile(UploadedFile $file)
    {
        $fiename = md5(microtime()) . "." . $file->getClientOriginalExtension();
        $file->storeAs("excels/", $fiename);
        return $fiename;
    }
}
