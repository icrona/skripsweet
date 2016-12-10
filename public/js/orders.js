Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr("value");

new Vue({
  el :'#vieworder',
  data :{
    orders: [],
    sortBy:'date',
    pagination: {
      total: 0,
      per_page: 2,
      from: 1,
      to: 0,
      current_page: 1
    },
    offset: 4,
    formErrors:{},
    formErrorsUpdate:{},
    fillItem : {'id':'','name':'','phone':'','email':'','address':'','notes':'','cake_name':'','cake_description':'','cake_size':'','cake_price':'','cake_image':'','status':''}
  },
    
  computed: {
    isActived: function() {
      return this.pagination.current_page;
    },
    pagesNumber: function() {
      if (!this.pagination.to) {
        return [];
      }
      var from = this.pagination.current_page - this.offset;
      if (from < 1) {
        from = 1;
      }
      var to = from + (this.offset * 2);
      if (to >= this.pagination.last_page) {
        to = this.pagination.last_page;
      }
      var pagesArray = [];
      while (from <= to) {
        pagesArray.push(from);
        from++;
      }
      return pagesArray;
    },
  },
  ready: function() {
    this.getVueItems(this.pagination.current_page);
  },
  methods: {
    getVueItems: function(page) {
      this.$http.get('/api/orders?page='+page).then((response) => {
        this.$set('orders', response.data.data.data);
        this.$set('pagination', response.data.pagination);
      });
    },
    checkStatus: function(status){
      if(status=="Waiting Confirmation"){
        return true;
      }
    },
    updateStatus: function(status,orders) {
      this.fillItem.id = orders.id;
      this.fillItem.name = orders.name;
      this.fillItem.phone = orders.phone;
      this.fillItem.email = orders.email;
      this.fillItem.address = orders.address;
      this.fillItem.cake_name = orders.cake_name;
      this.fillItem.cake_description = orders.cake_description;
      this.fillItem.cake_category = orders.cake_cateogry;
      this.fillItem.cake_size = orders.cake_size;
      this.fillItem.cake_price = orders.cake_price;
      this.fillItem.cake_image = orders.cake_image;
      this.fillItem.status=status;
      var input = this.fillItem;
      var ini=this;
      var action;
      if(status=="Accepted"){
        action="Accept"
      }
      else{
        action="Decline"
      }
      swal({
              title: "Are You Sure?",
              text: "You Will "+action+ " This Order",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Yes, "+action+" It!",
              closeOnConfirm: false
            },
            function(isConfirm){
              if(isConfirm){
                ini.$http.put('/api/orders'+input.id,input).then((response) => {
                  ini.changePage(ini.pagination.current_page);
                }, (response) => {
                  ini.formErrors = response.data;
                });
                swal(status, "Your order has been "+status, "success");
              }             
      });  
    },
    changePage: function(page) {
      this.pagination.current_page = page;
      if(this.sortBy=='date'){
        this.getVueItems(page);
      }
      else{
        this.sort(page);
      }     
    },
    sort: function(page) {
      if(this.sortBy=="date"){
        this.getVueItems(page);
      }
      else{
      this.$http.get('/api/orders/'+this.sortBy+'?page='+page).then((response) => {
        this.$set('orders', response.data.data.data);
        this.$set('pagination', response.data.pagination);
      });
      }
    },
  }
});