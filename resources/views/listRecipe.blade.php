@extends('layouts.app')

@section('title', 'Recipe')

@section('content')
    <br />
    <div class="row">
        <div class="col-md-6">
            <a href="{{url('buat-resep')}}" class="btn btn-secondary btn-sm">Tambah Resep</a>
        </div>
        <div class="col-md-6">
            <div class="pull-right">
                <select id="filterCat" class="form-control form-control-sm">
                    <option value="all">Semua Kategori</option>
                    @foreach ($dataCat as $dC)
                    <option value="{{$dC->id}}">{{ $dC->name_category }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
   
    <div id="allcat" class="row" style="margin-top:10px">
    @if ($dataRecipe->isNotEmpty())
        @foreach ($dataRecipe as $dR)
            <div class="col-md-3 backCol column{{$dR->id_category}}">
                <div class="card" style="margin-bottom:25px;">
                    <a href="{{ url($dR->id.'/lihat-resep/'.str_replace(' ','-',$dR->name_recipe).'/') }}">
                        <img src="../storage/app/images/{{ $dR->images }}" class="card-img-top" alt="...">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title p-wrap">{{ $dR->name_recipe }}</h5>
                        <span class="badge badge-pill badge-secondary">{{ $dR->name_category }}</span>
                    </div>
                </div>
            </div>
       @endforeach
    @else
        <p>Tidak ada resep</p>
    @endif  
    </div>

@endsection