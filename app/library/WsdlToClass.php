<?php
/**
 * Created by PhpStorm.
 * User: CarlosMoreira
 * Date: 9/16/2016
 * Time: 11:40 PM
 */

namespace App\library;


use Comodojo\Zip\Zip;
use Illuminate\Http\UploadedFile;
use Wsdl2PhpGenerator\Generator;

/**
 * Class WsdlToClass
 * @package App\library
 * Description: Facade class used to generate and return the zip file with all classes
 */
class WsdlToClass
{

    /**
     * @var array
     */
    private $requestData;

    /**
     * @var string
     */
    private $tmpDir;
    
    /**
     * @var $wsdlFile UploadedFile
     */
    private $wsdlFile;

    /**
     * WsdlToClass constructor.
     * @param UploadedFile $wsdlFile
     */
    public function __construct(array $data)
    {
        if(!isset($data['wsdlfile']))
            throwException('wsdl file not found in wsdlToClass');
        $this->requestData = $data;
        $this->wsdlFile = $data['wsdlfile'];
        $this->tmpDir = uniqid();
    }

    /**
     * Take the wsdl file passed in and generate the class. Then zip up all files and return file contents
     * @return mixed
     * @throws \Comodojo\Exception\ZipException
     */
    public function getZip(){
        //Generate files
        $generator = new Generator();
        $generator->generate(GeneratorConfigFactory::generateConfig($this->requestData, $this->tmpDir));

        //Create Zip and add files
        $zip = Zip::create($this->tmpDir . '.zip');
        $zip->add($this->tmpDir);

        $zipName = $zip->getZipFile();
        $zip->close();

        $fileContent = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '\\' . $zip->getZipFile());

        //Delete files
        if (PHP_OS === 'WINNT'){
            exec("rd /s /q $this->tmpDir");
            exec("del $zipName");
        }else {
            exec("rm -rf $this->tmpDir");
            exec("rm -rgf $zipName");
        }

        //Return zip as content
        return $fileContent;
    }




}