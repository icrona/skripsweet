Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr("value");

new Vue({
  el :'#manage_flavour',
  data :{
    flavours: [],
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
    newItem : {'name':'','price':''},
    fillItem : {'name':'','price':'','id':''}
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
      this.$http.get('/api/manage/flavour?page='+page).then((response) => {
        this.$set('flavours', response.data.data.data);
        this.$set('pagination', response.data.pagination);
      });
    },
    createItem: function() {
      var input = this.newItem;
      this.$http.post('/api/manage/flavour',input).then((response) => {
        this.changePage(this.pagination.current_page);
        this.newItem = {'name':'','price':''};
        $("#create-item-flavour").modal('hide');
        toastr.success('Flavour Added Successfully.', 'Success Alert', {timeOut: 3000});
      }, (response) => {
        this.formErrors = response.data;
      });
    },
    deleteItem: function(item) {
      var ini=this;
      var flavour=item.name;
      swal({
              title: "Are You Sure?",
              text: "You Will Delete "+flavour+" Flavour",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Yes, delete it!",
              closeOnConfirm: false
            },
            function(isConfirm){
              if(isConfirm){
                ini.$http.delete('/api/manage/flavour'+item.id).then((response) => {
                  ini.changePage(ini.pagination.current_page);
                });
                swal("Deleted!", flavour+ " Flavour Has Been Deleted.", "success");
              }         
      });    
    },
    editItem: function(flavour) {
      this.fillItem.name = flavour.name;
      this.fillItem.id = flavour.id;
      this.fillItem.price = flavour.price;
      $("#edit-flavour").modal('show');
    },

    updateItem: function(id) {
      var input = this.fillItem;
      this.$http.put('/api/manage/flavour'+id,input).then((response) => {
        this.changePage(this.pagination.current_page);
        this.newItem = {'name':'','price':'','id':''};
        $("#edit-flavour").modal('hide');
        toastr.success('Flavour Updated Successfully.', 'Success Alert', {timeOut: 3000});
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