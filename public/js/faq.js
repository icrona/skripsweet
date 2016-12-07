Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr("value");

new Vue({
  el :'#manage-faq',
  data :{
    faqs: [],
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
    newItem : {'question':'','answer':''},
    fillItem : {'question':'','answer':'','id':''},
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
    this.searchFAQ();
  },
  methods: {
    searchFAQ: function() {
      this.$http.get('/api/faqadmin/search?search='+this.search).then((response) => {
        this.$set('faqs', response.data.data.data);
        this.$set('pagination', response.data.pagination);
      });
    },
    getVueItems: function(page) {
      this.$http.get('/api/faqadmin?page='+page).then((response) => {
        this.$set('faqs', response.data.data.data);
        this.$set('pagination', response.data.pagination);
      });
    },
    createItem: function() {
      var input = this.newItem;
      this.$http.post('/api/faqadmin',input).then((response) => {
        this.changePage(this.pagination.current_page);
        this.newItem = {'question':'','answer':''};
        $("#create-item").modal('hide');
        toastr.success('Faq Added Successfully.', 'Success Alert', {timeOut: 3000});
      }, (response) => {
        this.formErrors = response.data;
      });
    },
    deleteItem: function(item) {
      var ini=this;
      swal({
              title: "Are you sure?",
              text: "You will delete this question",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Yes, delete it!",
              closeOnConfirm: false
            },
            function(isConfirm){
              if(isConfirm){
                ini.$http.delete('/api/faqadmin/'+item.id).then((response) => {
                  ini.changePage(ini.pagination.current_page);
                });
                swal("Deleted!", "Your question has been deleted.", "success");
              }
              
      });    
    },
    editItem: function(faq) {
      this.fillItem.question = faq.question;
      this.fillItem.id = faq.id;
      this.fillItem.answer = faq.answer;
      $("#edit").modal('show');
    },

    updateItem: function(id) {
      var input = this.fillItem;
      this.$http.put('/api/faqadmin/'+id,input).then((response) => {
        this.changePage(this.pagination.current_page);
        this.newItem = {'question':'','answer':'','id':''};
        $("#edit").modal('hide');
        toastr.success('Question Updated Successfully.', 'Success Alert', {timeOut: 3000});
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