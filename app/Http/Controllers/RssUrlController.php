<?php

namespace App\Http\Controllers;

use App\Models\RssUrl;
use App\Models\RssItem;
use Illuminate\Http\Request;

class RssUrlController
    extends Controller
{
    protected $pageSize = 25;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = RssUrl::latest()->paginate($this->pageSize);

        return view('rss_urls.index', compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * $this->pageSize)
        ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rss_urls.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'urls' => 'required',
        ]);

        $urls = explode(",", $request->urls);

        foreach ($urls as $url)
        {
            $url = trim($url);
            $rssUrl = new RssUrl();
            $rssUrl->url = $url;

            try
            {
                $rssUrl->save();

                dispatch(new \App\Jobs\RssProcessItemsJob($rssUrl));
            }
            catch(\Exception $e)
            {
                return redirect()
                    ->route('rss_urls.index')
                    ->with('success', 'Cant save rss url')
                ;
            }
        }


        return redirect()
            ->route('rss_urls.index')
            ->with('success', 'RSS Url Data has been created successfully')
        ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RssUrl  $rssUrl
     * @return \Illuminate\Http\Response
     */
    public function show(RssUrl $rssUrl)
    {
        return view('rss_urls.show', compact('rssUrl'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RssUrl  $rssUrl
     * @return \Illuminate\Http\Response
     */
    public function edit(RssUrl $rssUrl)
    {
        return view('rss_urls.edit', compact('rssUrl'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RssUrl  $rssUrl
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RssUrl $rssUrl)
    {
        $request->validate([
            'url' => 'required',
        ]);

        $rssUrl = RssUrl::find($request->hidden_id);
        $rssUrl->url = $request->url;

        try
        {
            $rssUrl->save();
        }
        catch (\Exception $e)
        {
            return redirect()
                ->route('rss_urls.index')
                ->with('success', 'Update RSS Url Data failed')
            ;
        }

        return redirect()
            ->route('rss_urls.index')
            ->with('success', 'RSS Url Data has been updated successfully')
        ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RssUrl  $rssUrl
     * @return \Illuminate\Http\Response
     */
    public function destroy(RssUrl $rssUrl)
    {
        try
        {
            $rssUrl->delete();
        }
        catch (\Exception $e)
        {
            return redirect()
                ->route('rss_urls.index')
                ->with('success', 'Delete RSS Url Data failed')
            ;
        }

        return redirect()
            ->route('rss_urls.index')
            ->with('success', 'RSS Url Data deleted successfully')
        ;
    }
}
