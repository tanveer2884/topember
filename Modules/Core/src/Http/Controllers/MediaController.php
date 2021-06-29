<?php

namespace Topdot\Core\Http\Controllers;

use Illuminate\Http\Request;
use Topdot\Core\Models\TempMedia;
use Illuminate\Routing\Controller;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Foundation\Validation\ValidatesRequests;

class MediaController extends Controller
{
    use ValidatesRequests;

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'file' => 'required|image|max:2048'
        ]);

        $mediaStored = TempMedia::create()->addMediaFromRequest('file')->toMediaCollection('temporary');
        return $mediaStored;
    }

    /**
     * Display the specified resource.
     *
     * @param Media $media
     * @return \Illuminate\Http\Response
     */
    public function show(Media $media)
    {
        return response()->download($media->getPath(),$media->file_name,[],'inline');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Media $media
     * @return \Illuminate\Http\Response
     */
    public function destroy(Media $media)
    {
        $media->delete();
        return apiResponse(true,"File Deleted");
    }

    /**
     * @param TempMedia|null $media
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function removeTemp(Request $request)
    {
        $payload = json_decode($request->getContent());

        if ( !$payload instanceof \stdClass || !$payload->temp_id ){
            return apiResponse(false,"file Not found",[],404);
        }

        $tempMedia = TempMedia::find($payload->temp_id);

        if ( !$tempMedia ){
            return apiResponse(false,"file Not found",[],404);
        }

        $tempMedia->delete();
        return apiResponse(true,"File Deleted");
    }

    public function tinyMce()
    {
        $media = TempMedia::create();

        if ( $media instanceof TempMedia ){
            $uploadedMedia = $media->addMediaFromRequest('file')->toMediaCollection('editorImage');
            return response()->json([
                'location' => route('api.medias.show',$uploadedMedia)
            ]);
        }


        return response()->json([
            'location' => null
        ]);
    }
}
