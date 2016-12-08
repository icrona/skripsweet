Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr("value");

new Vue({
  el :'#cake-anniversary',
  data :{
    image:'',
    fileName:'',
    cakes: [],
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
    newItem : {'name':'','description':'','category':'anniversary','size':'','price':'','image':''},
    fillItem : {'name':'','description':'','category':'anniversary','size':'','price':'','image':'','id':''},
    search : ''
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
  created:function() {
    this.searchCake();
  },
  methods: {
    onFileChange(e){
      this.image='';
      var files=e.target.files||e.dataTransfer.files;
      if(!files.length) 
        return;
      this.image=files[0];
    },

    upload:function(){
      let data = new FormData();
      data.append('file',this.image);  
      console.log(data);
      this.$http.post('/api/cake/upload',data).then((response) => {
        this.fileName=response.data;
        this.image='';
        this.createItem();
      });
    },

    searchCake: function() {
      this.$http.get('/api/cake/anniversary/search?search='+this.search).then((response) => {
        this.$set('cakes', response.data.data.data);
        this.$set('pagination', response.data.pagination);
      });
    },
    getVueItems: function(page) {
      this.$http.get('/api/cake/anniversary?page='+page).then((response) => {
        this.$set('cakes', response.data.data.data);
        this.$set('pagination', response.data.pagination);
      });
    },
    createItem: function() {
      this.newItem.image=this.fileName;
      var input = this.newItem;
      this.$http.post('/api/cake',input).then((response) => {
        this.changePage(this.pagination.current_page);
        this.newItem = {'name':'','description':'','category':'anniversary','size':'','price':'','image':''};
        this.fileName='';
        $("#create-item-anniversary").modal('hide');
        toastr.success('Cake Added Successfully.', 'Success Alert', {timeOut: 3000});
      }, (response) => {
        this.formErrors = response.data;
      });
    },

    deleteItem: function(item) {
      var ini=this;
      swal({
              title: "Are you sure?",
              text: "You will delete this cake",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Yes, delete it!",
              closeOnConfirm: false
            },
            function(isConfirm){
              if(isConfirm){
                ini.$http.delete('/api/cake/'+item.id).then((response) => {
                  ini.changePage(ini.pagination.current_page);
                });
                swal("Deleted!", "Your cake has been deleted.", "success");
              }             
      });    
    },
    editItem: function(cake) {
      this.fillItem.name = cake.name;
      this.fillItem.description = cake.description;
      this.fillItem.category = cake.category;
      this.fillItem.size = cake.size;
      this.fillItem.id = cake.id;
      this.fillItem.price = cake.price;
      this.fillItem.image=cake.image;
      $("#edit-anniversary").modal('show');
    },

    uploadEdit:function(id){
      if(this.image!=''){
        let data = new FormData();
        data.append('file',this.image);
        this.$http.post('/api/cake/upload/edit'+id,data).then((response) => {
          this.fileName=response.data;
          this.image='';
          this.updateItem(id);
        });
      }
      else{
        this.updateItem(id);
      }

    },
    updateItem: function(id) {
      if(this.fileName!=''){
        this.fillItem.image=this.fileName;
      }
      var input = this.fillItem;
      this.$http.put('/api/cake/'+id,input).then((response) => {
        this.changePage(this.pagination.current_page);
        this.newItem = {'name':'','description':'','category':'anniversary','size':'','price':'','image':'','id':''};
        $("#edit-anniversary").modal('hide');
        toastr.success('Cake Updated Successfully.', 'Success Alert', {timeOut: 3000});
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