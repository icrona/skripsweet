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
      $("#edit3").modal('show');
        
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
    updateItem:function(id){
      if(this.fileName!=''){
        this.fillItem.image=this.fileName;
      }
      var input = this.fillItem;
      this.$http.put('/api/manage/decoration'+id,input).then((response) => {
        this.getVueItems();
          $("#edit3").modal('hide');
        toastr.success('Decoration Updated Successfully.', 'Success Alert', {timeOut: 3000});
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