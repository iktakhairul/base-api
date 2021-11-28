<?php

namespace App\Http\Controllers;

use App\Http\Requests\Attachment\IndexRequest;
use App\Http\Requests\Attachment\StoreRequest;
use App\Http\Requests\Attachment\UpdateRequest;
use App\Http\Resources\AttachmentResource;
use App\Http\Resources\AttachmentResourceCollection;
use App\Repositories\Contracts\AttachmentRepository;
use App\Models\Attachment;
use Illuminate\Http\JsonResponse;

class AttachmentController extends Controller
{
    /**
     * @var AttachmentRepository
     */
    private $attachmentRepository;

    /**
     * AttachmentController constructor.
     *
     * @param AttachmentRepository $attachmentRepository
     */
    public function __construct(AttachmentRepository $attachmentRepository)
    {
        $this->attachmentRepository = $attachmentRepository;
    }

    /**
     * * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return AttachmentResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $attachments = $this->attachmentRepository->findBy($request->all());

        return new AttachmentResourceCollection($attachments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return AttachmentResource
     */
    public function store(StoreRequest $request)
    {
        $attachment = $this->attachmentRepository->save($request->all());

        return  new AttachmentResource($attachment);
    }

    /**
     * Display the specified resource.
     *
     * @param Attachment $attachment
     * @return AttachmentResource
     */
    public function show(Attachment $attachment)
    {
        return new AttachmentResource($attachment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Attachment $attachment
     * @return JsonResponse
     */
    public function destroy(Attachment $attachment)
    {
        $this->attachmentRepository->delete($attachment);

        return response()->json(null, 204);
    }

    public function update(UpdateRequest $request, Attachment $attachment)
    {
        $attachment = $this->attachmentRepository->update($attachment, $request->all());

        return new AttachmentResource($attachment);
    }
}
