/**
 * Created by AdminRus on 05.04.2017.
 */
$('.catalog').dcAccordion({
    speed:350
});

function showWindowMessage(res){
    $('#modal_window_message .modal-body').html(res);
    $('#modal_window_message').modal();
}

function showCart(res){
    $('#modal_window_cart .modal-body').html(res);
    $('#modal_window_cart').modal();
}


$('.add-to-cart').on('click',function(e){
    e.preventDefault();
    var id_add=$(this).data('id_add')
        qty=$('#qty').val();
    $.ajax({
        url: '/cart/add',
        data:{id_add:id_add,qty:qty},
        type:'GET',
        success:function(res){
            if(res==false){
                showWindowMessage('Error adding product with Web ID:'+id_add+' to your cart. Product not found in database website. Please refresh page!');
                return false;
            }
            showCart(res);
        },
        error:function(){
            showWindowMessage('Error connecting');
        }
    });
    return false;
})



//delete item
function showDataInCart(res){
    $('#body_content').html(res);
}

/**
 * Де .mrDeleteProduct це унікальний ключ по якому буде очищатися подія якщо даний скрипт попаде в ajax
 */
$(document).off('click.mrDeleteProduct')
    .on('click.mrDeleteProduct','.cart_quantity_delete',function(e){
    e.preventDefault();
    var id_del=$(this).data('item');
    $.ajax({
        url: '/cart/del_item',
        data:{id_del:id_del},
        type:'GET',
        success:function(res){
            if(res==false){
                showWindowMessage('Error deleting product with cart. Product with Web ID:'+id_del+' not found. Please refresh page!');
                return false;
            }
            showWindowMessage('Product with Web ID:'+id_del+' by deleted with your cart!');
            showDataInCart(res);
        },
        error:function(){
            showWindowMessage('Error connecting while deleting product with your cart.');
        }
    });
    return false;
})



$(document).off('click.mrDownProduct')
    .on('click.mrDownProduct','.cart_quantity_down',function(e){
    //e.preventDefault();
    var id_product=$(this).data('item');
    $.ajax({
        url: '/cart/del_one_unit',
        data:{id_product:id_product},
        type:'GET',
        success:function(res){
            if(res==false){
                showWindowMessage('Error reduction in the number unit product with cart. Product with Web ID:'+id_product+' not found. Please refresh page');
                return false;
            }
            showDataInCart(res);
        },
        error:function(){
            showWindowMessage('Error connecting while reducing the number unit product.');
        }
    });
    return false;
})

$(document).off('click.mrUpProduct')
    .on('click.mrUpProduct','.cart_quantity_up',function(e){
    //e.preventDefault();
    var id_product=$(this).data('item');
    $.ajax({
        url: '/cart/add_one_unit',
        data:{id_product:id_product},
        type:'GET',
        success:function(res){
            if(res==false){
                showWindowMessage('Error magnification in the number unit product with cart. Product with Web ID:'+id_product+' not found. Please refresh page');
                return false;
            }
            showDataInCart(res);
        },
        error:function(){
            showWindowMessage('Error connecting while magnification the number unit product.');
        }
    });
    return false;
})
