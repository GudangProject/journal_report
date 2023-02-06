<div class="col-sm-12">
    <div class="card card-congratulations">
        <div class="card-body text-center">
            <div class="text-center">
                <h3 class="card-text text-white m-auto w-75">
                    Selamat Datang, {{ ucwords(auth()->user()->name) }} di {{ config('app.name') }}
                </h3>
            </div>
        </div>
    </div>
</div>
