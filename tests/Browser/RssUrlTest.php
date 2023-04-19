<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

use App\Models\RssUrl;

class RssUrlTest extends DuskTestCase
{

    use DatabaseMigrations;

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testRootURL()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/rss_urls')
                ->assertTitle('EmerchantPay RSS CRUD Application')
                ->assertSourceHas('<b>RSS Feed Urls</b>')
                ;
        });
    }

    public function testListURL()
    {
        $rssUrl = new RssUrl();
        $rssUrl->url = 'fake.url.com/rss.xml';

        $rssUrl->save();

        $this->browse(function (Browser $browser) {
            $browser->visit('/rss_urls')
                    ->assertSourceHas('<td>fake.url.com/rss.xml</td>');
        });
    }
}
