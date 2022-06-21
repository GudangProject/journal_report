<section class="container home_section1">
    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            @include('client.widget.banner', ['data'=>$banner_footer])
        </div>
    </div>
</section>

<footer id="footer-container" class="jl_footer_act enable_footer_columns_dark">
    <div class="footer-columns">
        <div class="container">
            <div class="row justify-content-between align-items-center text-center">
                <div class="col-md-5 mb-4">
                    <img class="" src="{{asset('assets/images/logo.png')}}" alt="" width="300"/>
                </div>
                <div class="col-md-7">
                    <h4 class="text-white">Alamat</h4>
                    <span>Kementerian Agama Provinsi Sulawesi Selatan. Jl. Nuri No.53, Tamarunang, Kec. Mariso, Kota Makassar, Sulawesi Selatan 90126</span>
                </div>
            </div>
        </div>
    </div>
    <div class="">
        @include('client.widget.medsos-icon')
    </div>
    <div class="footer-bottom enable_footer_copyright_dark">
        <div class="container">
            <div class="row bottom_footer_menu_text">
                <div class="col-md-12">
                    <div class="jl_ft_w">
                        <span>© Copyright {{ date('Y') }} - Kementerian Agama RI Provinsi Sulawesi Selatan</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
