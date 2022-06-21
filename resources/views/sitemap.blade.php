<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($data['data'] as $item)
        <sitemap>
            <loc>{{ $data['url'].'/'.$item['slug'].'/sitemap.xml'}}</loc>
            <lastmod>{{date("c", $item['published_at'])}}</lastmod>
        </sitemap>
    @endforeach
</sitemapindex>
