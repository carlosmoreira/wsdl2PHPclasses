<?php

/**
 * Created by PhpStorm.
 * User: CarlosMoreira
 * Date: 9/16/2016
 * Time: 9:30 PM
 */

namespace app\library;

use Wsdl2PhpGenerator\Config;
use Mockery\CountValidator\Exception;

class GeneratorConfigFactory
{
    public static function generateConfig(array $data, $tmpDir = null)
    {

        if (!$tmpDir) $tmpDir = uniqid();

        if (isset($data['wsdlfile']))
            $wsdlFile = $data['wsdlfile'];
        else
            throw new Exception('WSDL file is not set');

        if (isset($data['namespace'])) {
            return new Config([
                'inputFile' => $wsdlFile->getRealPath(),
                'outputDir' => $tmpDir,
                'nameSpace' => $data['namespace']
            ]);
        }

        return new Config([
            'inputFile' => $wsdlFile->getRealPath(),
            'outputDir' => $tmpDir
        ]);

    }
}