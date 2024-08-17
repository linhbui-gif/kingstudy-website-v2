    <title>{{ $meta_title }}</title>
    <meta name="description" content="{{ $meta_description }}">
    <link rel="canonical" href="{{ $link }}"/>

    <meta property="og:site_name" content="kingstudy.vn"/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" itemprop="url" content="{{ $link }}"/>
    <meta property="og:image" itemprop="thumbnailUrl" content="{{ $thumbnail }}"/>
    <meta content="{{ $meta_title }}" itemprop="headline" property="og:title"/>
    <meta content="{{ $meta_description }}" itemprop="description" property="og:description"/>
    @if($robots && $robots == 1)
    <meta name="robots" content="all">
    @else
    <meta name="robots" content="noindex">
    @endif
