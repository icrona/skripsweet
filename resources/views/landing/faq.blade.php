@extends('main')

@section('title', '| Frequently Asked Questions')

@section('stylesheets')
    <!--FAQ CSS-->
    <link rel="stylesheet" type="text/css" href="faq/font-awesome/css/font-awesome.min.css" />
    <script type="text/javascript" src="faq/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="faq/bootstrap/js/bootstrap.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <style>       
        .faqHeader {
            font-size: 27px;
            margin: 20px;
        }

        .panel-heading [data-toggle="collapse"]:after {
            font-family: 'Glyphicons Halflings';
            content: "\e072"; /* "play" icon */
            float: right;
            color: #F58723;
            font-size: 18px;
            line-height: 22px;
            /* rotate "play" icon from > (right arrow) to down arrow */
            -webkit-transform: rotate(-90deg);
            -moz-transform: rotate(-90deg);
            -ms-transform: rotate(-90deg);
            -o-transform: rotate(-90deg);
            transform: rotate(-90deg);
        }

        .panel-heading [data-toggle="collapse"].collapsed:after {
            /* rotate "play" icon from > (right arrow) to ^ (up arrow) */
            -webkit-transform: rotate(90deg);
            -moz-transform: rotate(90deg);
            -ms-transform: rotate(90deg);
            -o-transform: rotate(90deg);
            transform: rotate(90deg);
            color: #454444;
        }
    </style>    
@endsection

@section('content')
		<section class="container-fluid features" id="user-faq">
		<div class="container">			
			<div class="panel-group" id="accordion">
				<div class="faqHeader">Frequent Asked Questions</div>

				<input type="text" id="sigInput" name="search" @keyup="searchFAQ()" v-model="search" class="form-control" placeholder="Search for FAQ Question..."><br>

				<div v-for="faq in faqs">
					<div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse@{{ faq.id }}">@{{ faq.question }}</a>
                        </h4>
                    </div>
                    <div id="collapse@{{ faq.id }}" class="panel-collapse collapse">
                        <div class="panel-body">
                            @{{ faq.answer }}
                        </div>
                    </div>
                </div>
				</div>
                
			</div>
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
