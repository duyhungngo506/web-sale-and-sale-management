<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <table class="table table-light">
        <table class="table table-light">
            <thead class="thead-light">
                <h3>Đơn hàng được giao đến</h3>
            </thead>
            <tbody>
                <tr>
                    <td>Tên:</td>
                    <td>{{ $sentDataOrder['name'] }}</td>
                </tr>
                <tr>
                    <td>Địa chỉ nhà:</td>
                    <td>{{ $sentDataOrder['address'] }}</td>
                </tr>
                <tr>
                    <td>Điện thoại:</td>
                    <td>{{ $sentDataOrder['phone'] }}</td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td>{{ $sentDataOrder['email'] }}</td>
                </tr>
                <tr>
                    <td>Ghi chú:</td>
                    <td>{{ $sentDataOrder['note'] }}</td>
                </tr>
            </tbody>
        </table>
        <tbody>
            <tr>
                <td></td>
            </tr>
        </tbody>
    </table>
    <hr>

    <table class="table table-light">
        <thead class="thead-light">
            <h3>Chi tiết đơn hàng</h3>
        </thead>
        <tbody>
            <tr>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
            </tr>
            @foreach ($sentDataOrder['billdetail'] as $product)
                <tr>
                    <td>{{ $product['item']['name'] }}</td>
                    <td>{{ $product['qty'] }}</td>
                    <td>
                        @if ($product['item']['promotion_price'] == 0)
                            {{ number_format($product['item']['unit_price']) }}
                        @else
                            {{ number_format($product['item']['promotion_price']) }}
                        @endif
                        đ
                    </td>

                </tr>
            @endforeach

        </tbody>
        <tfoot>
            <tr>
                <td><b>Phí vận chuyển</b></td>
                <td></td>
                <td><b>{{ number_format(25000) }}đ</b></td>
            </tr>
            @if ($sentDataOrder['voucher'] > 0)
                <tr>
                    <td><b>Giảm giá</b></td>
                    <td></td>
                    <td><b>-{{ number_format($sentDataOrder['voucher']) }}đ</b></td>
                </tr>
            @endif
            <tr>
                <td><b>Tổng thanh toán</b></td>
                <td></td>
                <td><b>{{ number_format($sentDataOrder['total']) }}đ</b></td>
            </tr>
        </tfoot>
    </table>
    <hr>
    <p style="text-align: center">Cám ơn quý khách đã đặt hàng tại HungBakery!</p>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>
