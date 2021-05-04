//mobile header toggle
jQuery(document).ready(function() {
    const mobileHeader = jQuery('.mobile-header-wrap');
    jQuery('.header-hambureger-menu').on('click', () => {
        mobileHeader.show();
    })
    jQuery('.mobile-header-close').on('click', () => {
        mobileHeader.hide();
    })
    window.onclick = function(e) {
        if (e.target == document.getElementsByClassName('mobile-header-wrap')[0]) {
            mobileHeader.hide();
        }
    }
});

//homepage hero slider
jQuery(document).on('click', '.edgtf-quantity-minus, .edgtf-quantity-plus', function (e) {
    e.stopPropagation();
    var button = jQuery(this),
        inputField = button.siblings('.edgtf-quantity-input'),
        step = parseFloat(inputField.data('step')),
        max = parseFloat(inputField.data('max')),
        minus = false,
        inputValue = parseFloat(inputField.val()),
        newInputValue;
    if (button.hasClass('edgtf-quantity-minus')) {
        minus = true;
    }
    if (minus) {
        newInputValue = inputValue - step;
        if (newInputValue >= 1) {
            inputField.val(newInputValue);
        } else {
            inputField.val(0);
        }
    } else {
        newInputValue = inputValue + step;
        if (max === undefined) {
            inputField.val(newInputValue);
        } else {
            if (newInputValue >= max) {
                inputField.val(max);
            } else {
                inputField.val(newInputValue);
            }
        }
    }
    inputField.trigger('change');
});

jQuery( document ).on( 'change', '.widget_shopping_cart_content .edgtf-quantity-buttons input', function() {
    jQuery('.header-cart-loader').addClass('header-cart-loader-active');
    let val = jQuery(this).val();
    let id =jQuery(this).attr('id');
    val = val.replace(/[^\d.-]/g, '');
    if(val == '' || val == 'NaN') {
        val = 1;
    }
    val =  Math.floor(parseInt(val));
    if(val < 1){
        val = 1;
    }
    if(jQuery(this).data('max') < val) {
        val = jQuery(this).data('max');
    }
    jQuery(this).val(val);
    let ajaxurl = ajax_object.ajax_url;
    jQuery.ajax({
        type : "post",
        dataType : "json",
        url : ajaxurl,
        data : {action: 'update_item_from_cart', val: val, id: id },
        success: function(response) {
            jQuery('.woocommerce-mini-cart__total span bdi').html('€' +  parseFloat(response.total).toFixed(2)) ;
            if (response.total > 35) {
                jQuery('.woocommerce-mini-cart__shipping').show();
                jQuery('.woocommerce-mini-cart__shipping span').html(response.shipping) ;
            } else {
                jQuery('.woocommerce-mini-cart__shipping').hide();
            }
            jQuery('#cart-number').html('( ' + response.cartCount + ' )');
            let untilFreeShipping =  parseFloat(response.untilShipping).toFixed(2);
            if(untilFreeShipping <= 0 ) {
                jQuery('.to-free-shipping-cart').hide();
            }
            else {
                jQuery('.to-free-shipping-cart').show();
                jQuery('.to-free-shipping-price-mini-cart').html('€' + untilFreeShipping) ;
            }
            jQuery('.header-cart-loader').removeClass('header-cart-loader-active');
        },
        error: function (error) {
            console.log(error)
            jQuery.when(  jQuery( document.body ).trigger( 'wc_fragment_refresh' ) ).done(function( ) {
                jQuery('.header-cart-loader').removeClass('header-cart-loader-active');
            });
        }
    });
});


function updateQty(){
    jQuery("[name='update_cart']").removeAttr('disabled');
    jQuery("[name='update_cart']").trigger("click");
}