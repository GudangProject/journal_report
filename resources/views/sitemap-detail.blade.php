<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($data['data'] as $item)
    <url>
        <loc>{{ $item->url }}</loc>
        <lastmod>{{ $item->date }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.9</priority>
    </url>
    @endforeach
</urlset>
