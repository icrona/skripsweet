new Vue({
  el :'#user-faq',
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
      this.$http.get('/api/faquser/search?search='+this.search).then((response) => {
        this.$set('faqs', response.data.data.data);
        this.$set('pagination', response.data.pagination);
      });
    },
    getVueItems: function(page) {
      this.$http.get('/api/faquser?page='+page).then((response) => {
        this.$set('faqs', response.data.data.data);
        this.$set('pagination', response.data.pagination);
      });
    },
    changePage: function(page) {
      this.pagination.current_page = page;
      this.getVueItems(page);
    }
  }
});