<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\ApplicationDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApplicationDocumentController extends Controller
{
    /**
     * Danh sách minh chứng
     */
    public function index()
    {
        $documents = ApplicationDocument::with('application')
            ->latest()
            ->paginate(10);

        return view(
            'application_documents.index',
            compact('documents')
        );
    }

    /**
     * Form thêm minh chứng
     */
    public function create()
    {
        $applications = Application::orderBy('id', 'desc')->get();

        return view(
            'application_documents.create',
            compact('applications')
        );
    }

    /**
     * Lưu minh chứng + upload file
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'application_id' => [
                'required',
                'exists:applications,id'
            ],

            'document_type' => [
                'required',
                'string',
                'max:255'
            ],

            'file' => [
                'required',
                'file',
                'mimes:pdf,jpg,jpeg,png',
                'max:5120',
            ],

            'verification_status' => [
                'required',
                'in:Pending,Approved,Rejected'
            ],
        ], [
            'application_id.required' =>
                'Vui lòng chọn hồ sơ.',

            'application_id.exists' =>
                'Hồ sơ không tồn tại.',

            'document_type.required' =>
                'Vui lòng nhập loại minh chứng.',

            'file.required' =>
                'Vui lòng chọn file minh chứng.',

            'file.file' =>
                'File tải lên không hợp lệ.',

            'file.mimes' =>
                'File phải có định dạng PDF, JPG, JPEG hoặc PNG.',

            'file.max' =>
                'File không được vượt quá 5MB.',

            'verification_status.required' =>
                'Vui lòng chọn trạng thái xác minh.',

            'verification_status.in' =>
                'Trạng thái xác minh không hợp lệ.',
        ]);

        $filePath = $request
            ->file('file')
            ->store('documents', 'public');

        ApplicationDocument::create([
            'application_id' => $validated['application_id'],
            'document_name' => $request
                ->file('file')
                ->getClientOriginalName(),
            'document_type' => $validated['document_type'],
            'file_path' => $filePath,
            'verification_status' => $validated['verification_status'],
        ]);

        return redirect()
            ->route('application-documents.index')
            ->with(
                'success',
                'Upload minh chứng thành công!'
            );
    }

    /**
     * Xem chi tiết
     */
    public function show(ApplicationDocument $applicationDocument)
    {
        $applicationDocument->load('application');

        return view(
            'application_documents.show',
            compact('applicationDocument')
        );
    }

    /**
     * Form sửa minh chứng
     */
    public function edit(ApplicationDocument $applicationDocument)
    {
        $applications = Application::orderBy('id', 'desc')->get();

        return view(
            'application_documents.edit',
            compact(
                'applicationDocument',
                'applications'
            )
        );
    }

    /**
     * Cập nhật minh chứng
     */
    public function update(
        Request $request,
        ApplicationDocument $applicationDocument
    ) {
        $validated = $request->validate([
            'application_id' => [
                'required',
                'exists:applications,id'
            ],

            'document_type' => [
                'required',
                'string',
                'max:255'
            ],

            'verification_status' => [
                'required',
                'in:Pending,Approved,Rejected'
            ],

            'file' => [
                'nullable',
                'file',
                'mimes:pdf,jpg,jpeg,png',
                'max:5120',
            ],
        ], [
            'application_id.required' =>
                'Vui lòng chọn hồ sơ.',

            'application_id.exists' =>
                'Hồ sơ không tồn tại.',

            'document_type.required' =>
                'Vui lòng nhập loại minh chứng.',

            'verification_status.required' =>
                'Vui lòng chọn trạng thái xác minh.',

            'verification_status.in' =>
                'Trạng thái xác minh không hợp lệ.',

            'file.file' =>
                'File tải lên không hợp lệ.',

            'file.mimes' =>
                'File phải có định dạng PDF, JPG, JPEG hoặc PNG.',

            'file.max' =>
                'File không được vượt quá 5MB.',
        ]);

        $data = [
            'application_id' =>
                $validated['application_id'],

            'document_type' =>
                $validated['document_type'],

            'verification_status' =>
                $validated['verification_status'],
        ];

        // Nếu chọn file mới
        if ($request->hasFile('file')) {

            // Xóa file cũ
            if (
                $applicationDocument->file_path &&
                Storage::disk('public')->exists(
                    $applicationDocument->file_path
                )
            ) {
                Storage::disk('public')->delete(
                    $applicationDocument->file_path
                );
            }

            // Lưu file mới
            $data['file_path'] = $request
                ->file('file')
                ->store('documents', 'public');

            // Lưu tên file mới
            $data['document_name'] = $request
                ->file('file')
                ->getClientOriginalName();
        }

        $applicationDocument->update($data);

        return redirect()
            ->route('application-documents.index')
            ->with(
                'success',
                'Cập nhật minh chứng thành công!'
            );
    }

    /**
     * Xóa minh chứng
     */
    public function destroy(ApplicationDocument $applicationDocument)
    {
        // Xóa file thật
        if (
            $applicationDocument->file_path &&
            Storage::disk('public')->exists(
                $applicationDocument->file_path
            )
        ) {
            Storage::disk('public')->delete(
                $applicationDocument->file_path
            );
        }

        // Xóa dữ liệu database
        $applicationDocument->delete();

        return redirect()
            ->route('application-documents.index')
            ->with(
                'success',
                'Xóa minh chứng thành công!'
            );
    }
}

