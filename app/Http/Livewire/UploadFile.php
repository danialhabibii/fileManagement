<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\user_file;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class UploadFile extends Component
{
    use WithFileUploads;

    public $user_file;
    protected $rules = [
        'user_file' => "required",
        'g-recaptcha-response' => 'required|captcha'
    ];
    public function submit()
    {
        $this->validate();
        $path = $this->user_file->store("public/upload");
        $url = Storage::url($path);
        $this->emit('uploads', $url);
        $generate = bin2hex(random_bytes(3));
        $generate = substr($generate, 0, 5);
        $shortUrl = "http://localhost:8000/file/" . $generate;
        $realurl = "http://localhost:8000" . $url;

        $newId = new user_file([
            'file_id' => $generate,
            'real_link' => $realurl
        ]);
        $newId->save();
        $add = User::find(1);
        $add->uploaded += 1;
        $add->save();
        $this->message = "File SuccessFully Uploaded." . PHP_EOL . $shortUrl;
    }
    public function render()
    {
        return view('livewire.upload-file');
    }
}
