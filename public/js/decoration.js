Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr("value");

new Vue({
  el :'#decorations',
  data :{
    image:'',
    fileName:'',
    decorations: [],
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
    fillItem : {'name':'','price':'','availability':'','id':''},
    newItem : {'name':'','price':'','availability':'',}
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
    this.searchDecoration();
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
      this.$http.post('/api/manage/decoration/upload',data).then((response) => {
        this.fileName=response.data;
        this.image='';
        this.createItem();
      });
    },
    createItem: function() {
      this.newItem.availability=1;
      this.newItem.image=this.fileName;
      var input = this.newItem;
      this.$http.post('/api/manage/decoration',input).then((response) => {
        this.changePage(this.pagination.current_page);
        this.newItem = {'name':'','price':'','availability':''}
        this.fileName='';
        $("#create-item-decoration").modal('hide');
        toastr.success('Decoration Added Successfully.', 'Success Alert', {timeOut: 3000});
      }, (response) => {
        this.formErrors = response.data;
      });
    },
    getVueItems: function(page) {
      this.$http.get('/api/manage/decoration?page='+page).then((response) => {
        this.$set('decorations', response.data.data.data);
        this.$set('pagination', response.data.pagination);
      });
    },

    searchDecoration: function() {
      this.$http.get('/api/manage/decoration/search?search='+this.search).then((response) => {
        this.$set('decorations', response.data.data.data);
        this.$set('pagination', response.data.pagination);
      });
    },
    editItem: function(decorations) {
      this.fillItem.id = decorations.id;
      this.fillItem.name=decorations.name;
      this.fillItem.price=decorations.price;
      this.fillItem.availability = decorations.availability;
      if(decorations.id<=25){
        $("#edit3").modal('show');
      }
      else{
        $("#edit-upload").modal('show');
      }
        
    },
    clickCheckBox:function(item) {
      if(item.availability == 0){
        item.availability=1;
      }
      else{
        item.availability=0;
      }
      this.fillItem.id = item.id;
      this.fillItem.name=item.name;
      this.fillItem.price=item.price;
      this.fillItem.availability = item.availability;
      this.updateItem(item.id);

    },
    uploadEdit:function(id){
      if(this.image!=''){
        let data = new FormData();
        data.append('file',this.image);
        this.$http.post('/api/manage/decoration/upload/edit'+id,data).then((response) => {
          this.fileName=response.data;
          this.image='';
          this.updateItem(id);
        });
      }
      else{
        this.updateItem(id);
      }
    },
    updateItem:function(id){
      if(this.fileName!=''){
        this.fillItem.image=this.fileName;
      }
      var input = this.fillItem;
      this.$http.put('/api/manage/decoration'+id,input).then((response) => {
        this.getVueItems();
        if(id<=25){
          $("#edit3").modal('hide');
        }
        else{
          $("#edit-upload").modal('hide');
        }
        toastr.success('Decoration Updated Successfully.', 'Success Alert', {timeOut: 3000});
      }, (response) => {
        this.formErrors = response.data;
      });
    },
    deleteItem: function(item) {
      var ini=this;
      swal({
              title: "Are you sure?",
              text: "You will delete this decoration",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Yes, delete it!",
              closeOnConfirm: false
            },
            function(isConfirm){
              if(isConfirm){
                ini.$http.delete('/api/manage/decoration'+item.id).then((response) => {
                  ini.changePage(ini.pagination.current_page);
                });
                swal("Deleted!", "Your decoration has been deleted.", "success");
              }             
      });    
    },

    changePage: function(page) {
      this.pagination.current_page = page;
      this.getVueItems(page);
    }
  }
});