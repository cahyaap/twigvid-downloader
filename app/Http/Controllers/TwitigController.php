<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Thujohn\Twitter\Facades\Twitter;

class TwitigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('twitig-downloader');
    }

    public function getPostId($url, $urlChecker)
    {
        $postId = "";

        if($urlChecker === "tw"){
            $regex  = '#https?://twitter\.com/(?:\#!/)?(\w+)/status(es)?/(\d+)#is';
            if (preg_match($regex, $url, $match)) {
                $postId = $match;
            }
        }

        if($urlChecker === "ig"){
            $postId = pathinfo(trim(explode("?", trim($url))[0], '/'))['basename'];
        }

        return $postId;
    }

    public function urlChecker($url)
    {
        $rtn = '';
        $twRegex = '/http(?:s)?:\/\/(?:www\.)?twitter\.com\/([a-zA-Z0-9_]+)/';
        $igRegex = '/http(?:s)?:\/\/(?:www\.)?instagram\.com\/([a-zA-Z0-9_]+)/';
        if (preg_match($twRegex, $url, $match)) {
            $rtn = 'tw';
        }
        if (preg_match($igRegex, $url, $match)) {
            $rtn = 'ig';
        }
        return $rtn;
    }

    public function download(Request $request)
    {
        $url = $request->input('videoUrl');
        $urlChecker = $this->urlChecker($url);
        if ($urlChecker === '') {
            return response()->json([
                "status" => 400,
                "msg" => "This url is not a Twitter or intagram video url"
            ]);
        }

        if ($urlChecker === 'tw') {
            $postId = $this->getPostID($url, $urlChecker);
            if($postId === "" || empty($postId[3])){
                return response()->json([
                    "status" => 400,
                    "msg" => "Incorrect video url"
                ]);
            }
            $tweet = Twitter::getTweet($postId[3]);
            if (empty($tweet->extended_entities) || empty($tweet->extended_entities->media[0]->video_info)) {
                return response()->json([
                    "status" => 400,
                    "msg" => "Incorrect video url"
                ]);
            }
            $video_url = $tweet->extended_entities->media[0]->video_info->variants[0]->url;
        }

        if ($urlChecker === 'ig') {
            $postId = $this->getPostID($url, $urlChecker);
            $video_url = $postId;
        }

        return response()->json([
            "status" => 200,
            "video_url" => $video_url
        ]);
    }

    public function downloadVideo(Request $request){
        $url = $request->input('video');
        $filename = 'twitigvid-download.mp4';
        $tempVid = tempnam(sys_get_temp_dir(), $filename);
        copy($url, $tempVid);

        return response()->download($tempVid, $filename);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
