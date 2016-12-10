Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr("value");

new Vue({
  el :'#manage_shape',
  data :{
    shapes: [],
    offset: 4,
    formErrors:{},
    formErrorsUpdate:{},
    fillItem : {'name':'','availability':'','id':''}
  },
  ready: function() {
    this.getVueItems();
  },

  methods: {
    getVueItems: function() {
      this.$http.get('/api/manage/shape').then((response) => {
        this.$set('shapes', response.data.data);
      });
    },
    clickCheckBox:function(item) {
      if(item.availability == 0){
        item.availability=1;
      }
      else{
        item.availability=0;
      }
      this.fillItem.name = item.name;
      this.fillItem.availability = item.availability;
      this.fillItem.id = item.id;
      var input = this.fillItem;
      this.$http.put('/api/manage/shape'+item.id,input).then((response) => {
        this.getVueItems();
        toastr.success('Shape Availability Updated Successfully.', 'Success Alert', {timeOut: 3000});
      }, (response) => {
        this.formErrors = response.data;
      });
    },
  }
});