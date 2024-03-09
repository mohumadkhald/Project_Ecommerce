<!DOCTYPE html>
<html lang="en">
  <head>
  @include('admin.css')

  <style>
.div_center{
            text-align: left !important;
            align-items: left !important;
            margin:auto;
        }
        .cat_label{
        text-align: center;
        font-size:25px;
        font-weight:bold;
    }
        .center{
          margin:auto;
          text-align: center;
          width: 90%;
          margin-top:50px;
          border:1px solid white;
        }
        th{
          background-color: #00000; 
          padding: 10px;
        }
        tr{
          border:1px solid white;
          padding: auto;
        }
        .input_c{
            color:black;
            background-color: #000;
        }
        hr {
        border-color: white;
    }
  </style>
  </head>
  <body>
    <div class="container-scroller">
      @include('admin.sidebar')
      @include('admin.nav')


      <div class="main-panel bg-secondary">
          <div class="content-wrapper">

          <h1 class="cat_label">Orders</h1>
                <hr style="border-color: white;         margin: 5px;">
            
                <table class="center">
    <tr>
        <th>Customer name</th>
        <th>Email</th>
        <th>Address</th>
        <th>Phone</th>
        <th>Product Title</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Delivery status</th>
        <th>Image</th>
    </tr>

    @foreach($orders as $order)
    <tr>
   
            <td>{{ $order->user->name }}</td>
            <td>{{ optional($order->user)->email }}</td>
            <td>{{ optional($order->user)->address }}</td>
            <td>{{ optional($order->user)->phone_number }}</td>
            <td>{{ optional($order->product)->title }}</td>
            <td>{{ $order->quantity }}</td>
            <td>{{ $order->quantity * $order->product->price }}</td>
            <!-- ask omar -->
            <td>{{ $order->purchase->state }}</td> 
            <td>
                <img src="{{ asset('storage/' . optional($order->product)->image) }}" alt="Product Image" style="max-width: 100px; max-height: 100px;">
            </td>
        </tr>
    @endforeach
</table>

        
        </div>
          </div>

    @include('admin.scripts')

  </body>
</html>