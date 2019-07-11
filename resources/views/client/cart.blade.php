@extends('client.layouts.main')
@section('content')
<div class="colorlib-shop">
	<div class="container">
		<div class="row row-pb-md">
			<div class="col-md-10 col-md-offset-1">
				<div class="process-wrap">
					<div class="process text-center active">
						<p><span>01</span></p>
						<h3>Giỏ hàng</h3>
					</div>
					<div class="process text-center">
						<p><span>02</span></p>
						<h3>Thanh toán</h3>
					</div>
					<div class="process text-center">
						<p><span>03</span></p>
						<h3>Hoàn tất thanh toán</h3>
					</div>
				</div>
			</div>
		</div>
		<div class="row row-pb-md">
			<div class="col-md-10 col-md-offset-1">
				<div class="product-name">
					<div class="one-forth text-center">
						<span>Chi tiết sản phẩm</span>
					</div>
					<div class="one-eight text-center">
						<span>Giá</span>
					</div>
					<div class="one-eight text-center">
						<span>Số lượng</span>
					</div>
					<div class="one-eight text-center">
						<span>Tổng</span>
					</div>
					<div class="one-eight text-center">
						<span>Xóa</span>
					</div>
				</div>
				@forelse (Cart::getContent() as $cart)
					<div class="product-cart">
						<div class="one-forth">
							<div class="product-img">
								<img class="img-thumbnail cart-img" src="images/ao-so-mi-hoa-tiet-den-asm1223-10191.jpg">
							</div>
							<div class="detail-buy">
								<h4>Mã : SP01</h4>
								<h5>{{ $cart->name }}</h5>
							</div>
						</div>
						<div class="one-eight text-center">
							<div class="display-tc">
								<span class="price">{{ number_format($cart->price) }} đ</span>
							</div>
						</div>
						<div class="one-eight text-center">
							<div class="display-tc">
								<input data-id="{{ $cart->id }}" data-price="{{ $cart->price }}" min="0" type="number" id="quantity" name="quantity" class="form-control input-number text-center input-quantity" value="{{ $cart->quantity }}">
							</div>
						</div>
						<div class="one-eight text-center">
							<div class="display-tc">
								<span class="price display-price">{{ number_format($cart->quantity*$cart->price) }} đ</span>
							</div>
						</div>
						<div class="one-eight text-center">
							<div class="display-tc">
								<a href="#" class="closed cart-delete" data-id="{{ $cart->id }}"></a>
							</div>
						</div>
					</div>
				@empty
					
				@endforelse
				
				{{-- <div class="product-cart">
					<div class="one-forth">
						<div class="product-img">
							<img class="img-thumbnail cart-img" src="images/ao-so-mi-trang-kem-asm836-8193.jpg">
						</div>
						<div class="detail-buy">
							<h4>Mã : SP01</h4>
							<h5>Áo Khoác Nam Đẹp</h5>
						</div>
					</div>
					<div class="one-eight text-center">
						<div class="display-tc">
							<span class="price">680.000 đ</span>
						</div>
					</div>
					<div class="one-eight text-center">
						<div class="display-tc">
							<input type="number" id="quantity" name="quantity"
								class="form-control input-number text-center" value="1">
						</div>
					</div>
					<div class="one-eight text-center">
						<div class="display-tc">
							<span class="price">1.200.000 đ</span>
						</div>
					</div>
					<div class="one-eight text-center">
						<div class="display-tc">
							<a href="#" class="closed"></a>
						</div>
					</div>
				</div> --}}


			</div>
		</div>
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="total-wrap">
					<div class="row">
						<div class="col-md-8">

						</div>
						<div class="col-md-3 col-md-push-1 text-center">
							<div class="total">
								<div class="sub">
									<p><span>Tổng:</span> <span>4.000.000 đ</span></p>
								</div>
								<div class="grand-total">
									<p><span><strong>Tổng cộng:</strong></span> <span>3.550.000 đ</span></p>
									<a href="checkout.html" class="btn btn-primary">Thanh toán <i
											class="icon-arrow-right-circle"></i></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@push('js')
<script>
/**
* Number.prototype.format(n, x)
*
* @param integer n: length of decimal
* @param integer x: length of sections
*/
Number.prototype.format = function(n, x) {
	var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
	return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
};
$(document).ready(function() {
	$('.input-quantity').change(function(e) {
		e.preventDefault();
		let quantity = $(this).val();
		quantity = quantity?quantity:0;
		quantity = quantity<0?0:quantity;
		$(this).val(quantity);
		
		let price = $(this).attr('data-price');
		let id = $(this).attr('data-id');
		console.log(quantity*price);
		
		$(this).parents('.product-cart').find('.display-price').text((quantity * price).format() + ' đ');

		$.ajax({
			url: '/gio-hang/update',
			method: "POST",
			data: {
				_token: "{{ csrf_token() }}",
				quantity: quantity,
				id: id
			},
			success: function(data) {
				$('.cart-quantity').text(data.quantity);
			}
		});
		
	});

	$('.cart-delete').click(function(e) {
		e.preventDefault();
		let id = $(this).attr('data-id');
		let _this = $(this);
		$.ajax({
			url: '/gio-hang/remove',
			data: {
				id: id,
				_token: "{{csrf_token()}}"
			},
			method: "POST",
			success: function(data) {
				$('.cart-quantity').text(data.quantity);
				_this.parents('.product-cart').remove();
			}
		});
	});
});
</script>
@endpush