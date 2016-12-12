Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr("value");

new Vue({
  el :'#manage_frosting',
  data :{
    frostings: [],
    offset: 4,
    formErrors:{},
    formErrorsUpdate:{},
    fillItem : {'one':'','two':'','three':'','four':'','availability':'','id':''}
  },
  ready: function() {
    this.getVueItems();
  },

  methods: {
    getVueItems: function() {
      this.$http.get('/api/manage/frosting').then((response) => {
        this.$set('frostings', response.data.data);
        this.frostings[2].two='',
        this.frostings[2].three='',
        this.frostings[2].four=''
      });
    },
    editItem: function(frosting) {
      this.fillItem.one = frosting.one;
      this.fillItem.id = frosting.id;
      this.fillItem.availability = frosting.availability;
      if(frosting.id == 3){
        this.fillItem.two = 0;
        this.fillItem.three = 0;
        this.fillItem.four = 0;
        $("#edit-frosting-ganache").modal('show');
      }
      else{
        this.fillItem.two = frosting.two;
        this.fillItem.three = frosting.three;
        this.fillItem.four =frosting.four;
        $("#edit-frosting").modal('show');
      }
      
    },
    clickCheckBox:function(item) {
      if(item.availability == 0){
        item.availability=1;
      }
      else{
        item.availability=0;
      }
      this.fillItem.one = item.one;
      this.fillItem.id = item.id;
      this.fillItem.availability = item.availability;
      if(item.id == 3){
        this.fillItem.two = 0;
        this.fillItem.three = 0;
        this.fillItem.four = 0;
      }
      else{
        this.fillItem.two = item.two;
        this.fillItem.three = item.three;
        this.fillItem.four =item.four;
      }
      this.updateItem(item.id);

    },
    updateItem:function(id){
      var input = this.fillItem;
      this.$http.put('/api/manage/frosting'+id,input).then((response) => {
        this.getVueItems();
        if(id==3){
          $("#edit-frosting-ganache").modal('hide');
        }
        else{
          $("#edit-frosting").modal('hide')
        }
        toastr.success('Frosting Updated Successfully.', 'Success Alert', {timeOut: 3000});

      }, (response) => {
        this.formErrors = response.data;
      });
    }
  }
});