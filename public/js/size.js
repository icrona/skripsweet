Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr("value");

new Vue({
  el :'#manage_size',
  data :{
    sizes: [],
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
    newItem : {'size':'','rate':''},
    fillItem : {'size':'','rate':'','id':''}
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
      this.$http.get('/api/manage/size?page='+page).then((response) => {
        this.$set('sizes', response.data.data.data);
        this.$set('pagination', response.data.pagination);
      });
    },
    createItem: function() {
      var input = this.newItem;
      this.$http.post('/api/manage/size',input).then((response) => {
        this.changePage(this.pagination.current_page);
        this.newItem = {'name':'','price':''};
        $("#create-item-size").modal('hide');
        toastr.success('Flavour Added Successfully.', 'Success Alert', {timeOut: 3000});
      }, (response) => {
        this.formErrors = response.data;
      });
    },
    deleteItem: function(item) {
      var ini=this;
      var size=item.size;
      swal({
              title: "Are You Sure?",
              text: "You Will Delete Size "+size+" cm",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Yes, delete it!",
              closeOnConfirm: false
            },
            function(isConfirm){
              if(isConfirm){
                ini.$http.delete('/api/manage/size'+item.id).then((response) => {
                  ini.changePage(ini.pagination.current_page);
                });
                swal("Deleted!", "Size "+size+" cm Has Been Deleted.", "success");
              }         
      });    
    },
    editItem: function(size) {
      this.fillItem.size = size.size;
      this.fillItem.id = size.id;
      this.fillItem.rate = size.rate;
      $("#edit-size").modal('show');
    },

    updateItem: function(id) {
      var input = this.fillItem;
      this.$http.put('/api/manage/size'+id,input).then((response) => {
        this.changePage(this.pagination.current_page);
        this.newItem = {'size':'','rate':'','id':''};
        $("#edit-size").modal('hide');
        toastr.success('Size Updated Successfully.', 'Success Alert', {timeOut: 3000});
      }, (response) => {
        this.formErrors = response.data;
      });
    },
    changePage: function(page) {
      this.pagination.current_page = page;
      this.getVueItems(page);
    }
  }
});