Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr("value");

new Vue({
  el :'#details',
  props:['details'],
  data :{
    orders: [],
    fillItem : {'id':'','name':'','phone':'','email':'','date':'','address':'','notes':'','cake_name':'','cake_description':'','cake_size':'','cake_price':'','cake_image':'','status':''},
    id:[]
  },
  ready: function() {
    this.id=JSON.parse(this.details);
    this.getVueItems(this.id);
  },
  methods: {
    getVueItems: function(id) {
      this.$http.get('/api/details'+id).then((response) => {
        this.$set('orders', response.data.data);
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
      this.fillItem.date = orders.date;
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
                  ini.getVueItems(input.id);
                }, (response) => {
                  ini.formErrors = response.data;
                });
                swal(status, "Your order has been "+status, "success");
                
              }             
      });  
    },
  }
});