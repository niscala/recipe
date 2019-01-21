@extends('layouts.app')

@section('title', 'Recipe')

@section('content')
    <br />
    <div class="card" style="margin-bottom:60px;">
        <div class="card-header">
            Tambah Resep Baru
        </div>
        <div class="card-body">

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div><br />
            @endif

            <form action="{{url('addrecipe')}}" method="post">
            {{ csrf_field() }}
                <div class="form-row" style="margin-bottom:10px;">
                    <div class="col-md-12" align="center">
                        <img id="layout-img" class="rounded" width="200" height="200" >
                        <input type="hidden" id="data-img" name="images" >
                        <div class="img-result">
                            <img class="cropped rounded" alt="" width="200" height="200" style="display:none">
                        </div>
                    </div>
                </div>
                <div class="form-row" style="margin-bottom:20px;">
                    <div class="col-md-12" align="center">
                        <span class="btn btn-outline-secondary btn-sm btn-file"> 
                            <span class="fileinput-new">Pilih Gambar</span> 
                            <input type="file" id="file-image" class="form-control-file" name="gambar">
                        </span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Nama Resep</label>
                        <input type="text" class="form-control" name="name_recipe">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Kategori</label>
                        @if ($dataCategory->isNotEmpty())
                        <select class="form-control" name="id_category">
                            <option selected disabled>-Pilih Kategori Resep-</option>
                            @foreach ($dataCategory as $dC)
                                <option value="{{ $dC->id }}">{{ $dC->name_category }}</option>
                            @endforeach
                         </select>
                         @else
                            <input type="text" name="id_category" class="form-control" value="Tidak ada kategori. Silakan tambahkan kategori" disabled>
                         @endif
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12">
                        <label>Bahan Resep</label>
                    </div>
                    <div class="form-group col-md-7">
                    @if ($dataIngredients->isNotEmpty())
                        <select class="form-control" name="id_ingredients[]">
                            <option selected disabled>-Pilih bahan-</option>
                            @foreach ($dataIngredients as $dI)
                                <option value="{{ $dI->id }}">{{ $dI->name_ingredients  }}</option>
                            @endforeach
                        </select>
                    @else
                        <input type="text" name="id_ingredients" class="form-control" value="Tidak ada bahan resep. Silakan tambahkan bahan resep" disabled>
                    @endif
                    </div>
                    <div class="form-group col-md-3">
                    @if ($dataIngredients->isNotEmpty())
                        <input type="text" class="form-control" name="amount[]" placeholder="Banyaknya">
                    @else
                        <input type="text" class="form-control" name="amount[]" disabled>
                    @endif
                    </div>
                    <div class="form-group col-md-2">
                    @if ($dataIngredients->isNotEmpty())
                        <button type="button" class="btn btn-outline-secondary btn-sm btn-block" id="addRecipeForm">Tambah Bahan</button>
                    @else
                        <button type="button" class="btn btn-outline-secondary btn-sm btn-block" id="addRecipeForm" disabled>Tambah Bahan</button>
                    @endif
                    </div>
                </div>
                <span id="appendRecipeForm"></span>
                <a href="{{url('/')}}" class="btn btn-outline-secondary btn-sm">Batal</a>
                <button type="submit" class="btn btn-secondary btn-sm">Simpan</button>
            </form>
        </div>
    </div>

    <!-- MODAL CROP IMAGE -->
    <div id="myModal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="result"></div>
                </div>
                <div class="modal-footer">
                    <button id="ok-crop" class="btn btn-secondary btn-sm hide">OK</button>
                </div>
            </div>
        </div>
    </div>

@endsection