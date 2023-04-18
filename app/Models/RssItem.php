<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RssItem
    extends Model
{
    use HasFactory;
    protected $fillable = ['rss_url_id', 'title', 'source', 'source_url', 'link', 'publish_date', 'description'];

    public function filter(array $filters)
    {
        $rssItems = RssItem::latest();

        if ($filters['rss_url_id'] > 0)
        {
            $rssItems->where('rss_url_id', $filters['rss_url_id']);
        }

        if ($filters['title'] != "")
        {
            $rssItems->where('title', 'like', '%' . $filters['title'] . '%');
        }

        if ($filters['publish_date'] != "")
        {
            $startOfDay = $filters['publish_date'] . " 00:00:00";
            $endOfDay = $filters['publish_date'] . " 23:59:59";

            $rssItems
                ->whereBetween('publish_date', [$startOfDay, $endOfDay])
                ;
        }

        return $rssItems
            ->orderByDesc('publish_date')
            ->paginate($filters['pageSize'])
            ;
    }
}
