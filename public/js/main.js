/* Filters */
$('body').on('change', '.sidebar-widget input', function() {
    var checked = $('.sidebar-widget input:checked'),
        data = '';

    checked.each(function() {
        data += this.value + ',';
    });
    data = data.substr(0, data.lastIndexOf(','));

    if (data) {
        $.ajax({
            url: location.href,
            data: { filter: data },
            type: 'GET',
            beforeSend: function() {
                $('#product').hide();
            },
            success: function(res) {
                $('#product').html(res).fadeIn();
                var url = location.search.replace(/filter(.+?)(&|$)/g, ''); //$2
                var newURL = location.pathname + url + (location.search ? "&" : "?") + "filter=" + data;
                newURL = newURL.replace('&&', '&');
                newURL = newURL.replace('?&', '?');
                history.pushState({}, '', newURL);
            },
            error: function() {
                alert('Error');
            }
        });
    } else {
        window.location = location.pathname;
    }

});
/* Filters-end */

/* Cart */
$('body').on('click', '.add-to-cart', function(e) {
    e.preventDefault();

    var id = $(this).data('id'),
        qty = $('.quantity input').val() ? $('.quantity input').val() : 1,
        modColor = $('.available input:checked').val(),
        modSize = $('.mod-size input:checked').val();

    if ($('.available input').length > 0) {
        if (typeof modColor === 'undefined') {
            $('#check-color').show();
            throw 'Select color';
        }
        $('#check-color').hide();
    }

    if ($('.mod-size input').length > 0) {
        if (typeof modSize === 'undefined') {
            $('#check-size').show();
            throw 'Select size';
        }
        $('#check-size').hide();
    }

    $.ajax({
        url: '/cart/add',
        data: { id: id, qty: qty, color: modColor, size: modSize },
        type: 'GET',
        success: function(res) {
            showCart(res);
        },
        error: function() {
            alert('Error');
        }
    });
});

$('body').on('click', '#buy', function(e) {
    e.preventDefault();
    var id = $(this).data('id'),
        qty = $('.quantity input').val() ? $('.quantity input').val() : 1,
        modColor = $('.available input:checked').val(),
        modSize = $('.mod-size input:checked').val();

    if ($('.available input').length > 0) {
        if (!modColor) {
            $('#check-color').show();
            throw 'Select color';
        }
    }

    if ($('.mod-size input').length > 0) {
        if (!modSize) {
            $('#check-size').show();
            throw 'Select size';
        }
    }

    modColor = modColor ? '&color=' + modColor : '';
    modSize = modSize ? '&size=' + modSize : '';

    window.location = '/cart/add?id=' + id + '&qty=' + qty + modColor + modSize;
});

$('#cart .modal-body').on('click', '.del-item', function() {
    var id = $(this).data('id');

    $.ajax({
        url: '/cart/delete',
        data: { id: id },
        type: 'GET',
        success: function(res) {
            showCart(res);
        },
        error: function() {
            alert('Error');
        }
    });
});

$('#cart .modal-body').on('click', '.qty-plus', function() {
    var id = $(this).data('id');

    $.ajax({
        url: '/cart/qtyPlus',
        data: { id: id },
        type: 'GET',
        success: function(res) {
            showCart(res);
        },
        error: function() {
            alert('Error');
        }
    });
});


$('#cart .modal-body').on('click', '.qty-minus', function() {
    var id = $(this).data('id');
    var qty = $('#cart .modal-body .qty-item').text();

    if (qty > 1) {
        $.ajax({
            url: '/cart/qtyMinus',
            data: { id: id },
            type: 'GET',
            success: function(res) {
                showCart(res);
            },
            error: function() {
                alert('Error');
            }
        });
    }
});

function showCart(cart) {
    if ($.trim(cart) == '<h5>Cart is empty</h5>') {
        $('#cart .modal-footer a, #cart .modal-footer .btn-danger').hide();
    } else {
        $('#cart .modal-footer a, #cart .modal-footer .btn-danger').show();
    }

    $('#cart .modal-body').html(cart);
    $('#cart').modal();

    if ($('.cart-qty').text()) {
        $('.cart_total').html($('#cart .cart-qty').text());
    } else {
        $('.cart_total').text('');
    }
}

function getCart() {
    $.ajax({
        url: '/cart/show',
        type: 'GET',
        success: function(res) {
            showCart(res);
        },
        error: function() {
            alert('Error');
        }
    });
}

function clearCart() {
    $.ajax({
        url: '/cart/clear',
        type: 'GET',
        success: function(res) {
            showCart(res);
        },
        error: function() {
            alert('Error');
        }
    });
}
/* Cart-end */

/* Currency */
$('#currency').change(function() {
    window.location = 'currency/change?val=' + $(this).val();
});
/* Currency-end */

/* Product */
$('.available input').on('change', function() {
    var modId = $(this).val(),
        color = $(this).data('title'),
        price = $(this).data('price'),
        oldprice = $(this).data('oldprice'),
        basePrice = $('#base-price').data('base'),
        baseOldPrice = $('#base-price').data('oldbase');

    var oldPrice = null,
        BaseOldPrice = null;

    if (oldprice) oldPrice = ' <small><s>' + oldprice + symbol + '</s></small>';
    if (baseOldPrice) BaseOldPrice = ' <small><s>' + baseOldPrice + symbol + '</s></small>';

    if (price) {
        $('#base-price').text(price + symbol).append(oldPrice);
    } else {
        $('#base-price').text(basePrice + symbol).append(BaseOldPrice);
    }
});
/* Product-end */

/* Delete */
$('.delete').on('click', function() {
    var res = confirm('Do you really want to delete this?');
    if (!res) return false;
});
/* Delete-end */

/* View */
$('#cart-view').on('click', '.qty-plus', function() {
    var id = $(this).data('id');
    var qty = $(this).next();
    var qtyCart = $('.cart_total');

    $.ajax({
        url: '/cart/qtyPlus',
        data: { id: id },
        type: 'GET',
        success: function(res) {
            showCartView(res);
        },
        error: function() {
            alert('Error');
        }
    });
});

$('#cart-view').on('click', '.qty-minus', function() {
    var id = $(this).data('id');
    var qty = $(this).prev();
    var qtyCart = $('.cart_total');

    if (qty.text() > 1) {
        $.ajax({
            url: '/cart/qtyMinus',
            data: { id: id },
            type: 'GET',
            success: function(res) {
                showCartView(res);
            },
            error: function() {
                alert('Error');
            }
        });
    }
});

$('#cart-view').on('click', '.del-item', function() {
    var id = $(this).data('id');

    $.ajax({
        url: '/cart/delete',
        data: { id: id },
        type: 'GET',
        success: function(res) {
            showCartView(res);
        },
        error: function() {
            alert('Error');
        }
    });
});

function showCartView(cart) {
    if ($.trim(cart) == '<h5>Cart is empty</h5>') {
        $('#cart .modal-footer a, #cart .modal-footer .btn-danger').hide();
    } else {
        $('#cart .modal-footer a, #cart .modal-footer .btn-danger').show();
    }

    $('#cart-view').html(cart);

    if ($('.cart-qty').text()) {
        $('.cart_total').html($('#cart-view .cart-qty').text());
    } else {
        $('.cart_total').text('');
    }
}
/* View-end */

/* Nav Items */
let item = 'main';

if (location.pathname == '/about-us') item = 'about-us';
if (location.pathname == '/contact-us') item = 'contact-us';

const navItem = $('#nav-items').find('#' + item);

navItem.addClass('active');
navItem.children().append('<span class="sr-only">(current)</span>');
/* Nav-Items-end */