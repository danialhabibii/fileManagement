<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Hashids\Hashids;
use App\Models\user_file;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rules\File;

class FileController extends Controller
{
    public function index()
    {
        $uploaded = User::find(1);
        return view('index', compact('uploaded'));
    }
    public function uploads(Request $request)
    {
        try {
            if ($request->hasFile('user_file')) {
                $file = $request->file('user_file');
                $allowExtensions = ['png', 'jpg', 'gif', 'apng', 'avif', 'jpeg', 'svg', 'webp' . 'bmp', 'ico', 'TIFF', 'mp3', 'mp4', 'avi', 'flv', 'webm', 'wmv', 'mov', 'AVCHD', 'ogg'];
                $allowMimeType = ['image/jpeg', 'image/png', 'image/gif', 'image/apng', 'image/avif', 'image/jpeg', 'image/svg', 'image/webp' . 'image/bmp', 'image/x-icon', 'image/tiff', 'video/mp4', 'video/x-msvideo', 'video/x-flv', 'video/webm', 'video/wmv', 'video/quicktime', 'video/avchd-stream', 'audio/ogg'];
                $MimeType = $file->getMimeType();
                $maximumSize = 2000000;
                if (in_array($file->getClientOriginalExtension(), $allowExtensions) && in_array($MimeType, $allowMimeType)) {
                    if ($file->getSize() <= $maximumSize) {
                        $request->validate([
                            'user_file' => 'required|file',
                            'g-recaptcha-response' => 'required|captcha'
                        ]);
                        $filename = time() . '_' . $file->getClientOriginalName();
                        $file->move(public_path('uploads'), $filename);
                        // generate short url
                        $generate = bin2hex(random_bytes(3));
                        $generate = substr($generate, 0, 5);
                        $newId = new user_file([
                            'file_id' => $generate,
                            'real_link' => $filename
                        ]);
                        $newId->save();
                        $shortUrl = "http://localhost:8000/short/" . $generate;
                        // 
                        $add = User::find(1);
                        $add->uploaded += 1;
                        $add->save();
                        return redirect(route('index'))->with('success', "File SuccessFully Uploaded." . PHP_EOL . $shortUrl);
                    } else {
                        return redirect(route('index'))->with('warning', 'The size of the uploaded file is more than the limit');
                    }
                } else {
                    return redirect(route('index'))->with('warning', 'The uploaded file extension is not allowed. Please try again');
                }
            }
            return redirect(route('index'))->with('warning', 'Error Please Try Again');
        } catch (Exception $e) {
            switch ($e->getCode()) {
                case 0:
                    return redirect(route('index'))->with('warning', 'please Try again.');
                default:
                    return redirect(route('index'))->with('warning', 'Welcome Back');
            }
        }
    }
    public function find($id)
    {
        $find = user_file::where('file_id', $id)->get();
        if ($find) {
            foreach ($find as $finds) {
                $result = $finds->real_link;
                return response()->download("uploads/{$result}");
            }
        } else {
            abort(403);
        }
    }
}
