<div>
    <section class="home_section1">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 mb-4">
                    <section>
                        <div class="section-title">
                            <h1>BIDANG LAYANAN </h1>
                        </div>
                        <div class="row">
                            @foreach ($services as $item)
                            <div class="col-md-3 col-12" style="margin-top: 10px">
                                <div class="card card-profile">
                                    <div class="card-body p-3 text-left">
                                        <span class="title-card mb-3">
                                            <a href="#" tabindex="-1">{{ $item->nama_layanan }}</a>
                                        </span>
                                        {{-- <strong>{{ $item->total_layanan }}</strong>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar" role="progressbar" style="width: {{ $item->total_layanan }}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div> --}}

                                        <a wire:click="serviceRequest({{ $item->id_layanan }})" class="btn btn-sm btn-primary mt-4 p-2 btn-block">Ajukan Layanan Permohonan <i class="fas fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                            <!-- Modal -->
                            <div wire:ignore.self style="z-index:99999;" id="service-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Ajukan Permohonan Pelayanan</h5>
                                        </div>
                                        <div class="modal-body">
                                            {{-- <form> --}}
                                                <input hidden wire:model.defer='service_id' type="number" class="wpcf7-form-control-wrap">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Nomor Permohonan</label>
                                                    <input wire:model='number_request' readonly type="number" class="wpcf7-form-control-wrap" id="exampleInputEmail1">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Layanan </label>
                                                    <select wire:model='service_list' class="wpcf7-form-control-wrap" style="padding: 8px 8px 8px 15px;">
                                                        <option value="" disabled selected>Pilih Layanan</option>
                                                        @foreach ($data as $service)
                                                            <option value="{{ $service->id_detail_layanan }}">{{ $service->nama_detail_layanan }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @if ($service_list != null)
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Persyaratan</label>
                                                        <textarea class="u-full-width" rows=10" readonly>{{ $requirements }}</textarea>
                                                    </div>
                                                @endif

                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Email</label>
                                                    <input type="email" wire:model='email' placeholder="Email" class="wpcf7-form-control-wrap">

                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Nama/Instansi</label>
                                                    <input type="text" wire:model='name' placeholder="Nama Permohonan/Nama Instansi" class="wpcf7-form-control-wrap">

                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Telepon</label>
                                                    <input type="number" wire:model='phone' placeholder="Diawali dengan +62" class="wpcf7-form-control-wrap">

                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Alamat</label>
                                                    <textarea class="u-full-width" wire:model='address' placeholder="Alamat" rows="3"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">File Persyaratan <i>(.pdf, .zip, .rar) Maks 9MB</i></label>
                                                    <input type="file" wire:model='document' class="wpcf7-form-control-wrap">

                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Catatan</label>
                                                    <textarea class="u-full-width" wire:model='note' placeholder="Catatan" rows="3"></textarea>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" wire:click='saveServiceRequest()' class="button">Ajukan</button>
                                            </div>
                                        {{-- </form> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                $(function () {
                    $('[data-toggle="tooltip"]').tooltip()
                })
                Livewire.hook('message.processed', (message, component) => {
                    $(function () {
                        $('[data-toggle="tooltip"]').tooltip()
                    })
                })
            });

            window.addEventListener('openModalServiceRequest', event => {
                $("#service-modal").modal('show');
            });

            window.addEventListener('closeModalServiceRequest', event => {
                $("#service-modal").modal('hide');
            });

        </script>

    @endpush
</div>
