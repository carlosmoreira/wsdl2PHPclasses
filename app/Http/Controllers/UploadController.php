<?php

namespace App\Http\Controllers;

use App\library\WsdlToClass;
use Illuminate\Http\Request;
use App\Http\Requests;
use Mockery\CountValidator\Exception;

class UploadController extends Controller
{
    public function uploadWsdl(Request $request)
    {
        try {
            if (!$request->hasFile('wsdlfile'))
                throw new Exception('WSDL File is required');

            $wsdlToClass = new WsdlToClass($request->all());
            $zipContent = $wsdlToClass->getZip();

            return response($zipContent)->header('Content-Type', 'application/gzip')->header('Content-Disposition', 'attachment; filename=phpclasses.zip');
        } catch (Exception $e) {
            return redirect('/')->withInput()->with('error', $e->getMessage());
        }

    }
}