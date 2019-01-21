@extends('layouts.app')

@section('title', 'Recipe')

@section('content')
    <br />
    <div class="card" style="margin-bottom:60px;">
        <div class="card-header">
            Detail resep
        </div>
        <div class="card-body">
            @foreach ($dataRecipe as $dR)
            <div class="row">
                <div class="col-md-3">
                    <img id="layout-img" class="rounded" width="200" height="200" src="{{url('images/'.$dR->images)}}">
                    <input type="hidden" id="data-img" name="images" >
                    <div class="img-result">
                        <img class="cropped rounded" alt="" width="200" height="200" style="display:none">
                    </div>
                    <span class="btn btn-secondary btn-sm btn-file pos-abs"> 
                        <span class="fileinput-new">Ganti Gambar</span> 
                        <input type="file" id="file-imageEd" class="form-control-file" name="gambar">
                    </span>
                </div>
                <div class="col-md-5">
                    <h5 class="card-title p-wrap" id="nameRecipe"><span class="nameRecipe">{{ $dR->name_recipe }}</span> <button type="button" id="editName" class="btn btn-default btn-xs" onclick="editNameRec('{{ $dR->id }}')">Edit</button></h5>
                    <span id="nameCateg" class="badge badge-pill badge-secondary">{{ $dR->name_category }}</span>
                    <input type="hidden" id="id_cat" value="{{ $dR->id_category }}">
                </div>
                <div class="col-md-4">
                    <div class="pull-right">
                        <form action="{{ url('deleterecipe')}}" method="post">
                        {{ csrf_field() }}
                            <input type="hidden" value="{{$dR->id}}" name="id">
                            <a href="{{url('/')}}" class="btn btn-outline-secondary btn-sm">Kembali</a>
                            <button type="submit" class="btn btn-secondary btn-sm" onclick="return confirm('Are you sure?')">Hapus Resep</button>
                        </form>
                    </div>
                    <input type="hidden" id="id_recipe" value="{{ $dR->id }}">
                </div>
            </div>
            @endforeach
           
            <div class="row" style="margin-top:20px;">
                <div class="col-md-12">
                    <p><b>Bahan - bahan </b></p>
                    <div class="table-responsive">
                        <table class="table table-hover table-sm">
                            <tbody id="tmpDataIng">
                            @foreach ($dataIngredients as $dI)
                                <tr class="Ing{{$dI->id}}">
                                    <td class="text-nameIng{{$dI->id}}">{{ $dI->name_ingredients }}</td>
                                    <td width="300"><span class="text-amount{{$dI->id}}">{{ $dI->amount }}</span></td>
                                    <td width="130">
                                        <div class="pull-right">
                                            <button type="button" class="btn btn-default btn-xs" onclick="editIng('{{$dI->id}}')">Edit</button>
                                            <button type="button" class="btn btn-default btn-xs" onclick="delIng('{{$dI->id}}')">Hapus</button>
                                        </div>
                                    </td>
                                </tr>
                                <input type="hidden" id="id_main{{ $dI->id }}" value="{{ $dI->id }}">
                                <input type="hidden" id="id_ing" value="{{ $dI->id_ingredients }}">
                            @endforeach
                            </tbody>
                            <tfoot id="appendIng">
                                <tr id="addIng">
                                    <td colspan="3">
                                        <button type="button" class="btn btn-outline-secondary btn-xs">Tambah bahan resep</button>    
                                    </td>
                                </tr>   
                            </tfoot>
                        </table>
                   </div>
                </div>
            </div>
        </div>
    </div>


    <!-- MODAL CROP IMAGE -->
    <div id="myModal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="resultEd"></div>
                </div>
                <div class="modal-footer">
                    <button id="ok-cropEd" class="btn btn-secondary btn-sm hide">OK</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal edit-->
    <div id="EditModal" class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col-md-6">
                            <input type="text" id="name_ingModal" class="form-control form-control-sm" disabled>
                        </div>
                        <div class="col-md-4">
                            <input type="text" id="amountModal" class="form-control form-control-sm">
                            <input type="hidden" id="id_mainModal">
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-secondary btn-sm" onclick="doEditIng()">Simpan</button>
                            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="cancelEditModal()">Batal</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection