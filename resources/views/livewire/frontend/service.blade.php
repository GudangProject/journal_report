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
                                        @php
                                            $count_layanan = \App\Models\Service\ServiceRequest::whereIn('detail_layanan_id', $item->serviceDetail->pluck('id_detail_layanan'))->get();
                                        @endphp
                                        <strong>{{ $count_layanan->count() }}</strong>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar" role="progressbar" style="width: {{ $count_layanan->count()/10 }}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>

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
                                                        @if ($service->layanan_id == $service_id)
                                                            <option value="{{ $service->id_detail_layanan }}">{{ $service->nama_detail_layanan }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                @error('service_list') <small class="alert alert-danger p-1">{{ $message }}</small> @enderror
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
                                                @error('email') <small class="alert alert-danger p-1">{{ $message }}</small> @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Nama/Instansi</label>
                                                <input type="text" wire:model='name' placeholder="Nama Permohonan/Nama Instansi" class="wpcf7-form-control-wrap">
                                                @error('name') <small class="alert alert-danger p-1">{{ $message }}</small> @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Telepon</label>
                                                <input type="number" wire:model='phone' placeholder="Diawali dengan +62" class="wpcf7-form-control-wrap">
                                                @error('phone') <small class="alert alert-danger p-1">{{ $message }}</small> @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Alamat</label>
                                                <textarea class="u-full-width" wire:model='address' placeholder="Alamat" rows="3"></textarea>
                                                @error('address') <small class="alert alert-danger p-1">{{ $message }}</small> @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">File Persyaratan <i>(.pdf, .zip, .rar) Maks 9MB</i></label>
                                                <input type="file" wire:model='document' accept=".zip,.rar,.pdf" class="wpcf7-form-control-wrap">
                                                @error('document') <small class="alert alert-danger p-1">{{ $message }}</small> @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Catatan</label>
                                                <textarea class="u-full-width" wire:model='note' placeholder="Catatan" rows="3"></textarea>
                                                @error('note') <small class="alert alert-danger p-1">{{ $message }}</small> @enderror
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" wire:click='saveServiceRequest()' class="button">Ajukan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div wire:ignore.self style="z-index:99999;" id="alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body bg-primary rounded text-white">
                                            <strong>Permohonan berhasil diajukan !</strong>
                                        </div>
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

            window.addEventListener('openAlertModal', event => {
                $("#alert-modal").modal('show');
            });

        </script>

    @endpush
</div>
