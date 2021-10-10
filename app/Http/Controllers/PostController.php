<?php

namespace App\Http\Controllers;

Use App\Models\Post;
Use App\Util;
use Exception;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return Post::all();
    }

    public function show(Post $post)
    {
        return $post->load('campaign');
    }

    public function publicate(Request $request, Post $post)
    {
        try{
            $this->validatePublicationRequest($request, $post);
            $post->publicate();
            return response()->json($post, 200);
        }catch(Exception $e){
            return response()->json(['Error:' => $e->getMessage()], 400);
        }
    }

    private function validatePublicationRequest($request, Post $post)
    {
        $strDate = $request->get('publication_date');

        if($post->is_publicated){
            throw new Exception('Can not publicate an already public blogpost!');
        }

        if(empty($strDate)){
            throw new Exception('The publication_date field must not be empty!');
        }

        if(!Util::isValidDateFormat($strDate)){
            throw new Exception('Invalid publication_date format!');
        }

        if(Util::isDateOnWeekend($strDate)){
            throw new Exception("Unable to publicate the post on the given date, because it's on a weekend.");
        }

        //Check if the date is during the campaign or not
        if(!Util::isDateBetweenDates($strDate, $post->campaign->start, $post->campaign->end)){
            throw new Exception("The selected date must be between the start and end of the campaign.");
        }
    }
}
