<?php

namespace App\Http\Controllers;

use App\library\WsdlToClass;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use App\Http\Requests;

class UploadController extends Controller
{

    public function uploadWsdl(Request $request)
    {
        try {
            if (!$request->hasFile('wsdlfile'))
                throw new \Exception('WSDL File is required');

            $this->validate($request, [
                'namespaece' => 'required',
                'wsdlfile' => 'required|mimes:png,xml,wsdl',
            ]);

            $wsdlToClass = new WsdlToClass($request->all());
            $zipContent = $wsdlToClass->getZip();

            return response($zipContent)->header('Content-Type', 'application/gzip')->header('Content-Disposition', 'attachment; filename=phpclasses.zip');
        } catch (Exception $e) {
            die('exp');
            return redirect('/')->withInput()->with('error', $e->getMessage());
        }

    }
}