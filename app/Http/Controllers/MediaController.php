<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Http\UploadedFile;
use Pion\Laravel\ChunkUpload\Exceptions\UploadMissingFileException;
use Pion\Laravel\ChunkUpload\Handler\AbstractHandler;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;

use Dilab\Network\SimpleRequest;
use Dilab\Network\SimpleResponse;
use Dilab\Resumable;

use Config;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('admin.media.add',[]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    //not used
    protected function createFilename(UploadedFile $file)
    {
        $extension = $file->getClientOriginalExtension();
        $filename = str_replace(".".$extension, "", $file->getClientOriginalName());// Filename without extension
        // Add timestamp hash to name of the file
        $filename .= "_" . md5(time()) . "." . $extension;
        return $filename;
    }
    //not used
    protected function saveFile(UploadedFile $file)
    {
        $fileName = $this->createFilename($file);
        // Group files by mime type
        $mime = str_replace('/', '-', $file->getMimeType());
        // Group files by the date (week
        $dateFolder = date("Y-m-W");
        // Build the file path
        $filePath = "uploads/{$mime}/{$dateFolder}/";
        $finalPath = storage_path("app/".$filePath);
        // move the file name
        $test = $file->move($finalPath, $fileName);
        $media_type = Config::get('enum.media_type_mime.'.$mime);
        if(!$media_type){
            $media_type = '3';
        }
        return response()->json([
            'path' => $filePath,
            'name' => $fileName,
            'mime_type' => $mime,
            'media_type' => $media_type
        ]);
    }
    //not used
    public function upload(Request $request) {
        // Create the file receiver, exception is thrown if file upload is invalid (size limit, etc)
        //print_r($request->all());
        //https://packagist.org/packages/pion/laravel-chunk-upload
        //
        $receiver = new FileReceiver("file", $request, HandlerFactory::classFromRequest($request));
        /*dd($request);
        */
        //dd($receiver);
        // check if the upload is success
        if ($receiver->isUploaded()) {
            // receive the file
            $save = $receiver->receive();
            // check if the upload has finished (in chunk mode it will send smaller files)
            if ($save->isFinished()) {
                // save the file and return any response you need
                //print_r($save->getFile());exit;
                return $this->saveFile($save->getFile());
            } else {
                // we are in chunk mode, lets send the current progress

                /** @var AbstractHandler $handler */
                $handler = $save->handler();

                return response()->json([
                    "done" => $handler->getPercentageDone(),
                ]);
            }
        } else {
            throw new UploadMissingFileException();
        }
    }

/*    public function upload(Request $request) {
        $tmpPath    = storage_path().'/tmp';
        $uploadPath = storage_path().'/uploads';
        if(!File::exists($tmpPath)) {
            File::makeDirectory($tmpPath, $mode = 0775, true, true);
        }

        if(!File::exists($uploadPath)) {
            File::makeDirectory($uploadPath, $mode = 0775, true, true);
        }

        $simpleRequest              = new SimpleRequest();
        $simpleResponse             = new SimpleResponse();

        $resumable                  = new Resumable($simpleRequest, $simpleResponse);
        $resumable->tempFolder      = $tmpPath;
        $resumable->uploadFolder    = $uploadPath;


        $result = $resumable->process();
        
        switch($result) {
            case 200:
                return response([
                    'message' => 'OK',
                ], 200);
                break;
            case 201:
                //All Chunks uploaded. Ready for auto processing
                return response([
                    'message' => 'OK',
                ], 200);
                break;
            case 204:
                return response([
                    'message' => 'Chunk not found',
                ], 204);
                break;
            default:
                return response([
                    'message' => 'An error occurred',
                ], 404);
        }
    }*/

    public function _log($str) {
        // log to the output
        $log_str = date('d.m.Y').": {$str}\r\n";
        echo $log_str;

        // log to file
        if (($fp = fopen('upload_log.txt', 'a+')) !== false) {
            fputs($fp, $log_str);
            fclose($fp);
        }
    }

    public function rrmdir($dir) {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (filetype($dir . "/" . $object) == "dir") {
                        $this->rrmdir($dir . "/" . $object); 
                    } else {
                        unlink($dir . "/" . $object);
                    }
                }
            }
            reset($objects);
            $this->rmdir($dir);
        }
    }


    public function createFileFromChunks($temp_dir, $fileName, $chunkSize, $totalSize,$total_files) {

        // count all the parts of this file
        $total_files_on_server_size = 0;
        $temp_total = 0;
        foreach(scandir($temp_dir) as $file) {
            $temp_total = $total_files_on_server_size;
            $tempfilesize = filesize($temp_dir.'/'.$file);
            $total_files_on_server_size = $temp_total + $tempfilesize;
        }
        // check that all the parts are present
        // If the Size of all the chunks on the server is equal to the size of the file uploaded.
        if ($total_files_on_server_size >= $totalSize) {
        // create the final destination file 
            if (($fp = fopen($_SERVER["DOCUMENT_ROOT"].'/uploads/'.$fileName, 'w')) !== false) {
                for ($i=1; $i<=$total_files; $i++) {
                    fwrite($fp, file_get_contents($temp_dir.'/'.$fileName.'.part'.$i));
                    $this->_log('writing chunk '.$i);
                }
                fclose($fp);
            } else {
                $this->_log('cannot create the destination file');
                return false;
            }

            // rename the temporary directory (to avoid access from other 
            // concurrent chunks uploads) and than delete it
            if (rename($temp_dir, $temp_dir.'_UNUSED')) {
                $this->rrmdir($temp_dir.'_UNUSED');
            } else {
                $this->rrmdir($temp_dir);
            }
        }

    }


    public function upload3() {
        
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            if(!(isset($_GET['resumableIdentifier']) && trim($_GET['resumableIdentifier'])!='')){
                $_GET['resumableIdentifier']='';
            }
            $temp_dir = $_SERVER["DOCUMENT_ROOT"].'/uploads/'.$_GET['resumableIdentifier'];
            if(!(isset($_GET['resumableFilename']) && trim($_GET['resumableFilename'])!='')){
                $_GET['resumableFilename']='';
            }
            if(!(isset($_GET['resumableChunkNumber']) && trim($_GET['resumableChunkNumber'])!='')){
                $_GET['resumableChunkNumber']='';
            }
            $chunk_file = $temp_dir.'/'.$_GET['resumableFilename'].'.part'.$_GET['resumableChunkNumber'];
            if (file_exists($chunk_file)) {
                header("HTTP/1.0 200 Ok");
            } else {
                header("HTTP/1.0 404 Not Found");
            }
        }

        // loop through files and move the chunks to a temporarily created directory
        if (!empty($_FILES)) foreach ($_FILES as $file) {

            // check the error status
            if ($file['error'] != 0) {
                $this->_log('error '.$file['error'].' in file '.$_POST['resumableFilename']);
                continue;
            }

            // init the destination file (format <filename.ext>.part<#chunk>
            // the file is stored in a temporary directory
            if(isset($_POST['resumableIdentifier']) && trim($_POST['resumableIdentifier'])!=''){
                $temp_dir = $_SERVER["DOCUMENT_ROOT"].'/uploads/'.$_POST['resumableIdentifier'];
            }
            $dest_file = $temp_dir.'/'.$_POST['resumableFilename'].'.part'.$_POST['resumableChunkNumber'];

            // create the temporary directory
            if (!is_dir($temp_dir)) {
                mkdir($temp_dir, 0777, true);
            }

            // move the temporary file
            if (!move_uploaded_file($file['tmp_name'], $dest_file)) {
                $this->_log('Error saving (move_uploaded_file) chunk '.$_POST['resumableChunkNumber'].' for file '.$_POST['resumableFilename']);
            } else {
                // check if all the parts present, and create the final destination file
                $this->createFileFromChunks($temp_dir, $_POST['resumableFilename'],$_POST['resumableChunkSize'], $_POST['resumableTotalSize'],$_POST['resumableTotalChunks']);
            }
        }

    }


}
