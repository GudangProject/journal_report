<div>
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-5 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h3 class="content-header-title float-left mb-0">Integrasi</h3>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/dashboard">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active">List Integrasi
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-7">
                    <div class="form-group breadcrumb-right">
                        <button wire:click.prevent="create" class="btn btn-sm btn-primary">Buat Integrasi</button>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="content-body">
                    @if (session()->has('message'))
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <div class="alert-body"><strong>{{ session('message') }}</strong></div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <section id="all-post">
                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon-search1"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg></span>
                            </div>
                            <input type="text" wire:model="search" class="form-control" placeholder="Search..." aria-label="Search..." aria-describedby="basic-addon-search1">
                        </div>
                        <div class="card card-company-table">
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Url</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($row as $item)
                                            <tr>
                                                <td scope="row">
                                                    <span class="badge badge-pill badge-light-primary">{{ $loop->index + 1 }}</span>
                                                </td>
                                                <td>
                                                    <strong class="text-primary">{!! $item->name !!}</strong>
                                                </td>
                                                <td>{{ $item->domain }}</td>
                                                <td class="text-center">
                                                    <div class="btn-group btn-group-sm" role="group" aria-label="Action">
                                                        <a href="{{ route('integrations.show', $item->id) }}" class="btn btn-primary" title="Delete"><i class="fas fa-share"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="6" class="text-center">
                                                    <div class="d-flex justify-content-center">
                                                        <img src="{{ asset('assets/empty.svg') }}" alt="" width="100">
                                                    </div>
                                                    <h4 class="text-muted">Ups! Tidak ditemukan 😳</h4>
                                                </td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

    @include('livewire.components.integration-modal')

</div>
