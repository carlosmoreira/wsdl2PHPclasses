<?php

namespace App\Http\Controllers;

use App\library\GeneratorConfigFactory;
use Comodojo\Zip\Zip;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;

use App\Http\Requests;
use Mockery\CountValidator\Exception;
use Wsdl2PhpGenerator\Generator;


class UploadController extends Controller
{
    public function uploadWsdl(Request $request)
    {
        try{
            if (!$request->hasFile('wsdlfile'))
                throw new Exception('WSDL File is required');

            //pass in wsdl

            //$wsdlToClass = new WsdlToClass($request->all());


            //return zip file

            $tmpDir = uniqid();

            $generator = new Generator();
            $generator->generate(GeneratorConfigFactory::generateConfig($request->all(), $tmpDir));

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
        }catch (Exception $e){
            return redirect('/')->withInput()->with('error', $e->getMessage());
        }

    }
}