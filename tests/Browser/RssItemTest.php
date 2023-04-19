<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

use App\Models\RssUrl;
use App\Models\RssItem;

class RssItemTest extends DuskTestCase
{

    use DatabaseMigrations;

    /**
     * Testing RssItems root url, no data, no filters.
     *
     * @return void
     */
    public function testRootURL()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/rss_items')
                ->assertTitle('EmerchantPay RSS CRUD Application')
                ->assertSourceHas('<b>RSS Feed Items</b>')
                ;
        });
    }

    /**
     * Testing RssItems listing, eg seed with 1 rss item post, then assure its fields/data is rendered
     *
     * @return void
     */
    public function testList()
    {
        $rssUrl = new RssUrl();
        $rssUrl->url = 'fake.url.com/rss.xml';

        $rssUrl->save();

        $rssItem = new RssItem();
        $rssItem->rss_url_id = $rssUrl->id;
        $rssItem->title = 'some rss post title';
        $rssItem->source = $rssUrl->url;
        $rssItem->source_url = $rssUrl->url;
        $rssItem->link = 'http://some.item.post/url/link';
        $rssItem->publish_date = '2023-01-05 16:29:08';
        $rssItem->description = 'some description';

        $rssItem->save();

        $this->browse(function (Browser $browser) {
            $browser->visit('/rss_items')
                ->assertSourceHas('<td>fake.url.com/rss.xml</td>')
                ->assertSourceHas('some rss post title')
                ->assertSourceHas('some description')
                ->assertSourceHas('<td>http://some.item.post/url/link</td>')
                ;
        });

    }

    /**
     * Testing RssItems filter by rss_url_id. Implemented 2 cases
     * - success, eg filter by existing url id, and assure all fields are rendered
     * - nonpresent, assure nothing from the currently seeded post item is there
     *
     * @return void
     */
    public function testListURLFilterRssUrlID()
    {
        $rssUrl = new RssUrl();
        $rssUrl->url = 'fake.url.com/rss.xml';

        $rssUrl->save();

        $rssItem = new RssItem();
        $rssItem->rss_url_id = $rssUrl->id;
        $rssItem->title = 'some rss post title';
        $rssItem->source = $rssUrl->url;
        $rssItem->source_url = $rssUrl->url;
        $rssItem->link = 'http://some.item.post/url/link';
        $rssItem->publish_date = '2023-01-05 16:29:08';
        $rssItem->description = 'some description';

        $rssItem->save();

        $this->browse(function (Browser $browser) {
            $browser->visit('/rss_items?rss_url_id=1')
                ->assertSourceHas('<td>fake.url.com/rss.xml</td>')
                ->assertSourceHas('some rss post title')
                ->assertSourceHas('some description')
                ->assertSourceHas('<td>http://some.item.post/url/link</td>')
                ;
        });

        $this->browse(function (Browser $browser) {
            $browser->visit('/rss_items?rss_url_id=1123')
                ->assertSourceMissing('<td>fake.url.com/rss.xml</td>')
                ->assertSourceMissing('some rss post title')
                ->assertSourceMissing('some description')
                ->assertSourceMissing('<td>http://some.item.post/url/link</td>')
                ;
        });

    }

    /**
     * Testing RssItems filter by title. Implemented 2 cases
     * - success, eg filter by existing post item title, and assure all fields are rendered
     * - nonpresent title, assure nothing from the currently seeded post item is there
     *
     * @return void
     */
    public function testListURLFilterRssUrlTitle()
    {
        $rssUrl = new RssUrl();
        $rssUrl->url = 'fake.url.com/rss.xml';

        $rssUrl->save();

        $rssItem = new RssItem();
        $rssItem->rss_url_id = $rssUrl->id;
        $rssItem->title = 'some rss post title';
        $rssItem->source = $rssUrl->url;
        $rssItem->source_url = $rssUrl->url;
        $rssItem->link = 'http://some.item.post/url/link';
        $rssItem->publish_date = '2023-01-05 16:29:08';
        $rssItem->description = 'some description';

        $rssItem->save();

        $this->browse(function (Browser $browser) {
            $browser->visit('/rss_items?title=some+rss')
                ->assertSourceHas('<td>fake.url.com/rss.xml</td>')
                ->assertSourceHas('some rss post title')
                ->assertSourceHas('some description')
                ->assertSourceHas('<td>http://some.item.post/url/link</td>')
                ;
        });

        $this->browse(function (Browser $browser) {
            $browser->visit('/rss_items?title=some+nonpresent+rss')
                ->assertSourceMissing('<td>fake.url.com/rss.xml</td>')
                ->assertSourceMissing('some rss post title')
                ->assertSourceMissing('some description')
                ->assertSourceMissing('<td>http://some.item.post/url/link</td>')
                ;
        });

    }

    /**
     * Testing RssItems filter by title. Implemented again 2 cases
     * - success, eg filter by existing post published data, and assure all fields are rendered
     * - nonpresent date, assure nothing from the currently seeded post item is there
     *
     * @return void
     */
    public function testListURLFilterRssUrlPublishDate()
    {
        $rssUrl = new RssUrl();
        $rssUrl->url = 'fake.url.com/rss.xml';

        $rssUrl->save();

        $rssItem = new RssItem();
        $rssItem->rss_url_id = $rssUrl->id;
        $rssItem->title = 'some rss post title';
        $rssItem->source = $rssUrl->url;
        $rssItem->source_url = $rssUrl->url;
        $rssItem->link = 'http://some.item.post/url/link';
        $rssItem->publish_date = '2023-01-05 16:29:08';
        $rssItem->description = 'some description';

        $rssItem->save();

        $this->browse(function (Browser $browser) {
            $browser->visit('/rss_items?publish_date=2023-01-05')
                ->assertSourceHas('<td>fake.url.com/rss.xml</td>')
                ->assertSourceHas('some rss post title')
                ->assertSourceHas('some description')
                ->assertSourceHas('<td>http://some.item.post/url/link</td>')
                ;
        });

        $this->browse(function (Browser $browser) {
            $browser->visit('/rss_items?publish_date=2023-01-03')
                ->assertSourceMissing('<td>fake.url.com/rss.xml</td>')
                ->assertSourceMissing('some rss post title')
                ->assertSourceMissing('some description')
                ->assertSourceMissing('<td>http://some.item.post/url/link</td>')
                ;
        });

    }
}
