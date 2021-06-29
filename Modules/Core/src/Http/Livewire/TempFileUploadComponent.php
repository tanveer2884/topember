<?php

namespace Topdot\Core\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Topdot\Core\Models\TempMedia;
use Illuminate\Database\Eloquent\Collection;

class TempFileUploadComponent extends Component
{
    use WithFileUploads;

    public Collection $files;

    public $config = [];
    public $file;
    public $name;
    public $maxFiles;
    public $showDefaultError;

    public function mount(string $name,array $config=[], $maxFiles=10, $showDefaultError=false)
    {
        $this->maxFiles = $maxFiles;
        $this->name = $name;
        $this->config = array_merge($this->config(),$config);
        $this->showDefaultError = $showDefaultError;
        $this->files =  TempMedia::find(
            array_merge(
                old($name,[]),$this->config['files']
            )
        );
    }

    public function render()
    {
        return view('core::livewire.temp-file-upload-component');
    }

    public function updatedFile()
    {
        if ( count($this->files) >=  $this->maxFiles ){
            $this->addError($this->name,"Cannot add more then {$this->maxFiles} Images");
            return;
        }

        $tempFile = TempMedia::create();
        $tempFilename = $this->file->getClientOriginalName();
        $this->file->storeAs('/temp',$tempFilename);

        $tempFile->addMedia(
            storage_path('app/temp/'.$tempFilename)
        )
        ->toMediaCollection('default');

        $this->files[] = $tempFile;
    }

    public function removeMedia($id)
    {
        TempMedia::find($id)->delete();
        $this->files = $this->files->reject(function($file) use($id){
            return $file->id == $id;
        });

    }

    private function config()
    {
        return [
            'classes' => 'd-flex flex-column justify-content-center align-items-center w-100 rounded',
            'styles' => "background-color:#ededed;min-height:70px;text-align:center;cursor:pointer;",
            'defaultText' => 'Click to Select and Upload Files',
            'accept' => implode(',',[
                'image/*'
            ]),
            'files' => []
        ];
    }
}
