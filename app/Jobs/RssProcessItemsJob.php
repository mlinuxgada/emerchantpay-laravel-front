<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\RssUrl;
use App\Models\RssItem;
use Illuminate\Support\Facades\Http;
use STS\JWT\JWTFacade as JWT;

class RssProcessItemsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $rssUrlEntity;
    protected $jwtToken;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(RssUrl $entity)
    {
        $this->rssUrlEntity = $entity;
        $this->jwtToken = JWT::get(
            'emerchantpay-token-id', [
                'anything' => 'here'
            ], 3600)
            ;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $rssApiURL =  config('services.rss_api_url');

        $response = Http::withBody(json_encode([
                'rss_urls' => [
                    $this->rssUrlEntity->url,
                ],
            ]), 'application/json')
            ->withToken($this->jwtToken)
            ->post($rssApiURL)
            ;

        if ($response->successful())
        {
            $respData = $response->object();

            if ($respData->items == null)
            {
                return;
            }

            foreach ($respData->items as $item)
            {
                $rssItem = new RssItem();
                $rssItem->rss_url_id = $this->rssUrlEntity->id;
                $rssItem->title = $item->title;
                $rssItem->source = $item->source;
                $rssItem->source_url = $item->source_url;
                $rssItem->link = $item->link;
                $rssItem->publish_date = \DateTime::createFromFormat ('Y-m-d\TH:i:s\Z', $item->publish_date);
                $rssItem->description = $item->description;

                try
                {
                    $rssItem->save();
                }
                catch (\Exception $e)
                {
                }
            }
        }
    }
}
