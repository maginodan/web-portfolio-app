<?php

namespace App\Http\Controllers\Admin;

use App\Models\Certificate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CertificateController extends Controller
{
    public function index()
    {
        $certificates = Certificate::orderBy('id', 'DESC')->paginate(10);
        return view('admin.certificates.index', compact('certificates'));
    }

    public function create()
    {
        return view('admin.certificates.create')->with(['formMode' => 'create']);
    }

    public function store(Request $request)
    {
        $request->validate([
            "title" => "required|string|max:255",
            "description" => "required|string",
            "image" => "nullable|image|mimes:jpg,jpeg,png,webp|max:2048",
            // "pdf"   => "required|mimes:pdf|max:12288", 
        ]);

        $certificate = new Certificate();
        $certificate->title = $request->title;
        $certificate->description = $request->description;

        // Save Image
        if ($request->hasFile('image')) {
            $fileName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads/images'), $fileName);
            $certificate->image = $fileName;
        }

        // Save PDF
        if ($request->hasFile('pdf')) {
            $pdfName = time() . '.' . $request->pdf->getClientOriginalExtension();
            $request->pdf->move(public_path('uploads/certificates'), $pdfName);
            $certificate->pdf = $pdfName;
        }

        $certificate->save();

        return redirect()->route('admin.certificates.index')->with('success', 'Certificate created!');
    }

    public function edit($id)
    {
        $certificate = Certificate::findOrFail($id);
        return view('admin.certificates.edit', compact('certificate'))->with(['formMode' => 'edit']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "title" => "required|string|max:255",
            "description" => "required|string",
            "image" => "nullable|image|mimes:jpg,jpeg,png,webp|max:2048",
            // "pdf"   => "required|mimes:pdf|max:12288", 
        ]);

        $certificate = Certificate::findOrFail($id);

        $certificate->title = $request->title;
        $certificate->description = $request->description;

        // Update Image
        if ($request->hasFile('image')) {
            $oldImage = public_path('uploads/images/' . $certificate->image);
            if ($certificate->image && file_exists($oldImage)) {
                @unlink($oldImage);
            }

            $fileName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads/images'), $fileName);
            $certificate->image = $fileName;
        }

        // Update PDF
        if ($request->hasFile('pdf')) {
            $oldPdf = public_path('uploads/certificates/' . $certificate->pdf);
            if ($certificate->pdf && file_exists($oldPdf)) {
                @unlink($oldPdf);
            }

            $pdfName = time() . '.' . $request->pdf->getClientOriginalExtension();
            $request->pdf->move(public_path('uploads/certificates'), $pdfName);
            $certificate->pdf = $pdfName;
        }

        $certificate->save();

        return redirect()->route('admin.certificates.index')->with('success', 'Certificate updated!');
    }

    public function destroy($id)
    {
        $certificate = Certificate::findOrFail($id);

        // Delete Image
        if ($certificate->image) {
            $imagePath = public_path('uploads/images/' . $certificate->image);
            if (file_exists($imagePath)) {
                @unlink($imagePath);
            }
        }

        // Delete PDF
        if ($certificate->pdf) {
            $pdfPath = public_path('uploads/certificates/' . $certificate->pdf);
            if (file_exists($pdfPath)) {
                @unlink($pdfPath);
            }
        }

        $certificate->delete();

        return redirect()->route('admin.certificates.index')->with('success', 'Certificate deleted!');
    }
}
