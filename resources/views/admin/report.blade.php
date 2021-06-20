@extends('admin.layout')
@section('content')
<div class="az-content az-content-dashboard">
    <div class="container">
      <div class="az-content-body">
        {{-- {{ Auth::user()->name }} --}}
        <h4>Sales Report</h4>
            <center><h3 class="text-primary">Orders Report</h3></center>
            <hr style="height:2px;border-width:0;color:#3366ff;background-color:#3366ff;width:50%">
            <h5>Number of Orders:</h5>
            <h5>Price of orders received:</h5>
 
            <center><h3 style="color: #ff4207">Customers Report</h3></center>
            <hr style="height:2px;border-width:0;color:#ff4207;background-color:#ff4207;width:50%">
            <h5>Number of customer sign up:</h5>
            <h5>Number of customers making purchase:</h5>
            <h5>Repetition of orders:</h5>

            <table>
                <tr>
                    <td>No.of signup</td>
                    <td>No. of customers making purchase</td>
                    <td>Repetition of orders</td>
                    {{-- <td></td>   --}}

                </tr>
            </table>

      </div>
    </div>
</div>
@endsection