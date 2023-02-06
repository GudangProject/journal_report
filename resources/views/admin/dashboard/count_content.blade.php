<div class="col-lg-8 col-sm-8 col-12">
    <div class="card">
        <div class="card-header flex-column align-items-start pb-0">
            <div class="row">
                <div class="col-6">
                    <div class="alert alert-success p-1">
                        <h2 class="font-weight-bolder mt-1 text-primary"><i data-feather="book" class="font-medium-5"></i> {{ $data['total_journal'] }}</h2>
                        <p class="card-text">Total Semua Jurnal</p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="alert alert-success p-1">
                        <h2 class="font-weight-bolder mt-1 text-primary"><i data-feather="activity" class="font-medium-5"></i> {{ $data['total_stock_journal'] }}</h2>
                        <p class="card-text">Slot yang tesedia</p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="alert alert-success p-1 mt-1">
                        <h2 class="font-weight-bolder mt-1 text-primary"><i data-feather="book" class="font-medium-5"></i> {{ $data['my_total_stock_journal'] }}</h2>
                        <p class="card-text">Sisa Slot Jurnal Saya</p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="alert alert-success p-1 mt-1">
                        <h2 class="font-weight-bolder mt-1 text-primary"><i data-feather="book" class="font-medium-5"></i> {{ $data['my_naskah_used'] }}</h2>
                        <p class="card-text">Slot Terpakai</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-4 col-sm-4 col-12">
    <div class="card">
        <div class="card-header flex-column align-items-start pb-0">
            <div class="row">
                <div class="col-12">
                    <div class="alert p-1">
                        <h2 class="font-weight-bolder mt-1 text-primary"><i data-feather="book" class="font-medium-5"></i> {{ $data['my_total_journal'] }}</h2>
                        <p class="card-text">Jurnal Saya</p>
                    </div>
                </div>
                <div class="col-12">
                    <div class="alert p-1 mt-1">
                        <h2 class="font-weight-bolder mt-1 text-primary"><i data-feather="book" class="font-medium-5"></i> {{ $data['my_naskah'] }}</h2>
                        <p class="card-text">Naksah Saya</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
