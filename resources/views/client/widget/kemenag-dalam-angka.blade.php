<section class="">
    <div class="section-title">
        <h1><a href="{{ $slug ?? '/layanan' }}">{{ $title }}</a></h1>
    </div>
    <div class="custom-tabs">
        <input type="radio" name="custom-tabs" id="tabone" checked="checked">
        <label for="tabone">DATA WILAYAH ADMINISTRASI SULBAR</label>
        <div class="tab">
            {{-- {{ dd($menu_office) }} --}}
            @foreach ($menu_office as $office)
            <div class="accordion" id="accordionExample">
                <div class="p-0">
                  <div class="">
                      <button class="btn btn-dark btn-block text-left mb-2" type="button" data-toggle="collapse" data-target="#collapseOne{{ $office->id }}" aria-expanded="true" aria-controls="collapseOne">
                        <i class="fa fa-list"></i>  {{ strtoupper($office->title) }}
                      </button>
                  </div>

                  <div id="collapseOne{{ $office->id }}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card">
                        <div class="card-deck p-4">
                            <div class="card" id="card-height">
                              <div class="card-body text-center">
                                <h3 class="data-count">{{ $office->luas_wilayah }}</h3>
                                <h6>LUAS WILAYAH</h6>
                              </div>
                            </div>
                            <div class="card" id="card-height">
                                <div class="card-body text-center">
                                  <h3 class="data-count">{{ $office->jumlah_kecamatan }}</h3>
                                  <h6>JUMLAH KECAMATAN</h6>
                                </div>
                            </div>
                            <div class="card" id="card-height">
                                <div class="card-body text-center">
                                  <h3 class="data-count">{{ $office->jumlah_kelurahan }}</h3>
                                  <h6>JUMLAH KELURAHAN</h6>
                                </div>
                            </div>
                            <div class="card" id="card-height">
                                <div class="card-body text-center">
                                  <h3 class="data-count">{{ $office->jumlah_desa }}</h3>
                                  <h6>JUMLAH DESA</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
            @endforeach
        </div>

        <input type="radio" name="custom-tabs" id="tabtwo">
        <label for="tabtwo">JUMLAH SATKER PADA KANWIL KEMENAG SULBAR</label>
        <div class="tab">
          <img src="https://sulbar.kemenag.go.id/wp-content/uploads/2022/01/Jumlah-Satker_001-scaled.jpg" alt="">
        </div>

        <input type="radio" name="custom-tabs" id="tabthree">
        <label for="tabthree">JUMLAH PNS MENURUT KUALIFIKASI PENDIDIKAN</label>
        <div class="tab">
          <img src="https://sulbar.kemenag.go.id/wp-content/uploads/2022/01/PNS-Menurut-Pendidikan_001-scaled-e1642498944617-1536x1078.jpg" alt="">
        </div>

        <input type="radio" name="custom-tabs" id="tabfour">
        <label for="tabfour">JUMLAH FKUB, SEKBER DAN DESA SADAR KERUKUNAN</label>
        <div class="tab">
          <h1>Tab Four Content</h1>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
        </div>
    </div>
</section>
