@extends('layouts.app')

@section('title', 'Recipe')

@section('content')
	<br />
    <div class="card" style="margin-bottom:60px;">
        <div class="card-header">
            Kategori
        </div>
        <div class="card-body">
            <a href="{{url('/')}}" class="btn btn-outline-secondary btn-sm">Kembali</a>
            <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#ModalAddCat">Tambah Kategori</button>
            @foreach ($checkCategory as $cC)
                @php
                $check[] = $cC->id_category
                @endphp
            @endforeach
           	<table class="table table-bordered" style="margin-top:10px">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($dataCategory as $dC)
                    <tr>
                        <td>{{ $dC->id }}</td>
                        <td>{{ $dC->name_category }}</td>
                        <td>
                            <button type="button" class="btn btn-secondary btn-sm" onclick="editCategory('{{$dC->name_category}}','{{$dC->id}}')">Edit</button>
                            @if (in_array($dC->id, $check))
                                <button class="btn btn-secondary btn-sm" disabled>Hapus</button>
                            @else
                                <a href="{{url('dodeletecategory/'.$dC->id)}}" class="btn btn-secondary btn-sm" onclick="return confirm('Yakin ingin dihapus?')">Hapus</a>
                           	@endif 
                        </td>
                    </tr>
                @endforeach
                </tbody>
           </table>
        </div>
    </div>

	<!--modal add-->
	<div class="modal fade" id="ModalAddCat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  		<div class="modal-dialog" role="document">
    		<div class="modal-content">
      			<div class="modal-header">
        			<h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
        			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          				<span aria-hidden="true">&times;</span>
        			</button>
      			</div>
      			<form action="{{url('/doaddcategory')}}" method="post">
      				<div class="modal-body">
        			{{ csrf_field() }}
          				<div class="form-group">
            				<label class="col-form-label">Nama Kategori</label>
            				<input type="text" class="form-control" name="name_category">
          				</div>
      				</div>
      				<div class="modal-footer">
        				<button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">Batal</button>
        				<button type="submit" class="btn btn-secondary btn-sm">Simpan</button>
      				</div>
      			</form>
    		</div>
  		</div>
	</div>

	<!--modal edit-->
	<div class="modal fade" id="ModalEditCat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  		<div class="modal-dialog" role="document">
    		<div class="modal-content">
      			<div class="modal-header">
        			<h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
        			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          				<span aria-hidden="true">&times;</span>
        			</button>
      			</div>
     			 <form action="{{url('/doeditcategory')}}" method="post">
      				<div class="modal-body">
        			{{ csrf_field() }}
          				<div class="form-group">
            				<label class="col-form-label">Nama Kategori</label>
            				<input type="text" id="name_catEd" class="form-control" name="name_category">
            				<input type="hidden" id="id_catEdit" name="id">
          				</div>
      				</div>
      				<div class="modal-footer">
        				<button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">Batal</button>
        				<button type="submit" class="btn btn-secondary btn-sm" >Simpan</button>
      				</div>
      			</form>
    		</div>
  		</div>
	</div>

@endsection