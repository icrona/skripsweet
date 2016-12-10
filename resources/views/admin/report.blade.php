@extends('admin')

@section('title', '| Report')

@section('stylesheets')
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
    <style>
                section{
            background-color:#bfd8d2;
        }
        h2,h4{
            color:white;
        }
        .form-group {
                    width: 150px;
                    }
    </style>
@endsection

@section('content')

        <section id="viewreport" class="text-center" >
        <div class="container"><center>
                <h2>Report</h2><br>
                <style>
                    table {
                        border-collapse: collapse;
                        width: 80%;
                    }

                    th, td {
                    border: 1px solid #dddddd;
                    text-align: left;
                    padding: 8px;
                    }
                    
                    tr:nth-child(even){
                        background-color:#dddddd;
                    }
                    tr:nth-child(odd){
                        background-color:rgba(255, 255, 255,1);
                    }

                    th {
                    background-color: #4CAF50;
                    color: white;
                    }
                            a{
                        color:#df744a;
                    }
                </style>
                    <form method="POST" action="{{ route('pdfreport',['download'=>'pdf']) }}">
                    Period: 
                        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                      <input type="date" v-model="period.from" name="from" @change="getVueItems(1)" required="" min=@{{first}} /> 
                      - 
                      <input type="date" v-model="period.to" name="to" @change="getVueItems(1)" required="" max=@{{last}} />

                      <button class="btn btn-link" role="submit">
                          <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span>
                      </button>            
                    </form>

                      <br>

                      <h5>Total Price : Rp. @{{total}}</h5>
                    <br><br>
                
                
                <table id="ordertable" class="display">
                    <tr>
                        <th>Delivery Date</th>
                        <th>Customer Name</th>
                        <th>Cake Name</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>

                    <tr v-for="order in orders">
                        <td>@{{order.date}}</td>
                        <td>@{{order.name}}</td> 
                        <td>@{{order.cake_name}}</td>
                        <td>Rp. @{{order.cake_price}}</td>
                        <td><a href={{url('/orders/')}}@{{order.id}}>Details</a></td>                     
                    </tr>
                </table>
                <center>
            </div>

                        <nav class="text-center">
                    <ul class="pagination">
                      <li v-if="pagination.current_page > 1">
                        <a href="#" aria-label="Previous" @click.prevent="changePage(pagination.current_page - 1)">
                          <span aria-hidden="true">«</span>
                        </a>
                      </li>
                      <li v-for="page in pagesNumber" v-bind:class="[ page == isActived ? 'active' : '']">
                        <a href="#" @click.prevent="changePage(page)">
                          @{{ page }}
                        </a>
                      </li>
                      <li v-if="pagination.current_page < pagination.last_page">
                        <a href="#" aria-label="Next" @click.prevent="changePage(pagination.current_page + 1)">
                          <span aria-hidden="true">»</span>
                        </a>
                      </li>
                    </ul>
                  </nav>   
            
    </section>
@endsection
