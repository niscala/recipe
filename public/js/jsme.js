function editCategory(name_category, id) {
    $('#ModalEditCat').modal('show');
    $('#name_catEd').val(name_category);
    $('#id_catEdit').val(id);
}

function editIngredients(name_ingredients, id) {
    $('#ModalEditIng').modal('show');
    $('#name_ingEd').val(name_ingredients);
    $('#id_ingEdit').val(id);
}

function cancelRecipeForm(i) {
    $('.'+i).remove();
}

function cancelIng() {
    $('tfoot tr.addIngForm').remove();
    $('#addIng').removeAttr('style');
}

function saveIng() {
    var tmpData = $('#id_ingredients').val()
        amount = $('#amount').val()
        id_recipe = $('#id_recipe').val()
        arr = tmpData.split('/')
        name_ingredients = arr[1]
        id_ingredients = arr[0]
        id = $('#id_main').val()
        x = 1;

    if ((id_ingredients == '') && (amount == '')) {
        alert('Masih kosong');
    } else {
        $.ajax({
            url: postrecing,
            type: "GET",
            dataType: "JSON",
            data: {id_recipe:id_recipe, id_ingredients:id_ingredients, amount:amount},
            success:(res) => {
                var template = '<tr class="Ing'+res[0].id+'"><td class="text-nameIng'+res[0].id+'">'+name_ingredients+'</td>'
                    +'<td><span class="text-amount'+res[0].id+'">'+amount+'</span></td>'
                    +'<td><div class="pull-right">'
                    +'<button type="button" class="btn btn-default btn-xs" onclick="editIng('+res[0].id+')">Edit</button> '
                    +'<button type="button" class="btn btn-default btn-xs" onclick="delIng('+res[0].id+')">Hapus</button>'
                    +'</div></td>'
                    +'</tr>';

                $('#tmpDataIng').append(template);
                $('#addIng').removeAttr('style', 'display:none');
                $('tr.addIngForm').remove();
            }
        });
        x++;
    }
}

function editIng(id) {
    var id_ingredients = $('id_ing'+id).val()
        amount = $('span.text-amount'+id).text()
        name_ing = $('td.text-nameIng'+id).text();
    $('#EditModal').modal('show');
    $('#amountModal').val(amount);
    $('#id_mainModal').val(id);
    $('#name_ingModal').val(name_ing);
}

function doEditIng() {
    var id_ingredients = $('#name_ingModal').val()
        amount = $('#amountModal').val()
        id_main = $('#id_mainModal').val();
    $.ajax({
        url: postediting,
        type: "GET",
        data: {id_ingredients:id_ingredients, amount:amount, id:id_main},
        success:(data) => {
            $('#id_mainModal').val('');
            $('span.text-amount'+id_main).text(amount);
            $('#EditModal').modal('hide'); 
        }
    });
}

function cancelEditModal() {
    $('#id_mainModal').val('');
    $('#EditModal').modal('hide');
}

function delIng(id) {
    var r = confirm("Yakin ingin dihapus?");
    if (r == true) {
        $.ajax({
            url: deling,
            type: "GET",
            data: {id:id},
            success:() => {
                $('tr.Ing'+id).remove();
            }
        });
    }       
}

function delRecipe() {
    var r = confirm("Yakin ingin dihapus?");
    if (r == true) {
        return true;
    } else {
        return false;
    }
}

function editNameRec(id) {
    var name_recipe =  $('.nameRecipe').text()
        id_cat = $('#id_cat').val()
        template = "";
    $('.nameRecipe').attr('style','display:none');
    $('#editName').attr('style','display:none');
    $('#nameCateg').attr('style', 'display:none');
    $.ajax({
        url: getcategory,
        type: "GET",
        dataType: "JSON",
        success:(data) => {
            template += '<div id="formEditNameRec" class="row">'
                +'<div class="col-md-12">'
                +'<input type="text" id="name_recipeEd" value="'+name_recipe+'" class="form-control form-control-sm">'
                +'</div>'
                +'<div class="col-md-12" style="margin-top:10px;">'
                +'<select id="id_categ" class="form-control form-control-sm">';
                for (var i = 0; i < data.length; i++) {
                    if (id_cat == data[i].id) {
                        template += '<option value="'+data[i].id+'/'+data[i].name_category+'" selected>'+data[i].name_category+'</option>'
                    } else {
                        template += '<option value="'+data[i].id+'/'+data[i].name_category+'">'+data[i].name_category+'</option>'
                    }  
                }

            template += '</select>'
                +'</div>'
                +'<div class="col-md-12" style="margin-top:10px;">'
                +'<button type="button" class="btn btn-secondary btn-sm" onclick="doEditNameRec('+id+')">Simpan</button> '
                +'<button type="button" class="btn btn-outline-secondary btn-sm" onclick="cancelEditNameRec()">Batal</button>'
                +'</div>'
                +'</div>';

            $('#nameRecipe').append(template);
        }
    });
}

function doEditNameRec(id) {
    var name_recipe = $('#name_recipeEd').val()
        tmpData = $('#id_categ').val()
        arr = tmpData.split('/')
        id_category = arr[0]
        name_category = arr[1];
    if ((name_recipe == '') && (id_category == '')) {
        alert('Masih Kosong');
    } else {
        $.ajax({
            url: uprecipename,
            type: "GET",
            data: {name_recipe:name_recipe, id_category:id_category, id:id},
            success:() => {
                $('.nameRecipe').removeAttr('style').text(name_recipe);
                $('#editName').removeAttr('style');
                $('#nameCateg').removeAttr('style').text(name_category);
                $('#formEditNameRec').remove();
            }
        });
    }
}

function cancelEditNameRec() {
    $('.nameRecipe').removeAttr('style');
    $('#editName').removeAttr('style');
    $('#nameCateg').removeAttr('style');
    $('#formEditNameRec').remove();
}

let result = document.querySelector('.result'),
cropper = '';
$('#file-image').change((e) => {
    var val = $('#file-image').val();
    switch(val.substring(val.lastIndexOf('.') + 1).toLowerCase()){
        case 'gif': case 'jpg': case 'png':           
            if (e.target.files.length) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    if (e.target.result) {
                        let img = document.createElement('img');
                        img.id = 'image';
                        img.src = e.target.result
                        result.innerHTML = '';
                        result.appendChild(img);
                        $('#myModal').modal('show');
                        cropper = new Cropper(img, {
                            aspectRatio: 1 / 1
                        });
                    }
                };
                reader.readAsDataURL(e.target.files[0]);
            }
            break;
        default:
            $(this).val('');
            alert("Masukan Gambar");
            break;
    } 
});

let resultEd = document.querySelector('.resultEd'),
cropperEd = '';
$('#file-imageEd').change((e) => {
    var val = $('#file-imageEd').val();
    switch(val.substring(val.lastIndexOf('.') + 1).toLowerCase()){
        case 'gif': case 'jpg': case 'png':           
            if (e.target.files.length) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    if (e.target.result) {
                        let img = document.createElement('img');
                        img.id = 'image';
                        img.src = e.target.result
                        resultEd.innerHTML = '';
                        resultEd.appendChild(img);
                        $('#myModal').modal('show');
                        cropperEd = new Cropper(img, {
                            aspectRatio: 1 / 1
                        });
                    }
                }
                reader.readAsDataURL(e.target.files[0]);
            }
            break;
        default:
            $(this).val('');
            alert("Masukan Gambar");
            break;
    }
});

$(() => {

    var x = 1;
    $('#addRecipeForm').click(() => {
        var template = "";
        $.ajax({
            url: getingunit,
            dataType: "JSON",
            type: "GET",
            data: {},
            success:(data) => {
                console.log(data[0]);
                template += '<div class="form-row '+x+'">'
                    +'<div class="form-group col-md-7">'
                    +'<select class="form-control" name="id_ingredients[]">'
                    +'<option selected disabled>-Pilih bahan-</option>';

                for (var i = 0; i < data.length; i++) {
                    template += '<option value="'+data[i].id+'">'+data[i].name_ingredients+'</option>'
                }

                template += '</select></div>'
                    +'<div class="form-group col-md-3">'
                    +'<input type="text" class="form-control" name="amount[]" placeholder="Banyaknya">'
                    +'</div>'
                    +'<div class="form-group col-md-2">'
                    +'<button type="button" class="btn btn-default btn-sm btn-block" onclick="cancelRecipeForm('+x+')">Batalkan</button>'
                    +'</div>'
                    +'</div>';

                $('#appendRecipeForm').append(template); 
            }
        });
        x++;
    });

    $('#addIng').click(() => {
        var template = "";
        $.ajax({
            url: getingunit,
            dataType: "JSON",
            type: "GET",
            data: {},
            success:(data) => {
                $('#addIng').attr('style', 'display:none');
                template += '<tr class="addIngForm"><td>'
                    +'<select id="id_ingredients" class="form-control form-control-sm">'
                    +'<option selected disabled>-Pilih bahan-</option>';

                for (var i = 0; i < data.length; i++) {
                    template += '<option value="'+data[i].id+'/'+data[i].name_ingredients+'">'+data[i].name_ingredients+'</option>'
                }

                template += '</select>'
                    +'</td><td>'
                    +'<input type="text" id="amount" class="form-control form-control-sm" placeholder="Banyaknya">'
                    +'</td>'
                    +'<td>'
                    +'<div class="pull-right">'
                    +'<button type="button" onclick="saveIng()" class="btn btn-secondary btn-xs">Simpan</button> '
                    +'<button type="button" onclick="cancelIng()" class="btn btn-outline-secondary btn-xs">Batal</button>'
                    +'</div>'  
                    +'</td>'
                    +'</tr>';

                $('#appendIng').append(template); 
            }
        });
    });

    $('#ok-crop').click((e) => {
        e.preventDefault();
        let imgSrc = cropper.getCroppedCanvas({
            width: "150",
            height: "150"
        }).toDataURL();
        $('img.cropped').removeAttr('style');
        $('.img-result').removeAttr('style');
        $('img#layout-img').remove();
        $('#myModal').modal('hide');
        $('img.cropped').attr('src',imgSrc);
        $('input#data-img').attr('value',imgSrc);
    });

    $('#ok-cropEd').click((e) => {
        e.preventDefault();
        let imgSrc = cropperEd.getCroppedCanvas({
            width: "150",
            height: "150"
        }).toDataURL();
        $('img.cropped').removeAttr('style');
        $('.img-result').removeAttr('style');
        $('img#layout-img').remove();
        $('#myModal').modal('hide');
         $('img.cropped').attr('src',imgSrc);
        $('input#data-img').attr('value',imgSrc);
        var dataImg = $('input#data-img').val();
        var id_recipe = $('#id_recipe').val();
        $.ajax({
            url: upimages,
            type: "POST",
            data: {"_token": token,images:dataImg, id:id_recipe},
        });
    });

    $('#filterCat').change(() => {
        var val = $('#filterCat').val();
        $('.backCol').attr('style','display:none');
        if (val == 'all') {
            $('.backCol').removeAttr('style','display:none');
        } else {
            $('.column'+val).removeAttr('style')
        }
    });

    $('#word').keyup(() => {
        var word = $('#word').val().toLowerCase();
        $("#permanent-table tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(word) > -1)
        });
    });

});