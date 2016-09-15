<?php

namespace App\Http\Controllers;

use Comodojo\Zip\Zip;
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
        $zip->close();

        if (PHP_OS === 'WINNT')
            exec("rd /s /q $tmpDir");
        else
            exec("rm -rf $tmpDir");

        return response()->download($_SERVER['DOCUMENT_ROOT'] . '\\' . $zip->getZipFile());
    }
}
