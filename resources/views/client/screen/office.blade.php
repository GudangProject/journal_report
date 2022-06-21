@extends('layouts.master-test')

@section('content')
<div id="content_main" class="clearfix">
    <div class="container">
        <div class="row main_content">
            <div class="col-md-12">
                <div class="single-product-wrap clearfix">
                    <div class="woocommerce-notices-wrapper"></div>
                    <div id="product-70" class="product type-product post-70 status-publish first instock product_cat-posters product_tag-fashion product_tag-style has-post-thumbnail sale shipping-taxable purchasable product-type-simple">
                        <div class="jl-wc-wrap single-product-content">
                            <div class="jl-wc-img">
                                <div class="wc-single-featured"> <span class="onsale">{{ $data->getCategory->name }}</span>
                                    <div class="woocommerce-product-gallery woocommerce-product-gallery--with-images woocommerce-product-gallery--columns-4 images" data-columns="4">
                                        <figure class="woocommerce-product-gallery__wrapper">
                                            <div class="woocommerce-product-gallery__image">
                                                <img src="{{ is_file(public_path($data->images['medium'])) ? $data->images['medium'] : '/storage/images/default.jpg' }}" alt="{{ $data->title }}" class="wp-post-image" alt="" loading="lazy" title="product" />
                                            </div>
                                        </figure>
                                    </div>
                                </div>
                            </div>
                            <div class="jl-wc-dec">
                                <div class="summary entry-summary">
                                    <h1 class="product_title entry-title h2">Kantor Kementerian Agama {{ $data->title }}</h1>
                                    <a href="{{ $data->description }}" target="_blank" class="mb-0"><span class="badge badge-light-primary">WEBSITE: {{ $data->title }} <i class="fas fa-arrow-right"></i></span></a>
                                    <div class="woocommerce-tabs wc-tabs-wrapper">
                                        <ul class="tabs wc-tabs tabs-product" role="tablist">
                                            <li class="description_tab active" id="tab-title-description">
                                                <a href="#tab-description">PROFIL</a>
                                            </li>
                                            <li class="additional_information_tab" id="tab-title-additional_information">
                                                <a href="#tab-additional_information">KEPALA KANTOR</a>
                                            </li>
                                        </ul>
                                        <div class="tab-container">
                                            <div class="tab-content woocommerce-Tabs-panel woocommerce-Tabs-panel--description panel entry-content wc-tab" id="tab-description">
                                                <div class="entry entry-content clearfix">
                                                    <div class="woocommerce-product-details__short-description">
                                                        <div class="woocommerce-product-details__short-description">
                                                            <p>{!! $data->content !!}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-content woocommerce-Tabs-panel woocommerce-Tabs-panel--additional_information panel entry-content wc-tab" id="tab-additional_information">
                                                <div class="">
                                                    {!! $data->information !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @include('client.widget.list-row3', ['title'=> "BERITA DAERAH $data->title", 'data'=> $posts, 'limit'=> 12])
                <div class="d-flex justify-content-center mt-4 mb-3">
                    {{ $posts->onEachSide(0)->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
