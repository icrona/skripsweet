    <!-- jQuery -->

    <!-- Bootstrap Core JavaScript -->

    <!-- Plugin JavaScript -->

    <!-- Theme JavaScript -->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
            {{ Html::script('js/new-age.min.js') }}
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.26/vue.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.0.3/vue-resource.min.js"></script>
    <script type="text/javascript" src="/js/faq.js"></script>
    <script type="text/javascript" src="/js/orders.js"></script>
    <script type="text/javascript" src="/js/inbox.js"></script>
    <script type="text/javascript" src="/js/details.js"></script>
    <script type="text/javascript" src="/js/profile.js"></script>
    <script type="text/javascript" src="/js/password.js"></script>
    <script type="text/javascript" src="/js/report.js"></script>

    <script type="text/javascript" src="/js/flavour.js"></script>
    <script type="text/javascript" src="/js/size.js"></script>
    <script type="text/javascript" src="/js/shape.js"></script>
    <script type="text/javascript" src="/js/frosting.js"></script>

    <script type="text/javascript" src="/js/cake-birthday.js"></script>
    <script type="text/javascript" src="/js/cake-anniversary.js"></script>
    <script type="text/javascript" src="/js/cake-seasonal.js"></script>

    <script type="text/javascript" src="/js/sweetalert.min.js"></script>
    <script type="text/javascript" src="/js/parsley.min.js"></script>

    
    <script>
  @if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}";
    switch(type){
        case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;
        
        case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;

        case 'success':
            toastr.success("{{ Session::get('message') }}",'Success Alert');
            break;

        case 'error':
            toastr.error("{{ Session::get('message') }}",'Error Alert');
            break;
    }
  @endif
  function resetFileForm(){
    document.getElementById("resetFile").value = "";
  }
</script>