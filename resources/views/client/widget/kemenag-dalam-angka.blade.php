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
        <label for="tabfour">JUMLAH FKUB, DESA SADAR KERUKUNAN</label>
        <div class="tab">
            <div class="accordion" id="accordionExample">
                <div class="p-0">
                    <div class="">
                        <button class="btn btn-dark btn-block text-left mb-2" type="button" data-toggle="collapse" data-target="#collapseOne1" aria-expanded="true" aria-controls="collapseOne">
                            <i class="fa fa-list"></i>  FORUM KERUKUNAN UMAT BERAGAMA (FKUB)
                        </button>
                    </div>

                    <div id="collapseOne1" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card">
                            <div class="card-deck p-4">
                                @foreach ($menu_office as $fkub)
                                    <div class="card" id="card-height">
                                        <div class="card-body text-center">
                                            <h3 class="data-count">{{ $fkub->fkub }}</h3>
                                            <h6>KAB.{{ strtoupper($fkub->title) }}</h6>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion" id="accordionExample">
                <div class="p-0">
                    <div class="">
                        <button class="btn btn-dark btn-block text-left mb-2" type="button" data-toggle="collapse" data-target="#collapseOne2" aria-expanded="true" aria-controls="collapseOne">
                            <i class="fa fa-list"></i>  SEKRETARIAT BERSAMA (SEKBER)
                        </button>
                    </div>

                    <div id="collapseOne2" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card">
                            <div class="card-deck p-4">
                                @foreach ($menu_office as $sekber)
                                    <div class="card" id="card-height">
                                        <div class="card-body text-center">
                                            <h3 class="data-count">{{ $sekber->sekber }}</h3>
                                            <h6>KAB.{{ strtoupper($sekber->title) }}</h6>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion" id="accordionExample">
                <div class="p-0">
                    <div class="">
                        <button class="btn btn-dark btn-block text-left mb-2" type="button" data-toggle="collapse" data-target="#collapseOne3" aria-expanded="true" aria-controls="collapseOne">
                            <i class="fa fa-list"></i>  DESA SADAR KERUKUNAN
                        </button>
                    </div>

                    <div id="collapseOne3" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card">
                            <div class="card-deck p-4">
                                @foreach ($menu_office as $desake)
                                    <div class="card" id="card-height">
                                        <div class="card-body text-center">
                                            <h3 class="data-count">{{ $desake->desa_sadar_kerukunan }}</h3>
                                            <h6>KAB.{{ strtoupper($desake->title) }}</h6>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
