Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr("value");

new Vue({
  el :'#sprinkles',
  data :{
    sprinkles: [],
    offset: 4,
    formErrors:{},
    formErrorsUpdate:{},
    fillItem : {'price':'','availability':'','id':''}
  },
  ready: function() {
    this.getVueItems();
  },

  methods: {
    getVueItems: function() {
      this.$http.get('/api/manage/sprinkle').then((response) => {
        this.$set('sprinkles', response.data.data);
      });
    },
    editItem: function(sprinkles) {
      this.fillItem.id = sprinkles.id;
      this.fillItem.price=sprinkles.price;
      this.fillItem.availability = sprinkles.availability;
      $("#edit2").modal('show');  
    },
    clickCheckBox:function(item) {
      if(item.availability == 0){
        item.availability=1;
      }
      else{
        item.availability=0;
      }
      this.fillItem.id = item.id;
      this.fillItem.price=item.price;
      this.fillItem.availability = item.availability;
      this.updateItem(item.id);

    },
    updateItem:function(id){
      var input = this.fillItem;
      console.log(input);
      this.$http.put('/api/manage/sprinkle'+id,input).then((response) => {
        this.getVueItems();
        $("#edit2").modal('hide')
        toastr.success('Sprinkle Updated Successfully.', 'Success Alert', {timeOut: 3000});
      }, (response) => {
        this.formErrors = response.data;
      });
    }
  }
});