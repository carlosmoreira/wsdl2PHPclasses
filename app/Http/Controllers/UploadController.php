<?php

namespace App\Http\Controllers;

use Comodojo\Zip\Zip;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;

use App\Http\Requests;
use Wsdl2PhpGenerator\Config;
use Wsdl2PhpGenerator\Generator;

class UploadController extends Controller
{
    public function uploadWsdl(Request $request)
    {
        if (!$request->hasFile('wsdlfile')) {
            return redirect('/')->withInput()->with('error', 'WSDL File is required');
        }

        $wsdlFile = $request->file('wsdlfile');
        $tmpDir = uniqid();

        $generator = new Generator();
        $generator->generate(new Config([
            'inputFile' => $wsdlFile->getRealPath(),
            'outputDir' => $tmpDir
        ]));

        $zip = Zip::create($tmpDir . '.zip');
        $zip->add($tmpDir);
        $zipName = $zip->getZipFile();
        $zip->close();

        $zipContent = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '\\' . $zip->getZipFile());

        if (PHP_OS === 'WINNT'){
            exec("rd /s /q $tmpDir");
            exec("del $zipName");
        }else {
            exec("rm -rf $tmpDir");
            exec("rm -rgf $zipName");
        }
        
        return response($zipContent)->header('Content-Type', 'application/gzip')->header('Content-Disposition', 'attachment; filename=phpclasses.zip');
    }
}