Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr("value");

new Vue({
  el :'#pipe-top',
  data :{
    pipes: [],
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
      this.$http.get('/api/manage/pipetop').then((response) => {
        this.$set('pipes', response.data.data);
      });
    },
    editItem: function(pipes) {
      this.fillItem.id = pipes.id;
      this.fillItem.price=pipes.price;
      this.fillItem.availability = pipes.availability;
      $("#edit").modal('show');  
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
      this.$http.put('/api/manage/pipetop'+id,input).then((response) => {
        this.getVueItems();
        $("#edit").modal('hide')
        toastr.success('Pipe Top Updated Successfully.', 'Success Alert', {timeOut: 3000});
      }, (response) => {
        this.formErrors = response.data;
      });
    }
  }
});