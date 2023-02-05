<x-master-layout>
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Edit Point {{ $data['title'] }}</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{route('points.index')}}">Point</a>
                                    </li>
                                    <li class="breadcrumb-item">Edit Point {{ $data['title'] }}</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="multiple-column-form">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <form class="form-horizontal" role="form" id="coba" method="POST" enctype="multipart/form-data" action="{{route('settings.update', $data['id'])}}">
                                        @method('PUT')
                                        @csrf
                                        <div class="card-header">
                                            <div class="float-right">
                                                <button type="submit" class="btn btn-primary mr-1">Save</button>
                                                <a class="btn btn-secondary mr-1" href="{{ route('settings.index') }}">Cancel</a>
                                            </div>
                                        </div>
                                        <div class="card-header">
                                            <h3><span class="badge badge-light-primary">Point Content Berita</span></h3 >
                                        </div>
                                        <div class="card-body row">
                                            @if(isset($data['data']))
                                                @foreach($data['data'] as $k=>$v)
                                                    @if(isset($v['category']))
                                                        @foreach($v['category'] as $a=>$b)
                                                        <div class="form-group col-2">
                                                            <h5 class="text-primary">{{$b['name']}}</h5>
                                                            <div class="container row d-flex justify-content-start">
                                                                <input hidden name="modul[]" type="text" class="form-control col-md-5" value="{{ $k }}"/>
                                                                <input hidden name="category[]" type="number" class="form-control col-md-5" value="{{$b['category_id']}}"/>
                                                                <select name="point[]" class="form-control">
                                                                    @for($i=0;$i<=20;$i++)
                                                                    <option value="{{$i}}"
                                                                            @if($b['point'] > 0)
                                                                            @if($b['point'] == $i)
                                                                            selected="selected"
                                                                        @endif
                                                                        @endif
                                                                    >{{$i}}</option>
                                                                @endfor
                                                                </select>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            @endif
                                        </div>
                                        <hr>
                                        <div class="card-header">
                                            <h3><span class="badge badge-light-primary">Point Content Photo & Video</span></h3 >
                                        </div>
                                        <div class="card-body row">
                                            @if(isset($data['data']))
                                                @foreach($data['data'] as $k=>$v)
                                                    @if($k == 'post')
                                                        @continue
                                                    @endif
                                                    <div class="form-group col-2">
                                                        <h5 class="text-primary text-capitalize">{{$k}}</h5>
                                                        <div class="container row d-flex justify-content-start">
                                                            <input hidden name="modul[]" type="text" class="form-control col-md-5" value="{{ $k }}"/>
                                                            <input hidden name="category[]" type="number" class="form-control col-md-5" value="{{$b['category_id']}}"/>
                                                            <select name="point[]" class="form-control">
                                                                @for($i=0;$i<=20;$i++)
                                                                <option value="{{$i}}"
                                                                        @if($b['point'] > 0)
                                                                        @if($b['point'] == $i)
                                                                        selected="selected"
                                                                    @endif
                                                                    @endif
                                                                >{{$i}}</option>
                                                            @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Basic Floating Label Form section end -->

            </div>
        </div>
    </div>
</x-master-layout>
