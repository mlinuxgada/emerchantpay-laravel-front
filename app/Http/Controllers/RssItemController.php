<?php

namespace App\Http\Controllers;

use App\Models\RssItem;
use App\Models\RssUrl;
use Illuminate\Http\Request;

class RssItemController
    extends Controller
{

    protected $pageSize = 25;

    /**
     * Display a listing of the resource.
     * Filters by - list of params:
     *  - rss_url_id - the id of the related rss_url entity /optional/
     *  - title - the post title /optional/
     *  - publish_date - published_date of the post /optional/
     *
     *  Important - its does not have start/end, eg the filter publish_date is up to day/eg no hours, mins etc/,
     *  and the filtering is getting all within that day
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['filters']['rss_url_id'] = request()->rss_url_id ?? 0;
        $data['filters']['title'] = request()->title ?? "";
        $data['filters']['publish_date'] = request()->publish_date ?? "";
        $data['filters']['page'] = $this->page ?? 1;
        $data['filters']['pageSize'] = $this->pageSize;

        $data['rss_urls'] = RssUrl::latest()->get();
        $data['items'] = (new RssItem())
            ->filter($data['filters'])
            ->appends(request()->query())
            ;

        return view('rss_items.index', compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * $this->pageSize)
            ;
        //
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
     * @param  \App\Models\RssItem  $rssItem
     * @return \Illuminate\Http\Response
     */
    public function show(RssItem $rssItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RssItem  $rssItem
     * @return \Illuminate\Http\Response
     */
    public function edit(RssItem $rssItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RssItem  $rssItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RssItem $rssItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RssItem  $rssItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(RssItem $rssItem)
    {
        //
    }
}
