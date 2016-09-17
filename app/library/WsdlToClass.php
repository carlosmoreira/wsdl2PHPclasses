<?php
/**
 * Created by PhpStorm.
 * User: CarlosMoreira
 * Date: 9/16/2016
 * Time: 11:40 PM
 */

namespace app\library;


use Illuminate\Http\UploadedFile;

class WsdlToClass
{

    /**
     * @var $wsdlFile UploadedFile
     */
    private $wsdlFile;

    /**
     * WsdlToClass constructor.
     * @param UploadedFile $wsdlFile
     */
    public function __construct(UploadedFile $wsdlFile)
    {
        $this->wsdlFile = $wsdlFile;
    }

    public function getZip(){
        $tmpDir = uniqid();

        $generator = new Generator();
        $generator->generate(GeneratorConfigFactory::generateConfig($request->all(), $tmpDir));

        $zip = Zip::create($tmpDir . '.zip');
        $zip->add($tmpDir);
        $zipName = $zip->getZipFile();
        $zip->close();

    }




}