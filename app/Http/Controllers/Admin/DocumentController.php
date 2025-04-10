<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Http\Requests\Document\UpdateDocumentRequest;
use App\Http\Requests\Document\StoreDocumentRequest;
use App\Http\Resources\DocumentResource;
use Illuminate\Http\RedirectResponse;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $documents = Document::orderBy('updated_at', 'desc')->get();

        return view('admin.index')->with('documents', $documents);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreDocumentRequest  $request
     * @return RedirectResponse
     */
    public function store(StoreDocumentRequest $request): RedirectResponse
    {
        try {
            $validated = $request->validated();
            Log::info('Payload received:', ['payload' => $validated['payload']]);

            $document = Document::create([
                'payload' => json_decode($validated['payload'], true),
                'status' => 'draft'
            ]);

            if ($document) {
                return redirect()->route('admin.documents.index')->with('success', 'Document Created successfully');
            }
            return back()->withError('Failed to create document');
        } catch (Exception $ex) {
            return back()->withError($ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Document  $document
     * @return View
     */
    public function show(Document $document): View
    {
        return view('admin.show')->with('document', new DocumentResource($document));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Document  $document
     * @return View|RedirectResponse
     */
    public function edit(Document $document)
    {
        if ($document->status === 'published') {
            return back()->withError('Published documents cannot be edited');
        }

        return view('admin.form')->with('document', new DocumentResource($document));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateDocumentRequest  $request
     * @param  Document  $document
     * @return RedirectResponse
     */
    public function update(UpdateDocumentRequest $request, Document $document): RedirectResponse
    {
        try {
            if ($document->status === 'published') {
                return back()->withError('Published documents cannot be updated');
            }

            $document->update([
                'payload' => $request->validated()['payload']
            ]);

            if ($document) {
                return redirect()->route('admin.documents.index')->with('message', 'Document Updated successfully');
            } else {
                return back()->withError('Something went wrong!');
            }
        } catch (Exception $ex) {
            // return back()->withError($ex->getMessage());
            return back()->withError('Something went wrong!');
        }
    }

    /**
     * Publish the specified document.
     *
     * @param  Document  $document
     * @return RedirectResponse
     */
    public function publish(Document $document): RedirectResponse
    {
        try {
            if ($document->status === 'published') {
                return back()->with('message', 'Document is already published');
            }

            $document->update([
                'status' => 'published'
            ]);

            return redirect()->route('admin.documents.index')->with('message', 'Document Published successfully');
        } catch (Exception $ex) {
            return back()->withError('Something went wrong!');
        }
    }
    
    /**
     * Remove the specified document from storage.
     *
     * @param  Document  $document
     * @return RedirectResponse
     */
    public function destroy(Document $document): RedirectResponse
    {
        try {
            if ($document->delete()) {
                return redirect()->route('admin.documents.index')->with('success', 'Document deleted successfully');
            }
            return back()->withError('Failed to delete document');
        } catch (Exception $ex) {
            return back()->withError('Something went wrong!');
        }
    }
}
