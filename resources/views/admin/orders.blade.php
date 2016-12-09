@extends('admin')

@section('title', '| Orders')

@section('stylesheets')
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
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
                    section{
            background-color:#bfd8d2;
        }
        h2,h4{
            color:white;
        }
        .form-group {
                    width: 150px;
                    }
                    
        a{
                        color:#df744a;
                    }
    </style>
@endsection

@section('content')

        <section id="vieworder" class="text-center" >

            <div class="container"><center>
                <h2>Orders</h2><br>
                <form>
                    <div class="form-group">
                      <label for="sel1" align="center">Sort By :</label>
                      <select class="form-control" id="sel1" v-model="sortBy" @change="sort(sortBy)">
                        <option value="date">Date Received</option>
                        <option value="status">Status</option>
                        <option value="deadline">Deadline</option>
                      </select>
                      
                    </div>
                  </form>
                
                
                <table id="orders" class="display">
                    <tr>
                        <th>Cake Name</th>
                        <th>Date Received</th>
                        <th>Deadline</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    <tr v-for="order in orders">
                        <td>@{{order.cake_name}}</td>
                        <td>@{{order.created_at}}</td>
                        <td>@{{order.date}}</td>
                        <td>@{{order.status}}</td>
                        <td>
                                <a href={{url('/orders/')}}@{{order.id}}>Details</a>
                                <span v-if="checkStatus(order.status)">
                                    <a @click.prevent=updateStatus("Accepted",order) href="#">Accept</a>
                                    <a @click.prevent=updateStatus("Declined",order) href="#">Decline</a>
                                </span>
                        </td>       
                    </tr>
                </table>
                <center>

            </div>

            <br>
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
